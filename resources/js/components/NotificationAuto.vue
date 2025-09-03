<template>
  <div>
    <!-- Status indicator saja tanpa tombol -->
    <div v-if="loading" class="text-info">
      Mengaktifkan notifikasi...
    </div>
    <div v-else-if="isPushEnabled" class="text-success">
      Notifikasi push telah diaktifkan
    </div>
    <div v-else class="text-warning">
      Tidak dapat mengaktifkan notifikasi push
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data: () => ({
    loading: false,
    isPushEnabled: false,
    pushButtonDisabled: true,
    hasSentNotification: false
  }),

  mounted () {
    this.autoEnablePushNotifications()
  },

  methods: {
    /**
     * Otomatis mengaktifkan push notifications saat komponen dimuat
     */
    async autoEnablePushNotifications() {
      await this.registerServiceWorker()

      // Tunggu sebentar untuk memastikan service worker siap
      setTimeout(() => {
        if (!this.isPushEnabled) {
          this.subscribe()
        }
      }, 1000)
    },

    /**
     * Register the service worker.
     */
    async registerServiceWorker () {
      if (!('serviceWorker' in navigator)) {
        console.log('Service workers aren\'t supported in this browser.')
        return false
      }

      try {
        await navigator.serviceWorker.register('/sw.js')
        await this.initialiseServiceWorker()
        return true
      } catch (error) {
        console.log('Service worker registration failed:', error)
        return false
      }
    },

    async initialiseServiceWorker () {
      if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
        console.log('Notifications aren\'t supported.')
        return
      }

      if (Notification.permission === 'denied') {
        console.log('The user has blocked notifications.')
        return
      }

      if (!('PushManager' in window)) {
        console.log('Push messaging isn\'t supported.')
        return
      }

      try {
        const registration = await navigator.serviceWorker.ready
        const subscription = await registration.pushManager.getSubscription()

        this.pushButtonDisabled = false

        if (subscription) {
          this.updateSubscription(subscription)
          this.isPushEnabled = true
          this.sendAutoNotification() // Kirim notifikasi otomatis
        }
      } catch (e) {
        console.log('Error during getSubscription()', e)
      }
    },

    /**
     * Subscribe for push notifications.
     */
    async subscribe () {
      try {
        const registration = await navigator.serviceWorker.ready
        const options = { userVisibleOnly: true }
        const vapidPublicKey = 'BIZ_6xxWV9Cm1aPxuqs6IW7Gi9x9-DIJBuh5UlQLhc-YXBwO9nfeTsC8h9PSFf6JFcqCrcxfHGjjV5AWDpOvmU'

        if (vapidPublicKey) {
          options.applicationServerKey = this.urlBase64ToUint8Array(vapidPublicKey)
        }

        const subscription = await registration.pushManager.subscribe(options)

        this.isPushEnabled = true
        this.pushButtonDisabled = false

        await this.updateSubscription(subscription)
        this.sendAutoNotification() // Kirim notifikasi otomatis setelah subscribe

      } catch (e) {
        if (Notification.permission === 'denied') {
          console.log('Permission for Notifications was denied')
          this.pushButtonDisabled = true
        } else {
          console.log('Unable to subscribe to push.', e)
          this.pushButtonDisabled = false
        }
      }
    },

    /**
     * Send notification automatically
     */
    async sendAutoNotification() {
      // Cegah pengiriman berulang
      if (this.hasSentNotification) return

      this.hasSentNotification = true
      this.loading = true

      try {
        await axios.post('/notifications')
        console.log('Notification sent automatically')
      } catch (error) {
        console.log('Error sending notification:', error)
      } finally {
        this.loading = false
      }
    },

    /**
     * Send a request to the server to update user's subscription.
     */
    async updateSubscription (subscription) {
      const key = subscription.getKey('p256dh')
      const token = subscription.getKey('auth')
      const contentEncoding = (PushManager.supportedContentEncodings || ['aesgcm'])[0]

      const data = {
        endpoint: subscription.endpoint,
        publicKey: key ? btoa(String.fromCharCode.apply(null, new Uint8Array(key))) : null,
        authToken: token ? btoa(String.fromCharCode.apply(null, new Uint8Array(token))) : null,
        contentEncoding
      }

      this.loading = true

      try {
        await axios.post('/subscriptions', data)
      } catch (error) {
        console.log('Error updating subscription:', error)
      } finally {
        this.loading = false
      }
    },

    /**
     * https://github.com/Minishlink/physbook/blob/02a0d5d7ca0d5d2cc6d308a3a9b81244c63b3f14/app/Resources/public/js/app.js#L177
     */
    urlBase64ToUint8Array (base64String) {
      const padding = '='.repeat((4 - base64String.length % 4) % 4)
      const base64 = (base64String + padding)
        .replace(/-/g, '+')
        .replace(/_/g, '/')

      const rawData = window.atob(base64)
      const outputArray = new Uint8Array(rawData.length)

      for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i)
      }

      return outputArray
    }
  }
}
</script>

<style scoped>
.text-info { color: #17a2b8; }
.text-success { color: #28a745; }
.text-warning { color: #ffc107; }
</style>
