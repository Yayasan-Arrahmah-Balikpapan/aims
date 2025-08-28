<x-layouts.main :unit="$unit">
    <div class="p-4 space-y-2">
        <x-layouts.card-periode>
            <x-layouts.title>Kelas <text class="uppercase">{{ $unit }}</text>, {{ $data_kelas->nama_jadwal }} - {{ $data_kelas->periode->nama }} </x-layouts.title>
            <div class="py-4">
                <div class="mb-4 grid gap-3 grid-cols-2 md:gap-6">
                    <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">Pengajar</p>
                        <p class="text-lg font-bold text-gray-800">{{  $data_kelas->pengajar ? $data_kelas->pengajar->kode_nama_pengajar : '-' }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">Jenis</p>
                        <p class="text-lg font-bold text-gray-800">{{ $data_kelas->jenis_peserta ?? '-' }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">Hari</p>
                        <p class="text-lg font-bold text-gray-800">{{ $data_kelas->hari_belajar ?? '-' }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">Waktu </p>
                        <p class="text-lg font-bold text-gray-800">{{ $data_kelas->jam_mulai ?? '.' }} - {{ $data_kelas->jam_selesai ?? '.' }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">Level</p>
                        <p class="text-lg font-bold text-gray-800">{{ $data_kelas->level ? $data_kelas->level->nama : '-' }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">Status Belajar</p>
                        <p class="text-lg font-bold text-gray-800">{{ $data_kelas->status_belajar ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </x-layouts.card-periode>
        @if ($unit == 'tahsin')
            @include('dashboard.pengajar.jadwal.tahsin-data')
        @endif
    </div>
</x-layouts.main>
