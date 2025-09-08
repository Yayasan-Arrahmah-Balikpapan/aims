<x-layouts.main :unit="$unit ?? null">
    <x-layouts.card>
        <x-layouts.title>Data Peserta Baru</x-layouts.title>
        <div class="mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 md:gap-4 dark:bg-gray-900">
                <div class="col-span-full sm:col-auto">
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg  2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <div class="items-center flex space-x-4">
                            <x-carbon-user-avatar-filled-alt class="w-20 h-20 text-primary-700"/>
                            <div>
                                <h3 class="mb-1 text-xl font-bold text-gray-900 ">Peserta</h3>
                                <div class="mb-1 text-sm text-gray-500 uppercase">
                                    {{ $data_peserta->peserta->nama }}
                                </div>
                                <div class="mb-4 text-sm text-gray-500 ">
                                    {{ $data_peserta->peserta->phone_number }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg  2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <h3 class="mb-4 text-xl font-semibold ">Biodata</h3>
                        <ul class="grid grid-cols-6 gap-2  dark:divide-gray-700">
                            <li class="col-span-3 py-2">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-normal text-gray-500 truncate ">
                                            Nama
                                        </p>
                                        <p class="text-base font-semibold text-gray-900 truncate uppercase">
                                            {{ $data_peserta->peserta->nama }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="col-span-3 py-2">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-normal text-gray-500 truncate ">
                                            Tanggal Lahir
                                        </p>
                                        <p class="text-base font-semibold text-gray-900 truncate ">
                                            {{ $data_peserta->peserta->tanggal_lahir }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="col-span-3 py-2">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-normal text-gray-500 truncate ">
                                            Jenis Peserta
                                        </p>
                                        <p class="text-base font-semibold text-gray-900 truncate uppercase ">
                                            {{ $data_peserta->peserta->jenis_peserta }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="col-span-3 py-2">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-normal text-gray-500 truncate ">
                                            Kota
                                        </p>
                                        <p class="text-base font-semibold text-gray-900 truncate ">
                                            {{ $data_peserta->peserta->biodata['kota_domisili'] ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="col-span-3 py-2">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-normal text-gray-500 truncate ">
                                            Pekerjaan
                                        </p>
                                        <p class="text-base font-semibold text-gray-900 truncate ">
                                            {{ $data_peserta->peserta->biodata['pekerjaan'] ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="col-span-3 py-2">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-normal text-gray-500 truncate ">
                                            Alamat
                                        </p>
                                        <p class="text-base font-semibold text-gray-900 truncate ">
                                            {{ $data_peserta->peserta->biodata['alamat'] ?? '-' }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.card>
    <div class="p-4 mb-4">
        <div class="items-center">
            <Link href="{{ route('penguji.peserta-baru.data', ['unit' => $unit, 'periode' => $data_periode->id]) }}"
                class="border border-gray-400 bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                <x-carbon-arrow-left class="w-5 h-5 mr-2"/>
                Kembali Ke Data
            </Link>
        </div>
    </div>

</x-layouts.main>

