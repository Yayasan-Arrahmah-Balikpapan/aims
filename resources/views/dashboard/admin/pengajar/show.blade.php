<x-layouts.main :unit="$unit ?? null">
    <x-layouts.card>
        <x-splade-form action="{{ route('admin.pengajar.update', ['unit' => $unit, 'pengajar' => $pengajar->id]) }}" method="PUT" onkeydown="return event.key != 'Enter';"
            :default="[
                'kode_nama_pengajar' => $pengajar->kode_nama_pengajar,
                'pengajars' => $pengajar->user_id,
            ]"
        >
            @csrf

            <div class="relative p-4">
                <x-splade-input name="kode_nama_pengajar" :label="__('Kode Nama Pengajar')" required min="3" oninvalid="this.setCustomValidity('Harus Diisi, Minimal 3 Huruf')"/>
                <x-splade-select name="pengajars" :label="__('User Akun')" :options="$pengajars" option-label="name" option-value="id" choices />

                <div class="flex items-center p-6">
                    <input id="konfirmasi-checkbox" type="checkbox" v-model="form.agree_with_terms" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                    <label for="konfirmasi-checkbox" class="text-sm font-medium text-gray-900 px-3">Konfirmasi</label>
                </div>
                <div class="flex items-center p-6 border-t border-gray-200 rounded-b ">
                    <x-splade-submit label="Simpan" v-show="form.agree_with_terms"/>
                </div>

            </div>
        </x-splade-form>
    </x-layouts.card>
</x-layouts.main>
