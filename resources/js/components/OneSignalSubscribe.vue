<template>
  <div class="p-4">
    <div v-if="!isSubscribed && oneSignalLoaded">
      <button
        @click="subscribe"
        class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50"
        :disabled="loading"
      >
        <span v-if="loading" class="flex items-center">
          <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          Memproses...
        </span>
        <span v-else>Aktifkan Notifikasi</span>
      </button>
      <p class="mt-2 text-sm text-gray-600">Dapatkan notifikasi terbaru dari kami</p>
    </div>

    <div v-else-if="isSubscribed && oneSignalLoaded" class="bg-green-50 p-3 rounded-lg border border-green-200">
      <p class="text-green-700 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        Kamu sudah berlangganan notifikasi.
      </p>
      <button
        @click="unsubscribe"
        class="mt-2 px-4 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50"
        :disabled="loading"
      >
        <span v-if="loading" class="flex items-center">
          <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          Memproses...
        </span>
        <span v-else>Matikan Notifikasi</span>
      </button>
    </div>

    <div v-else class="p-3 bg-gray-100 rounded-lg">
      <p class="text-gray-600">Memuat layanan notifikasi...</p>
    </div>

    <div v-if="errorMessage" class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg">
      <p class="text-red-700">{{ errorMessage }}</p>
    </div>
  </div>
</template>

<script>
export default {
  name: "OneSignalSubscribe",
  data() {
    return {
      isSubscribed: false,
      playerId: null,
      oneSignalLoaded: false,
      loading: false,
      errorMessage: ""
    };
  },
  mounted() {
    this.initializeOneSignal();
  },
  methods: {
    initializeOneSignal() {
      // Cek apakah OneSignal sudah ada (jika sudah dimuat di tempat lain)
      if (window.OneSignal) {
        this.setupOneSignal();
        return;
      }

      // Inject SDK OneSignal
      const script = document.createElement("script");
      script.src = "https://cdn.onesignal.com/sdks/OneSignalSDK.js";
      script.async = true;
      document.head.appendChild(script);

      script.onload = () => {
        this.setupOneSignal();
      };

      script.onerror = () => {
        this.errorMessage = "Gagal memuat layanan notifikasi. Silakan refresh halaman.";
      };
    },

    setupOneSignal() {
      window.OneSignal = window.OneSignal || [];

      window.OneSignal.push(() => {
        // Inisialisasi OneSignal
        window.OneSignal.init({
          appId: this.getAppId(),
          notifyButton: { enable: false },
          allowLocalhostAsSecureOrigin: true,
        });

        // Cek status subscribe
        window.OneSignal.isPushNotificationsEnabled()
          .then((enabled) => {
            this.isSubscribed = enabled;
            this.oneSignalLoaded = true;

            // Jika sudah subscribe, ambil Player ID
            if (enabled) {
              return window.OneSignal.getUserId();
            }
          })
          .then((userId) => {
            if (userId) {
              this.playerId = userId;
              this.savePlayerId(userId);
            }
          })
          .catch((error) => {
            console.error("Error initializing OneSignal:", error);
            this.errorMessage = "Terjadi kesalahan dalam mengaktifkan notifikasi.";
            this.oneSignalLoaded = true;
          });

        // Listen for subscription changes
        window.OneSignal.on("subscriptionChange", (isSubscribed) => {
          this.isSubscribed = isSubscribed;
          if (isSubscribed) {
            window.OneSignal.getUserId().then((userId) => {
              this.playerId = userId;
              this.savePlayerId(userId);
            });
          }
        });
      });
    },

    getAppId() {
      // Ambil App ID dari prop atau environment
      return this.appId || import.meta.env.VITE_ONESIGNAL_APP_ID || '1c0e0bb6-57a8-4bb6-b586-502e678b153b';
    },

    async subscribe() {
      this.loading = true;
      this.errorMessage = "";

      try {
        await window.OneSignal.registerForPushNotifications();
        // Status perubahan akan ditangani oleh event listener subscriptionChange
      } catch (error) {
        console.error("Error subscribing:", error);
        this.errorMessage = "Gagal mengaktifkan notifikasi. Pastikan browser mendukung notifikasi.";
      } finally {
        this.loading = false;
      }
    },

    async unsubscribe() {
      this.loading = true;
      this.errorMessage = "";

      try {
        await window.OneSignal.setSubscription(false);
        this.isSubscribed = false;
        this.playerId = null;
      } catch (error) {
        console.error("Error unsubscribing:", error);
        this.errorMessage = "Gagal mematikan notifikasi.";
      } finally {
        this.loading = false;
      }
    },

    async savePlayerId(userId) {
      try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

        const res = await fetch("/save-player-id", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken || ""
          },
          body: JSON.stringify({ player_id: userId }),
        });

        if (!res.ok) {
          throw new Error("Network response was not ok");
        }

        const data = await res.json();
        console.log("Player ID saved:", data);
      } catch (err) {
        console.error("Error saving player_id:", err);
      }
    },
  },

  props: {
    appId: {
      type: String,
      default: null
    }
  }
};
</script>
