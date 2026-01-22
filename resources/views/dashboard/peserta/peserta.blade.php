<x-app-layout>
    <div class="pt-4 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="grid grid-cols-1 md:grid-cols-3 md:gap-4 dark:bg-gray-900">
                <!-- Right Content -->
                <div class="col-span-full sm:col-auto">
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg  2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <div class="items-center flex space-x-4">
                            <x-carbon-user-avatar-filled-alt class="w-16 text-primary-700"/>
                            <div>
                                <h3 class="mb-1 text-sm font-medium uppercase text-gray-700 ">Peserta {{ $data_peserta->periode->unit->nama }}</h3>
                                <div class="mb-1 text-md font-bold text-gray-900 uppercase">
                                    {{ $data_peserta->peserta->nama }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg  2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        {{-- <h3 class="mb-4 text-xl font-semibold ">Biodata</h3> --}}
                        <ul class="grid grid-cols-6 gap-2  dark:divide-gray-700">
                            <li class="col-span-3 py-2">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-normal text-gray-500 truncate ">
                                            NIS
                                        </p>
                                        <p class="text-base font-semibold text-gray-900 truncate uppercase">
                                            {{ $data_peserta->nis_peserta }}
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
                                    <div class="flex flex-col">
                                        <p class="text-sm font-medium text-gray-700">Jadwal</p>
                                        <p class="text-md font-bold text-gray-800">{{ $data_peserta->jadwal->nama_jadwal ?? '-' }}</p>
                                    </div>
                                    {{-- <div class="flex items-center justify-between uppercase pb-4">
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
                                    </div> --}}
                                @else
                                    <div class="text-center">Belum Memilih Jadwal</div>
                                @endif
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <Link href="#modal-kartu-ujian" class="border p-2  rounded-lg bg-primary-700">
                                    <p class="text-sm font-medium text-white flex">Akses Kartu Ujian <x-carbon-document-requirements class="w-5 h-5 ml-2 "/></p>
                                </Link>
                            </div>

                            <x-splade-modal name="modal-kartu-ujian">
                                <div class="flex items-center justify-center my-6">
                                    <div class="items-center justify-center text-base font-semibold text-gray-900">
                                        @php
                                            $jumlah_item_biaya = 0;
                                            $jumlah_item_biaya_terbayar = 0;
                                        @endphp
                                        @foreach ($data_biaya as $item_biaya)
                                            @php
                                                $jumlah_item_biaya += 1;
                                            @endphp
                                            @forelse ($data_pembayaran_peserta as $item_pembayaran)
                                                @if ($item_biaya->id == $item_pembayaran->biaya_id)
                                                    @if ($item_pembayaran->transaksi->status == 1)
                                                        @php
                                                            // Menunggu Pembayaran
                                                            // $jumlah_item_biaya_terbayar += 1;
                                                        @endphp
                                                    @elseif ($item_pembayaran->transaksi->status == 2)
                                                        @php
                                                            // Menunggu Konfirmasi
                                                            $jumlah_item_biaya_terbayar += 1;
                                                        @endphp
                                                    @elseif ($item_pembayaran->transaksi->status == 3)
                                                        @php
                                                            // Lunas
                                                            $jumlah_item_biaya_terbayar += 1;
                                                        @endphp
                                                    @elseif ($item_pembayaran->transaksi->status == 4)
                                                        @php
                                                            // Kadaluarsa
                                                        @endphp
                                                    @endif
                                                @endif
                                            @empty
                                                -
                                            @endforelse
                                        @endforeach
                                        @if ($jumlah_item_biaya == $jumlah_item_biaya_terbayar)
                                            <span class="text-gray-500 text-xs py-0 sm:py-1 font-semibold rounded-xl">
                                                Klik Untuk Melihat Kartu Ujian
                                            </span>
                                            <a target="_blank" href="{{ route('website.lttq.tahsin.kartu-ujian', ['uuid' => $data_peserta->uuid ]) }}"
                                                class="text-sm flex justify-between font-semibold border rounded-md py-1.5 px-3 bg-sky-600 text-white">
                                                Download Kartu Ujian
                                                <x-carbon-document-requirements class="w-5 h-5 ml-2 "/>
                                            </a>

                                        @else
                                            <div>
                                                <span class="text-gray-500 text-xs py-0 sm:py-1 font-semibold rounded-xl">
                                                    Anda Belum Menyelesaikan Semua Pembayaran
                                                </span>
                                                <Link away href="{{ route('dashboard.peserta.pembayaran.form', ['uuid' => $data_peserta->uuid ]) }}"
                                                    class="text-sm flex justify-between font-semibold border rounded-lg py-1.5 px-3 bg-red-400 text-white">
                                                    Klik Form Pembayaran
                                                    <x-carbon-arrow-right class="w-5 h-5 ml-2 "/>
                                                </Link>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </x-splade-modal>

                            <h3 class="text-md py-2 text-gray-500 font-semibold uppercase">Absensi</h3>
                            <div class="relative overflow-x-auto border rounded-md mb-4 bg-white">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead>
                                        <tr class="border-b border-gray-200 ">
                                            @for ($i = 1; $i <= 16; $i++)
                                                <th scope="col"
                                                    class="px-3 py-3 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                                    {{ $i }}
                                                </th>
                                            @endfor
                                            <th scope="col" class="border-x text-center p-1 uppercase">
                                                Mengikuti Ujian
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-gray-700 border-b border-gray-200 py-2">
                                            @php
                                                $total_hadir = 0;
                                            @endphp
                                            @for($i = 1; $i <= 16; $i++)
                                                <td class="text-center p-2 uppercase">
                                                    @if (isset($data_absensi_peserta[$data_peserta->id.'-'.$i]))
                                                        @if ($data_absensi_peserta[$data_peserta->id.'-'.$i] == 1)
                                                            @php
                                                                $total_hadir += 1;
                                                            @endphp
                                                            <x-carbon-checkmark class="w-6 h-6 text-sky-500" />
                                                        @elseif ($data_absensi_peserta[$data_peserta->id.'-'.$i] == 2)
                                                            <x-carbon-close-filled class="w-6 h-6 text-red-600" />
                                                        @elseif ($data_absensi_peserta[$data_peserta->id.'-'.$i] == 3 || $data_absensi_peserta[$data_peserta->id.'-'.$i] == 4)
                                                            <x-carbon-close-filled class="w-6 h-6 text-yellow-300" />
                                                        @else
                                                            -
                                                        @endif
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            @endfor
                                            <td class="border-x text-center p-1 uppercase text-xs font-bold ">
                                                @if ($total_hadir >= 10)
                                                    BOLEH
                                                @else
                                                    BELUM
                                                    {{-- <Link href="#" class=" text-primary-600 border border-primary-600 rounded-md px-2 py-1">
                                                        <x-carbon-checkmark class="w-4 h-4 text-primary-600" />
                                                    </Link> --}}
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mb-6">
                                <table class="w-4/5 sm:w-2/5 text-sm text-left border-gray-200">
                                    <tbody>
                                        <tr class="border-b border-gray-200">
                                            <td class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                                Total Kehadiran
                                            </td>
                                            <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                                {{ $total_hadir }}
                                            </td>
                                        </tr>
                                        <tr class="border-b border-gray-200">
                                            <td class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                                Hasil Ujian
                                            </td>
                                            <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                                {{-- {{ isset($data_peserta->data_nilai['ujian']) ? $data_peserta->levelTahsin($data_peserta->data_nilai['ujian']) : '-' }} --}}
                                                -
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>



                            <h3 class="text-md py-2 text-gray-500 font-semibold uppercase">Data Pembayaran</h3>
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
                                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                                    {{ $item_biaya->nama }}
                                                </td>
                                                <td class="px-3 py-3 uppercase">
                                                    @forelse ($data_pembayaran_peserta as $item_pembayaran)
                                                        @if ($item_biaya->id == $item_pembayaran->biaya_id)
                                                            @if ($item_pembayaran->transaksi->status == 1)
                                                                <span class="bg-yellow-300 text-gray-900 px-2 py-1 rounded text-xs">Menunggu Pembayaran</span>
                                                            @elseif ($item_pembayaran->transaksi->status == 2)
                                                                <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Menunggu Konfirmasi</span>
                                                            @elseif ($item_pembayaran->transaksi->status == 3)
                                                                <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">LUNAS</span>
                                                            @elseif ($item_pembayaran->transaksi->status == 4)
                                                                <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Kadaluarsa</span>
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
                                                Invoice
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3 font-bold text-gray-900 whitespace-nowrap bg-gray-50  dark:bg-gray-800">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_transaksi as $item_transaksi)
                                            <tr class="border-b text-sm border-gray-200 dark:border-gray-700">
                                                <td class="px-3 py-3">
                                                    <Link class="text-sm font-bold text-gray-900 border border-gray-800 p-1 rounded-sm" href="{{ route('dashboard.peserta', ['uuid' => $item_transaksi->uuid ]) }}">
                                                        {{ \Carbon\Carbon::parse($item_transaksi->created_at)->format('Ymd') }}-{{ $item_transaksi->id}}
                                                    </Link>
                                                </td>
                                                <td class="px-3 py-3">
                                                    @if ($item_transaksi->status == 1)
                                                        <span class="bg-yellow-300 text-gray-900 px-2 py-1 rounded text-xs">Menunggu Pembayaran</span>
                                                    @elseif ($item_transaksi->status == 2)
                                                        <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs">Menunggu Konfirmasi</span>
                                                    @elseif ($item_transaksi->status == 3)
                                                        <span class="bg-green-500 text-white px-2 py-1 rounded text-xs">LUNAS</span>
                                                    @elseif ($item_transaksi->status == 4)
                                                        <span class="bg-red-500 text-white px-2 py-1 rounded text-xs">Kadaluarsa</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
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
