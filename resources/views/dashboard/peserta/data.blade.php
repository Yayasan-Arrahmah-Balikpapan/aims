<x-app-layout>
    <div class="pt-4 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white rounded-lg p-4">
                <div class="block sm:flex items-center sm:justify-between">
                    <h1 class="text-2xl font-bold mb-4">Peserta</h1>
                    <Link href="/dashboard/daftar-program" class="py-2 px-5 flex justify-between text-white bg-primary-800 text-sm rounded-lg uppercase">
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
                        @forelse ($data_peserta as $item)
                            <li class="p-2 sm:p-4 border rounded-md bg-white">
                                <div class="flex items-center justify-between uppercase ">
                                    <span class="text-xs sm:text-[16px] font-semibold">{{ $item->nis_peserta }}</span>
                                    <div class="text-[10px] sm:text-xs">
                                        Status :
                                        <span class="px-2 py-0 sm:py-1 ml-1 font-semibold rounded-xl
                                            {{ $item->status_aktif == 'diproses' ? 'bg-yellow-300 text-gray-900'
                                            : ($item->status_aktif == 'aktif' ? 'bg-sky-500 text-white'
                                            : ($item->status_aktif == 'ditangguhkan' || $item->status_aktif == 'off' ? 'bg-red-700 text-white' : '')) }}">
                                            {{ $item->status_aktif }}
                                        </span>
                                    </div>
                                </div>
                                <hr class="my-1 sm:my-2" />
                                <div class="flex items-center">
                                    <div class="shrink-0 px-0 sm:px-4">
                                        <img class="w-10 sm:w-16 rounded-full" src="/assets/logo/{{ $item->periode->unit->slug }}.jpg" alt="{{ $item->periode->unit->nama }}">
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <Link href="{{ route('dashboard.peserta', ['uuid' => $item->uuid ]) }}">
                                            <p class="text-md font-medium text-gray-900 uppercase">

                                            </p>
                                            <p class="text-md font-medium text-gray-900 uppercase">
                                                    {{ $item->peserta->nama }}
                                            </p>
                                            <p class="text-sm text-gray-500 uppercase">
                                                {{ $item->periode->unit->nama }} {{ $item->periode->nama }}
                                            </p>
                                        </Link>
                                    </div>
                                    <div class="hidden sm:block items-center text-base font-semibold text-gray-900">
                                        <Link href="{{ route('dashboard.peserta', ['uuid' => $item->uuid ]) }}"
                                            class="text-sm flex font-semibold border rounded-lg py-2.5 px-5 border-primary-700 text-primary-700 bg-white">
                                            Lihat
                                        </Link>
                                    </div>
                                </div>

                                @if(isset($data_transaksi['transaksi'.$item->id]) || $item->status_pendaftaran == 'belum pilih jadwal')
                                    <hr class="my-1 sm:my-2" />
                                    <div class="flex items-center justify-center text-center ">
                                        <div class="items-center justify-center text-center text-base font-semibold text-gray-900">
                                            @if(isset($data_transaksi['transaksi'.$item->id]))
                                                <Link href="{{ route('website.lttq.invoice', ['uuid' => $data_transaksi['transaksi'.$item->id] ]) }}"
                                                    class="text-sm flex font-semibold border rounded-lg py-1.5 px-3 bg-yellow-400  text-white ">
                                                    Konfirmasi Pembayaran
                                                    <x-carbon-arrow-right class="w-5 h-5 ml-2 "/>
                                                </Link>
                                            @endif
                                            @if ($item->status_pendaftaran == 'belum pilih jadwal')
                                                <span class="text-gray-800 text-xs px-2 py-0 sm:py-1 font-semibold rounded-xl">
                                                    Dimohon Segera Memilih Jadwal
                                                </span>
                                                <Link away href="{{ route('dashboard.peserta.daftar-jadwal', ['peserta' => $item->uuid ]) }}"
                                                    class="text-sm flex font-semibold border rounded-lg py-1.5 px-3 bg-primary-700 text-white">
                                                    Pilih Jadwal Sekarang
                                                    <x-carbon-arrow-right class="w-5 h-5 ml-2 "/>
                                                </Link>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </li>
                        @empty
                            <li class="p-4">
                                Belum Ada Data Peserta
                            </li>
                        @endforelse
                    </x-splade-lazy>
                </ul>
            </div>
            <div class="flow-root py-4">
                {{ $data_peserta->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
