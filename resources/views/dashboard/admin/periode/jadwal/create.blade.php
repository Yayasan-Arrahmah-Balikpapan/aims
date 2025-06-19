<x-splade-modal :unit="$unit">
    <x-splade-form action="{{ route('admin.jadwal.store', ['unit' => $unit, 'periode' => $periode]) }}" method="POST" onkeydown="return event.key != 'Enter';"
        :default="[
            'status_belajar' => 'OFFLINE',
            'jenis_peserta' => 'IKHWAN',
            'periode' => $periode,
        ]"
    >
        @csrf

        <div class="relative">
            <x-forms.header>
                Tambah Data Jadwal
            </x-forms.header>

            <x-forms.body >
                <x-splade-select name="periode" :label="__('Periode')" :options="$periodes" option-label="nama" option-value="id" disabled required choices />
                <x-splade-input name="nama_jadwal" :label="__('Nama Jadwal')" required/>
                <x-splade-select name="jenis_peserta" :label="__('Jenis')" :options="$jenis" option-label="nama" option-value="nama" choices />
                <x-splade-select name="pengajar" :label="__('Nama Pengajar')" :options="$pengajars" option-label="name" option-value="pengajar.id" choices />
                <x-splade-select name="hari_belajar" :label="__('Hari')" :options="$hari" option-label="nama" option-value="nama" choices />
                <x-splade-select name="level" :label="__('Level')" :options="$level" option-label="nama" option-value="id" choices />
                <x-splade-input name="batasan_peserta" :label="__('Batasan Peserta')" type="number" required/>
                <x-splade-input name="jam_mulai" :label="__('Jam Mulai')" time />
                <x-splade-input name="jam_selesai" :label="__('Jam Selesai')"  time />
                <x-splade-select name="status_belajar" :label="__('Status Belajar')" :options="$status_belajar" option-label="nama" option-value="nama" choices />
            </x-forms.body>

            <x-forms.footer />
        </div>
    </x-splade-form>
</x-splade-modal>

