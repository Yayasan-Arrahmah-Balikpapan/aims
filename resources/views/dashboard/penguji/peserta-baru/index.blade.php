<x-layouts.main :unit="$unit">
    <div class="p-4">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 lg:gap-6">
            @foreach ($data_periode as $item)
            <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm  sm:p-6">
                    <p class="text-xl font-semibold text-gray-900 flex justify-end ">Peserta {{ $item->nama }}</p>
                    <div class="border rounded-md p-2 space-y-2">
                        <dl class="flex items-center justify-between gap-4">
                            <dt class="text-base font-normal text-gray-500">Kategori</dt>
                            <dd class="text-base font-medium text-gray-900 uppercase">{{ $item->kategori }}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4">
                            <dt class="text-base font-normal text-gray-500">Pendaftar</dt>
                            <dd class="text-base font-medium text-gray-900 uppercase">{{ $item->kelas->count() }}</dd>
                        </dl>
                    </div>
                    <div class="flex w-full items-center justify-start space-x-2">
                        <Link href="{{ route('penguji.peserta-baru.data', ['unit' => $unit, 'periode' => $item->id]) }}" class="flex items-center justify-center rounded-lg border border-primary-700 px-5 py-2.5 text-sm font-medium text-primary-700">
                            Lihat Data  @svg('carbon-arrow-right', 'ml-2 h-5 w-5 text-primary-700')
                        </Link>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-layouts.main>
