<div>
    <div class="flex items-center p-6">
        <input id="konfirmasi-checkbox" type="checkbox" v-model="form.agree_with_terms" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
        <label for="konfirmasi-checkbox" class="text-sm font-medium text-gray-900 px-3">Konfirmasi</label>
    </div>
    <div class="flex items-center p-6 border-t border-gray-200 rounded-b ">
        <button type="button" @click="modal.close" class="text-white bg-gray-400 hover:bg-gray-500 font-medium rounded-lg text-sm px-5 py-[11px] mr-4">
            Batal
        </button>

        <x-splade-submit label="Simpan" v-show="form.agree_with_terms" />
    </div>
</div>
