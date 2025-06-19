<x-splade-modal :unit="$unit">
    <x-splade-form action="{{ route('admin.peserta.store.pilih', ['unit' => $unit, 'periode' => $periode]) }}" method="POST" onkeydown="return event.key != 'Enter';"
        :default="[
            'penerimaan' => 'umum',
            'domisili' => '1',
        ]"
    >
        @csrf

        <div class="relative">
            <x-forms.header>
                Daftarkan Ulang Peserta
            </x-forms.header>

            <x-forms.body >
                <x-splade-select name="peserta" :label="__('Pilih Peserta')" remote-url="{{ route('admin.peserta.data.api', ['unit' => $unit, 'periode' => $periode]) }}" remote-root="data.peserta" choices required />
                <x-splade-select name="jadwal" :label="__('Jadwal')" :options="$jadwals" option-label="nama_jadwal" option-value="id" required choices />
                <x-splade-select name="penerimaan" :label="__('Peserta')" choices>
                    <option value="umum">Umum</option>
                    <option value="warga">Warga</option>
                    <option value="karyawan">Karyawan</option>
                </x-splade-select>
                <x-splade-select name="domisili" :label="__('Domisili')" choices>
                    <option value="1">Kota Balikpapan</option>
                    <option value="0">Luar Kota Balikpapan</option>
                </x-splade-select>
            </x-forms.body>

            <x-forms.footer />
        </div>
    </x-splade-form>
</x-splade-modal>

