<x-layouts.main :unit="$unit">

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            Periode {{ $unit }}  Angkatan {{ $dataperiode->angkatan }}, Tahun {{ $dataperiode->tahun_ajaran }}
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        @include('dashboard.admin.periode.menu')
        <div class="px-3 w-full">
            <div class="items-center justify-end flex space-x-2">
                <a href="{{ route('admin.transaksi.export', ['unit' => $unit, 'periode' => $periode]) }}" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                    Export
                    @svg('carbon-download', 'ml-2 text-white h-4 w-4')
                </a>
                <Link modal max-width="lg" href="{{ route('admin.jadwal.create', ['unit' => $unit, 'periode' => $periode]) }}" class="text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                    Tambah Data
                    @svg('carbon-add-filled', 'ml-2 text-white h-4 w-4')
                </Link>
            </div>
            <div class="container mx-auto">
                <x-splade-form method="GET" class="sm:flex items-center sm:space-x-2 border border-gray-300 rounded-lg p-2 mb-2"
                    :default="[
                            'cari' => request()->query('cari') ?? '',
                            'jenis_peserta' => request()->query('jenis_peserta') ?? '',
                            'status' => request()->query('status') ?? '',
                            'peserta' => request()->query('peserta') ?? '',
                        ],
                    ">
                    <x-splade-input value="{{ request()->query('cari') }}" name="cari" placeholder="Cari" class="flex-grow"/>
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
                    <x-splade-select name="status">
                        <option value="" disabled selected>-- Status</option>
                        <option value="1">Menunggu Pembayaran</option>
                        <option value="2">Menunggu Konfirmasi</option>
                        <option value="3">Lunas</option>
                        <option value="4">Kadaluarsa</option>
                        <option value="">Semua</option>
                    </x-splade-select>
                    <x-splade-input value="{{ request()->query('tanggal') }}" name="tanggal" placeholder="Tanggal" date range/>
                    <x-splade-submit :label="__('Cari')"/>
                </x-splade-form>
            </div>
            <div class="relative overflow-x-auto border rounded-md mb-4 bg-white">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead>
                        <tr class="border-b border-gray-200 ">
                            <th scope="col" class="p-4 uppercase">
                                INVOICE
                            </th>
                            <th scope="col" class="uppercase">
                                Peserta
                            </th>
                            <th scope="col" class="uppercase">
                                Jadwal
                            </th>
                            <th scope="col" class="uppercase">
                                Status
                            </th>
                            <th scope="col" class="uppercase">
                                Total Biaya
                            </th>
                            <th scope="col" class="uppercase">
                                Total Transfer
                            </th>
                            <th scope="col" class="uppercase">
                                Bukti
                            </th>
                            <th scope="col" class="uppercase">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_transaksi as $item)
                            <tr class="text-gray-700 border-b border-gray-200 py-4">
                                <td class="p-4 uppercase font-semibold">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('Ymd') }}-{{ $item->id}}
                                </td>
                                <td class="uppercase">
                                    <Link href="{{ route('admin.peserta.show', ['unit' => $item->periode->unit->slug, 'periode' => $item->periode->id, 'peserta' => $item->kelas->id]) }}" class="text-gray-500 font-semibold">
                                        {{ $item->kelas->nis_peserta }} - {{ $item->kelas->peserta->nama }}
                                    </Link>
                                </td>
                                <td class="uppercase">
                                    {{ $item->kelas->jadwal ? $item->kelas->jadwal->nama_jadwal : '' }}
                                </td>
                                <td class="uppercase">
                                    @if ($item->status == 1)
                                        <span class="bg-yellow-300 text-gray-900 px-2 py-1 text-xs font-semibold rounded-xl">Menunggu Pembayaran</span>
                                    @elseif ($item->status == 2)
                                        <span class="bg-blue-500 text-white px-2 py-1 text-xs font-semibold rounded-xl">Menunggu Konfirmasi</span>
                                    @elseif ($item->status == 3)
                                        <span class="bg-green-500 text-white px-2 py-1 text-xs font-semibold rounded-xl">Lunas</span>
                                    @elseif ($item->status == 4)
                                        <span class="bg-red-500 text-white px-2 py-1 text-xs font-semibold rounded-xl">Kadaluarsa</span>
                                    @else
                                        <span class="bg-gray-500 text-white px-2 py-1 text-xs font-semibold rounded-xl">Batal</span>
                                    @endif
                                </td>
                                <td class="uppercase">
                                    Rp. {{ number_format($item->nominal_total, 0, ',', '.') }}
                                </td>
                                <td class="uppercase">
                                    Rp. {{ number_format($item->nominal_total_pembayaran, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    @if ($item->status != 1)
                                    {{-- <Link modal href="{{ route('admin.transaksi.bukti-transfer', ['unit' => $unit, 'periode' => $periode, 'transaksi' => $item->id]) }}"
                                        class="text-white bg-gray-500 font-medium rounded-lg text-xs px-2 py-1 "
                                        >
                                        Lihat Bukti
                                    </Link> --}}
                                    <x-splade-toggle>
                                        <button @click.prevent="toggle" class="text-white bg-gray-500 font-medium rounded-lg text-xs px-2 py-1">Lihat Bukti</button>
                                        <div v-show="toggled">
                                            @if (isset($item->data_pembayaran['bukti_transfer']))
                                                <img src="{{ Storage::url($item->data_pembayaran['bukti_transfer']) }}" alt="bukti transfer" class="w-52" />
                                            @else
                                                Data kosong
                                            @endif
                                            <button @click.prevent="setToggle(false)" class="text-white bg-red-500 font-medium rounded-lg text-xs px-2 py-1">Tutup</button>
                                        </div>
                                    </x-splade-toggle>
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center justify-center">
                                        @if ($item->status == 1)
                                            <Link href="{{ route('admin.transaksi.konfirmasi', ['unit' => $unit, 'periode' => $periode, 'transaksi' => $item->id])}}" class="relative text-white border border-yellow-400 bg-yellow-400 rounded-md p-2 mr-2">
                                                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full">0</span>
                                                <span class="absolute top-0 right-4 inline-flex items-center justify-center px-1 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-sky-500 rounded-full">0</span>
                                                <x-carbon-notification class="w-4 h-4 mr-1 text-white"/>
                                            </Link>
                                        @endif
                                        <a href="{{ route('website.lttq.invoice', ['uuid' => $item->uuid]) }}" target="_blank" class="text-primary-700 border border-primary-700 rounded-md p-2">
                                            <x-carbon-view class="w-4 h-4 text-primary-700"/>
                                        </a>
                                        @if ($item->status == 2)
                                            <Link href="{{ route('admin.transaksi.konfirmasi', ['unit' => $unit, 'periode' => $periode, 'transaksi' => $item->id])}}" class="text-white border border-sky-500 bg-sky-500 rounded-md p-2 ml-2">
                                                <x-carbon-checkmark class="w-4 h-4 text-white"/>
                                            </Link>
                                        @endif
                                        <Link href="{{ route('admin.transaksi.show', ['unit' => $unit, 'periode' => $periode, 'transaksi' => $item->id]) }}" target="_blank" class="text-yellow-500 border border-yellow-500 rounded-md p-2 ml-2">
                                            <x-carbon-edit class="w-4 h-4 text-yellow-500"/>
                                        </Link>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-2 text-xs text-gray-500">
                {{ $data_transaksi->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-layouts.main>
