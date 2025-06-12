<x-splade-modal>
    <x-splade-form action="{{ route('hrd.karyawan.data.store') }}" onkeydown="return event.key != 'Enter';"
        :default="[
                'jenis_kelamin' => 'ikhwan',
                'status_bekerja' => 'karyawan tetap',
            ]"
    >
        @csrf

        <div class="relative">
            <x-forms.header>
                Tambah Data Karyawan
            </x-forms.header>

            <x-forms.body >
                <x-splade-select name="karyawans" :label="__('User Karyawan')" :options="$karyawans" option-label="name" option-value="id" choices />
                <x-splade-input name="nip" :label="__('NIP')" />
                <x-splade-select name="divisi" :label="__('Divisi')" :options="$divisis" option-label="nama" option-value="id" />
                <x-splade-select name="jenis_kelamin" :label="__('Gender')" required >
                    <option value="ikhwan">Ikhwan / Laki-laki</option>
                    <option value="akhwat">Akhwat / Perempuan</option>
                </x-splade-select>
                <x-splade-select name="status_bekerja" :label="__('Status')" required >
                    <option value="karyawan tetap">Karyawan Tetap</option>
                    <option value="probation">Probation</option>
                    <option value="kontrak">Kontrak</option>
                </x-splade-select>
            </x-forms.body>

            <x-forms.footer />
        </div>
    </x-splade-form>
</x-splade-modal>

