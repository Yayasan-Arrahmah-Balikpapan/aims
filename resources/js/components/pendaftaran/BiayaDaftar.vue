<template>
  <div>
    <table class="w-full">
      <tbody>
        <tr v-for="item in dataBiaya" :key="item.id" class="border-b text-sm border-gray-200">
          <td class="px-3 py-3 font-semibold uppercase text-gray-900">
            {{ item.nama }}
            <div class="font-base text-gray-600">
              Rp. {{ formatNominal(item.nominal) }}
            </div>
          </td>
          <td class="px-3 py-3 font-semibold uppercase text-gray-900 text-center">
            <div v-if="item.wajib_dibayar_awal" class="flex items-center justify-center">
              <div class="bg-primary-600 p-1 rounded-md">
                <x-carbon-checkmark class="h-4 w-4 text-white" />
              </div>
            </div>
            <input
              v-else
              type="checkbox"
              v-model="form[`pembayaran${item.id}`]"
              :name="`pembayaran${item.id}`"
              class="w-6 h-6 rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
              @change="handleCheckboxChange(item.id)"
            >
          </td>
        </tr>
        <tr class="border-b text-sm border-gray-200 bg-gray-50">
          <td class="px-3 py-3 font-bold uppercase text-gray-900">
            TOTAL PEMBAYARAN
          </td>
          <td class="px-3 py-3 font-bold text-gray-900 text-center">
            Rp. {{ formatNominal(totalPembayaran) }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    dataBiaya: {
      type: Array,
      required: true,
      default: () => [],
    },
  },
  data() {
    // Inisialisasi form dengan nilai default false untuk semua checkbox
    const initialForm = {};
    this.dataBiaya.forEach(item => {
      if (!item.wajib_dibayar_awal) {
        initialForm[`pembayaran${item.id}`] = false;
      }
    });

    return {
      form: initialForm,
    };
  },
  computed: {
    totalPembayaran() {
      let total = 0;

      this.dataBiaya.forEach(item => {
        // Jika wajib dibayar atau checkbox dicentang
        if (item.wajib_dibayar_awal || this.form[`pembayaran${item.id}`]) {
          total += item.nominal;
        }
      });

      return total;
    },
  },
  methods: {
    formatNominal(value) {
      return new Intl.NumberFormat('id-ID').format(value);
    },
    handleCheckboxChange(id) {
      // Dapatkan semua ID yang bisa dicentang (non-wajib)
      const checkableIds = this.dataBiaya
        .filter(item => !item.wajib_dibayar_awal)
        .map(item => item.id)
        .sort((a, b) => a - b);

      // Cari index ID yang dicentang
      const currentIndex = checkableIds.indexOf(id);

      // Jika checkbox dicentang, centang semua sebelumny
      if (this.form[`pembayaran${id}`]) {
        for (let i = 0; i < currentIndex; i++) {
          const prevId = checkableIds[i];
          this.form[`pembayaran${prevId}`] = true;
        }
      }
      // Jika checkbox diuncentang, uncentang semua setelahnya
      else {
        for (let i = currentIndex + 1; i < checkableIds.length; i++) {
          const nextId = checkableIds[i];
          this.form[`pembayaran${nextId}`] = false;
        }
      }
    },
  },
};
</script>
