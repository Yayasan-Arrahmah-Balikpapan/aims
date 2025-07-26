<x-layouts.main :unit="$unit">
    <x-layouts.card>
       <label class="text-xl font-semibold uppercase">Periode {{ $data_periode->nama }}</label>
    </x-layouts.card>
    <div class="p-4">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 lg:gap-6">
            @foreach ($data_jadwal as $item)
            <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm  sm:p-6">
                    <p class="text-xl font-semibold text-gray-900 flex justify-end ">Kelas {{ $item->nama_jadwal }}</p>
                    <div class="p-4 border rounded-md">
                        <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Jenis Peserta</dt>
                                <dd class="text-base font-medium text-gray-900">{{ $item->jenis_peserta }}</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Level</dt>
                                <dd class="text-base font-medium text-gray-900">{{ $item->level->nama ?? '-' }}</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Batasan Peserta</dt>
                                <dd class="text-base font-medium text-gray-900">{{ $item->batasan_peserta }}</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Status Belajar</dt>
                                <dd class="text-base font-medium text-gray-900">{{ $item->status_belajar }}</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Hari</dt>
                                <dd class="text-base font-medium text-gray-900">{{ $item->hari_belajar }}</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Jam Mulai</dt>
                                <dd class="text-base font-medium text-gray-900">{{ $item->jam_mulai }}</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="flex w-full items-center justify-start space-x-2">
                        <Link href="{{ route('pengajar.jadwal.data.kelas', ['unit' => $unit, 'periode' => $periode, 'kelas' => $item->id]) }}" class="flex items-center justify-center rounded-lg border border-primary-700 px-5 py-2.5 text-sm font-medium text-primary-700">
                            Lihat Data  @svg('carbon-arrow-right', 'ml-2 h-5 w-5 text-primary-700')
                        </Link>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layouts.main>
