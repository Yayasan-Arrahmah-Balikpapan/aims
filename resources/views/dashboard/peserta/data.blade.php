<x-app-layout>
    <div class="pt-10 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold mb-4">Peserta</h1>
                    <Link href="/dashboard/daftar-program" class="py-2 px-5 flex text-white bg-primary-800 text-sm rounded-lg uppercase">
                        Program Pendidikan
                        <x-carbon-education class="w-5 h-5 ml-2 text-white"/>
                    </Link>
                </div>
            </div>
            <div class="flex justify-end py-4">
                {{-- <input type="text" placeholder="Cari Peserta..."
                    class="w-full max-w-xs border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    oninput="filterList(this.value)"> --}}
            </div>
            <div class="flow-root">
                <ul role="list" class="space-y-2">
                    @foreach ($data_peserta as $item)
                        <li class="p-4 border rounded-md bg-white">
                            <div class="flex items-center justify-end uppercase space-x-2">
                                <div class="text-xs">
                                    STATUS :
                                </div>
                                @if ($item->status_aktif == 'diproses')
                                    <span class="bg-yellow-300 text-gray-900 px-2 py-1 text-xs font-semibold rounded-xl">
                                        Diproses
                                    </span>
                                @elseif ($item->status_aktif == 'aktif')
                                    <span class="bg-sky-500 text-white px-2 py-1 text-xs font-semibold rounded-xl">
                                        Aktif
                                    </span>
                                @elseif ($item->status_aktif == 'ditangguhkan' || $item->status_aktif == 'off')
                                    <span class="bg-red-700 text-white px-2 py-1 text-xs font-semibold rounded-xl uppercase">
                                        {{ $item->status_aktif}}
                                    </span>
                                @endif
                                @if ($item->status_pendaftaran == 'belum pilih jadwal')
                                    <span class="bg-red-300 text-gray-800 px-2 py-1 text-xs font-semibold rounded-xl">
                                        Dimohon Segera Memilih Jadwal
                                    </span>
                                @endif
                            </div>
                            <hr class="my-2" />
                            <div class="flex items-center">
                                <div class="shrink-0 px-4">
                                    <img class="w-12 rounded-full" src="/assets/logo/{{ $item->periode->unit->slug }}.jpg" alt="{{ $item->periode->unit->nama }}">
                                </div>
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-md font-medium text-gray-900 uppercase">
                                        {{ $item->nis_peserta }} - {{ $item->peserta->nama }}
                                    </p>
                                    <p class="text-sm text-gray-500 uppercase">
                                        {{ $item->periode->unit->nama }} {{ $item->periode->nama }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                    <Link href="{{ route('dashboard.peserta', ['uuid' => $item->uuid ]) }}"
                                        class="text-sm flex font-semibold border rounded-lg py-2.5 px-5 border-primary-700 text-primary-700 hover:text-white bg-white  hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
                                        Lihat
                                    </Link>
                                </div>
                            </div>
                            @if ($item->status_pendaftaran == 'belum pilih jadwal')
                                <hr class="my-2" />
                                <div class="flex items-center">
                                    <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                        <Link href="{{ route('dashboard.peserta.daftar-jadwal', ['peserta' => $item->uuid ]) }}"
                                            class="text-sm flex font-semibold border rounded-lg py-2.5 px-5 border-primary-700 text-primary-700 hover:text-white bg-white  hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
                                            Pilih Jadwal Sekarang
                                            <x-carbon-arrow-right class="w-5 h-5 ml-2 text-white"/>
                                        </Link>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flow-root py-4">
                {{ $data_peserta->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
