<x-splade-modal :unit="$unit">
    <x-splade-form action="{{ route('admin.jadwal.update', ['unit' => $unit, 'jadwal' => $jadwal->id]) }}" method="PUT" onkeydown="return event.key != 'Enter';"
        :default="[
            'periode' => $jadwal->periode_id,
            'nama_jadwal' => $jadwal->nama_jadwal,
            'pengajar' => $jadwal->pengajar_id,
            'hari_belajar' => $jadwal->hari_belajar,
            'level' => $jadwal->level_id,
            'jam_mulai' => $jadwal->jam_mulai,
            'jam_selesai' => $jadwal->jam_selesai,
            'status_belajar' => $jadwal->status_belajar,
            'jenis_peserta' => $jadwal->jenis_peserta,
        ]"
    >
        @csrf

        <div class="relative">
            <x-forms.header>
                Update Data Jadwal
            </x-forms.header>

            <x-forms.body >
                <x-splade-select name="periode" :label="__('Pilihan Periode')" :options="$periodes" option-label="nama" option-value="id" required choices />
                <x-splade-input name="nama_jadwal" :label="__('Nama Jadwal')" required min="3" oninvalid="this.setCustomValidity('Harus Diisi, Minimal 3 Huruf')" />
                <x-splade-select name="jenis_peserta" :label="__('Jenis')" :options="$jenis" option-label="nama" option-value="nama" choices />
                <x-splade-select name="pengajar" :label="__('Nama Pengajar')" :options="$pengajars" option-label="name" option-value="pengajar.id" choices />
                <x-splade-select name="hari_belajar" :label="__('Hari')" :options="$hari" option-label="nama" option-value="nama" choices />
                <x-splade-input name="jam_mulai" :label="__('Jam Mulai')" time />
                <x-splade-input name="jam_selesai" :label="__('Jam Selesai')"  time />
                <x-splade-select name="status_belajar" :label="__('Status Belajar')" :options="$status_belajar" option-label="nama" option-value="nama" choices />
            </x-forms.body>

            <x-forms.footer />
        </div>
    </x-splade-form>
</x-splade-modal>

