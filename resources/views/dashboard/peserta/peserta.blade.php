<x-app-layout>
    <div class="pt-4 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="grid grid-cols-1 md:grid-cols-3 md:gap-4 dark:bg-gray-900">
                <!-- Right Content -->
                <div class="col-span-full sm:col-auto">
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg  2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <div class="items-center flex space-x-4">
                            <x-carbon-user-avatar-filled-alt class="w-20 h-20 text-primary-700"/>
                            <div>
                                <h3 class="mb-1 text-xl font-bold text-gray-900 ">Peserta {{ $data_peserta->periode->unit->nama }}</h3>
                                <div class="mb-1 text-sm text-gray-500 uppercase">
                                    {{ $data_peserta->peserta->nama }}
                                </div>
                                <div class="mb-4 text-sm text-gray-500 ">
                                    {{ $data_peserta->nis_peserta }}
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
                                        <p class="text-base font-semibold text-gray-900 truncate uppercase">
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
                                            {{ isset($data_peserta->peserta->biodata['kota_domisili']) ? $data_peserta->peserta->biodata['kota_domisili'] : '' }}
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
                                            {{ isset($data_peserta->peserta->biodata['pekerjaan']) ? $data_peserta->peserta->biodata['pekerjaan'] : '' }}
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
                                            {{ isset($data_peserta->peserta->biodata['alamat']) ? $data_peserta->peserta->biodata['alamat'] : '' }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-span-full">
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg  2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <div class="flow-root">
                            <h3 class="text-xl font-semibold ">{{ $data_peserta->periode->unit->nama }} {{ $data_peserta->periode->nama }}</h3>
                            <div class="border my-2 p-4 rounded-lg">
                                @if ($data_peserta->jadwal)
                                    <div class="flex items-center justify-between uppercase pb-4">
                                        <div class="flex flex-col">
                                            <p class="text-sm font-medium text-gray-700">Pengajar</p>
                                            <p class="text-md font-bold text-gray-800">{{ $data_peserta->jadwal->pengajar->kode_nama_pengajar ?? '-' }}</p>
                                        </div>
                                        <div class="flex flex-col">
                                            <p class="text-sm font-medium text-gray-700">Kategori</p>
                                            <p class="text-md font-bold text-gray-800">{{ $data_peserta->periode->kategori }}</p>
                                        </div>
                                        <div class="flex flex-col">
                                            <p class="text-sm font-medium text-gray-700">Belajar</p>
                                            <p class="text-md font-bold text-gray-800">{{ $data_peserta->jadwal->status_belajar ?? '-' }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between uppercase">
                                        <div class="flex flex-col">
                                            <p class="text-sm font-medium text-gray-700">Hari</p>
                                            <p class="text-md font-bold text-gray-800">{{ $data_peserta->jadwal->hari_belajar ?? '-' }}</p>
                                        </div>
                                        <div class="flex flex-col">
                                            <p class="text-sm font-medium text-gray-700">Waktu </p>
                                            <p class="text-md font-bold text-gray-800">{{ $data_peserta->jadwal->jam_mulai }} WITA</p>
                                        </div>
                                        <div class="flex flex-col">
                                            <p class="text-sm font-medium text-gray-700">Level</p>
                                            <p class="text-md font-bold text-gray-800">{{ $data_peserta->jadwal->level ? $data_peserta->jadwal->level->nama : '-' }}</p>
                                        </div>

                                    </div>
                                @else
                                    <div class="text-center">Belum Memilih Jadwal</div>
                                @endif
                            </div>
                            <h3 class="text-md py-2 text-gray-500 font-semibold uppercase">Absensi</h3>
                            <div class="relative overflow-x-auto border rounded-md mb-4">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                                    <thead>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            @for ($i = 1; $i <= 16; $i++)
                                                <th scope="col"
                                                    class="px-3 py-3 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50  dark:bg-gray-800">
                                                    {{ $i }}
                                                </th>
                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        @for ($i = 1; $i <= 16; $i++)
                                                <td class="px-3 py-3 text-center">
                                                    -
                                                </td>
                                            @endfor
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <h3 class="text-md py-2 text-gray-500 font-semibold uppercase">Pembayaran</h3>
                            <div class="relative overflow-x-auto border rounded-md mb-4">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                                    <thead>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="col"
                                                class="px-3 py-3 font-bold text-gray-900 whitespace-nowrap bg-gray-50  dark:bg-gray-800">
                                                Jenis Pembayaran
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3 font-bold text-gray-900 whitespace-nowrap bg-gray-50  dark:bg-gray-800">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_biaya as $item_biaya)
                                            <tr class="border-b text-sm border-gray-200 dark:border-gray-700">
                                                <td class="px-3 py-3 uppercase">
                                                    {{ $item_biaya->nama }}
                                                </td>
                                                <td class="px-3 py-3 uppercase">
                                                    @forelse ($data_pembayaran_peserta as $item_pembayaran)
                                                        @if ($item_biaya->id == $item_pembayaran->biaya_id)
                                                            @if ($item_pembayaran->transaksi->status == 1)
                                                                Menunggu Pembayaran
                                                            @elseif ($item_pembayaran->transaksi->status == 2)
                                                                Menunggu Konfirmasi
                                                            @elseif ($item_pembayaran->transaksi->status == 3)
                                                                Lunas
                                                            @elseif ($item_pembayaran->transaksi->status == 4)
                                                                BELUM LUNAS
                                                            @endif
                                                        @endif
                                                    @empty
                                                        BELUM LUNAS
                                                    @endforelse
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <h3 class="text-md py-2 text-gray-500 font-semibold uppercase">Riwayat Pembayaran</h3>
                            <div class="relative overflow-x-auto border rounded-md mb-4">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                                    <thead>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="col"
                                                class="px-3 py-3 font-bold text-gray-900 whitespace-nowrap bg-gray-50  dark:bg-gray-800">
                                                Pembayaran
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3 font-bold text-gray-900 whitespace-nowrap bg-gray-50  dark:bg-gray-800">
                                                Tanggal Bayar
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3 font-bold text-gray-900 whitespace-nowrap bg-gray-50  dark:bg-gray-800">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
