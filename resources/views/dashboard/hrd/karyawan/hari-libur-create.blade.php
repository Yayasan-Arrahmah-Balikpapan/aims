<x-splade-modal>
    <x-splade-form action="{{ route('hrd.karyawan.hari_libur.store') }}" onkeydown="return event.key != 'Enter';"
        :default="[
                'jenis_peserta' => 'ikhwan',
            ]"
    >
        @csrf

        <div class="relative">
            <x-forms.header>
                Tambah Data Karyawan
            </x-forms.header>

            <x-forms.body >
                <x-splade-select name="karyawans" :label="__('User Karyawan')" :options="$karyawans" option-label="name" option-value="id" choices />
                <x-splade-select name="divisi" :label="__('Divisi')" :options="$divisis" option-label="nama" option-value="id" />
                <x-splade-select name="jenis_kelamin" :label="__('Jenis Peserta')" required value="ikhwan" >
                    <option value="ikhwan">Ikhwan / Laki-laki</option>
                    <option value="akhwat">Akhwat / Perempuan</option>
                </x-splade-select>
            </x-forms.body>

            <x-forms.footer />
        </div>
    </x-splade-form>
</x-splade-modal>

