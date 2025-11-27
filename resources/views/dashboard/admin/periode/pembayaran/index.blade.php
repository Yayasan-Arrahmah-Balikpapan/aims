<x-layouts.main :unit="$unit">

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            Periode {{ $unit }}  Angkatan {{ $dataperiode->angkatan }}, Tahun {{ $dataperiode->tahun_ajaran }}
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        @include('dashboard.admin.periode.menu')
        <div class="px-3 w-full">
            <div class="w-full mb-4">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6  gap-4">
                    <div class="bg-white p-4 space-y-6 rounded-lg shadow-md border border-green-500">
                        <h5 class="text-md text-green-500 font-bold">Akumulasi Pendapatan</h5>
                        <p class="text-xl font-bold text-gray-600">Rp. {{ number_format($total_biaya_seluruh_peserta ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white p-4 space-y-6 rounded-lg shadow-md border border-blue-500">
                        <h5 class="text-md text-blue-500 font-bold">Total Pembayaran</h5>
                        <p class="text-xl font-bold text-gray-600">Rp. {{ number_format($data_nominal['jumlah_nominal_transfer'] ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white p-4 space-y-6 rounded-lg shadow-md border border-yellow-500">
                        <h5 class="text-md text-yellow-500 font-bold">Total Potongan</h5>
                        <p class="text-xl font-bold text-gray-600">Rp. {{ number_format($data_nominal['jumlah_nominal_potongan'] ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white p-4 space-y-6 rounded-lg shadow-md border border-gray-500">
                        <h5 class="text-md text-gray-500 font-bold">Total Donasi</h5>
                        <p class="text-xl font-bold text-gray-600">Rp. {{ number_format($data_nominal['jumlah_nominal_donasi'] ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white p-4 space-y-6 rounded-lg shadow-md border border-gray-500">
                        <h5 class="text-md text-gray-500 font-bold">Total Kode Unik</h5>
                        <p class="text-xl font-bold text-gray-600">Rp. {{ number_format($data_nominal['jumlah_nominal_kodeunik'] ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-white p-4 space-y-6 rounded-lg shadow-md border border-red-500">
                        <h5 class="text-md text-red-500 font-bold">Total Piutang</h5>
                        <p class="text-xl font-bold text-red-700">Rp. {{ number_format($jumlah_nominal_piutang ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="items-center justify-end flex space-x-2">
                <a href="{{ route('admin.pembayaran.export', ['unit' => $unit, 'periode' => $periode]) }}" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                    Export
                    @svg('carbon-download', 'ml-2 text-white h-4 w-4')
                </a>
                <Link modal max-width="lg" href="{{ route('admin.jadwal.create', ['unit' => $unit, 'periode' => $periode]) }}" class="text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                    Tambah Data
                    @svg('carbon-add-filled', 'ml-2 text-white h-4 w-4')
                </Link>
            </div>
            <div class="w-full">
                <x-splade-form method="GET" class="sm:flex items-center sm:space-x-2 border border-gray-300 rounded-lg p-2 mb-2"
                    :default="[
                            'cari' => request()->query('cari') ?? '',
                            'jenis_peserta' => request()->query('jenis_peserta') ?? '',
                            'status' => request()->query('status') ?? '',
                            'peserta' => request()->query('peserta') ?? '',
                            'level' => request()->query('level') ?? '',
                        ],
                    ">
                    <x-splade-input value="{{ request()->query('cari') }}" name="cari" placeholder="Nama Peserta" class="flex-grow"/>
                    <x-splade-select name="jenis_peserta">
                        <option value="" disabled selected>-- Jenis</option>
                        <option value="ikhwan">Ikhwan</option>
                        <option value="akhwat">Akhwat</option>
                        <option value="">Semua</option>
                    </x-splade-select>
                    <x-splade-select name="peserta">
                        <option value="" disabled selected>-- Peserta</option>
                        <option value="baru">Baru</option>
                        <option value="melanjutkan">Daftar Ulang</option>
                        <option value="">Semua</option>
                    </x-splade-select>
                    <x-splade-select name="level">
                        <option value="" disabled selected>-- Level</option>
                        @foreach ( $data_level as $level )
                            <option value="{{ $level->id }}">{{ $level->nama }}</option>
                        @endforeach
                        <option value="">Semua</option>
                    </x-splade-select>
                    <x-splade-select name="status">
                        <option value="" disabled selected>-- Status</option>
                        <option value="belum diberikan level">Belum Diberikan Level</option>
                        <option value="belum pilih jadwal">Belum Pilih Jadwal</option>
                        <option value="selesai pilih jadwal">Selesai Pilih Jadwal</option>
                        <option value="">Semua</option>
                    </x-splade-select>
                    <x-splade-submit :label="__('Cari')"/>
                </x-splade-form>
            </div>
            <div class="flex justify-end text-sm py-2 font-medium text-gray-500">
                Data diupdate: {{ \Carbon\Carbon::parse($expiration_time)->subDays(7)->format('d F Y, H:i') }} WITA
            <div class="flex justify-end text-sm">
                <Link href="{{ route('admin.pembayaran.reset-data', ['unit' => $unit, 'periode' => $periode]) }}" class="text-blue-500 hover:text-blue-700 focus:underline focus:ring-4 focus:ring-blue-300">
                    @svg('carbon-reset', 'ml-2 text-blue-500 h-5 w-5')
                </Link>
            </div>
            </div>
            <div class="relative overflow-x-auto border rounded-md mb-4 bg-white">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead>
                        <tr class="border-b border-gray-200 ">
                            <th scope="col" class="p-4 uppercase">
                                NIS
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase">
                                Peserta
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase">
                                Jadwal
                            </th>
                            @foreach($data_biaya as $item_biaya)
                                <th scope="col" class="py-4 px-2 uppercase">
                                    {{ $item_biaya->nama }}
                                </th>
                            @endforeach
                            {{-- <th scope="col" class="py-4 px-2 uppercase text-center">
                                Total Pembayaran
                            </th> --}}
                            <th scope="col" class="py-4 px-2 uppercase text-center">
                                Kode Unik
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase text-center">
                                Potongan
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase text-center">
                                Donasi
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase text-center text-red-600">
                                Piutang
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase text-center">
                                Total Pembayaran
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_peserta as $item)
                            @php
                                $total_pembayaran = 0;
                            @endphp
                            <tr class="text-gray-700 border-b border-gray-200 py-4">
                                <td class="p-2 uppercase font-semibold">
                                    {{ $item->nis_peserta }}
                                </td>
                                <td class="p-2 uppercase">
                                    {{ $item->peserta->nama }}
                                </td>
                                <td class="p-2 uppercase text-xs">
                                    {{ $item->jadwal->nama_jadwal ?? '' }}
                                </td>
                                @foreach($data_biaya as $item_biaya_)
                                    <td class="p-2 uppercase">
                                        @if(isset($data_pembayaran_peserta[$item->id][$item_biaya_->id]))
                                            @php
                                                $total_pembayaran += $data_pembayaran_peserta[$item->id][$item_biaya_->id];
                                            @endphp
                                            Rp. {{ number_format($data_pembayaran_peserta[$item->id][$item_biaya_->id], 0, ',', '.') }}
                                        @else
                                            Rp. 0
                                        @endif
                                    </td>
                                @endforeach
                                {{-- <td class="p-2 uppercase text-center">
                                    Rp. {{ number_format($total_pembayaran, 0, ',', '.') }}
                                </td> --}}
                                <td class="p-2 uppercase text-center">
                                    Rp. {{ number_format($data_transaksi_peserta[$item->id]['kode_unik'] ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="p-2 uppercase text-center">
                                    Rp. {{ number_format($data_transaksi_peserta[$item->id]['potongan'] ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="p-2 uppercase text-center">
                                    Rp. {{ number_format($data_transaksi_peserta[$item->id]['donasi'] ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="p-2 uppercase text-center text-red-600">
                                    @php
                                        $piutang = $total_biaya_periode - $total_pembayaran;
                                    @endphp
                                    Rp. {{ number_format($piutang ?? 0, 0, ',', '.') }}
                                </td>
                                <td class="p-2 uppercase text-center">
                                    Rp. {{ number_format($data_transaksi_peserta[$item->id]['nominal_total_pembayaran'] ?? 0, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <th class="text-white">a</th>
                        </tr>
                        <tr>
                            <th class="text-white">a</th>
                        </tr>
                        <tr class="border-b border-gray-200 ">
                            <th scope="col" class="p-4 uppercase">
                                Total
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase">
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase">
                            </th>
                            @foreach($data_biaya as $item_biaya)
                                <th scope="col" class="py-4 px-2 uppercase">
                                    Rp. {{ $sum_data_biaya[$item_biaya->id] ? number_format($sum_data_biaya[$item_biaya->id], 0, ',', '.') : '0' }}
                                </th>
                            @endforeach
                            {{-- <th scope="col" class="py-4 px-2 uppercase text-center">
                                Rp. {{ $data_nominal['jumlah_nominal_biaya'] ? number_format($data_nominal['jumlah_nominal_biaya'], 0, ',', '.') : '0' }}
                            </th> --}}
                            <th scope="col" class="py-4 px-2 uppercase text-center">
                                Rp. {{ $data_nominal['jumlah_nominal_kodeunik'] ? number_format($data_nominal['jumlah_nominal_kodeunik'], 0, ',', '.') : '0' }}
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase text-center">
                                Rp. {{ $data_nominal['jumlah_nominal_potongan'] ? number_format($data_nominal['jumlah_nominal_potongan'], 0, ',', '.') : '0' }}
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase text-center">
                                Rp. {{ $data_nominal['jumlah_nominal_donasi'] ? number_format($data_nominal['jumlah_nominal_donasi'], 0, ',', '.') : '0' }}
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase text-center text-red-600">
                                Rp. {{ number_format($jumlah_nominal_piutang ?? 0, 0, ',', '.') }}
                            </th>
                            <th scope="col" class="py-4 px-2 uppercase text-center">
                                Rp. {{ $data_nominal['jumlah_nominal_transfer'] ? number_format($data_nominal['jumlah_nominal_transfer'], 0, ',', '.') : '0' }}
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="p-2 mt-2 text-xs text-gray-500">
                {{ $data_peserta->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-layouts.main>
