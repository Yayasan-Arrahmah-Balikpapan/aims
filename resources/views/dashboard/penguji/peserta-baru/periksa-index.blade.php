<x-layouts.main :unit="$unit">
    <div class="p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-2 lg:gap-6">
            <x-splade-lazy>
                <x-slot:placeholder>
                    <div class="rounded-lg border border-gray-300 p-4">
                        <div class="flex animate-pulse space-x-4">
                            <div class="size-10 rounded-full bg-gray-200"></div>
                            <div class="flex-1 space-y-6 py-1">
                                <div class="h-2 rounded bg-gray-200"></div>
                                <div class="space-y-3">
                                    <div class="grid grid-cols-3 gap-4">
                                        <div class="col-span-2 h-2 rounded bg-gray-200"></div>
                                        <div class="col-span-1 h-2 rounded bg-gray-200"></div>
                                    </div>
                                    <div class="h-2 rounded bg-gray-200"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-slot:placeholder>
                @forelse ($data_periode as $item)
                <div class="space-y-6">
                    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4">
                        <p class="text-xl font-semibold text-gray-900 flex justify-end ">Peserta {{ $item->nama }}</p>
                        <div class="border rounded-md p-2 space-y-2">
                            {{-- <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Ikhwan</dt>
                                <dd class="text-base font-medium text-gray-900 uppercase">{{ $item->kategori }}</dd>
                            </dl> --}}
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500">Belum Diperiksa</dt>
                                <dd class="text-base font-medium text-gray-900 uppercase">{{ $item->kelas->where('status_pendaftaran', 'belum diberikan level')->count() }}</dd>
                            </dl>
                        </div>
                        <div class="flex w-full items-center justify-start space-x-2">
                            <Link href="{{ route('penguji.periksa.data', ['unit' => $unit, 'periode' => $item->id]) }}" class="flex items-center justify-center rounded-lg border border-primary-700 px-5 py-2.5 text-sm font-medium text-primary-700">
                                Lihat Data  @svg('carbon-arrow-right', 'ml-2 h-5 w-5 text-primary-700')
                            </Link>
                        </div>
                    </div>
                </div>
                @empty
                        Belum Ada Data
                @endforelse
            </x-splade-lazy>
        </div>
        <div class="p-2 text-xs text-gray-500">
            {{ $data_periode ->links() }}
        </div>
    </div>
</x-layouts.main>
