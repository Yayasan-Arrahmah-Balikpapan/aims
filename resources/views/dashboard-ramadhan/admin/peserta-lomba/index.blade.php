<x-layouts.main>

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            Peserta Lomba
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        <div class="px-3 w-full">
            <div class="w-full mb-4">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4  gap-4">
                    <div class="bg-white p-4 space-y-6 rounded-lg shadow-md border border-gray-500">
                        <h5 class="text-md text-gray-500 font-bold">Total Pendaftar</h5>
                        <p class="text-xl font-bold text-gray-600">{{ $total_pendaftar }}</p>
                    </div>
                    <div class="bg-white p-4 space-y-6 rounded-lg shadow-md border border-green-500">
                        <h5 class="text-md text-green-500 font-bold">Total Peserta</h5>
                        <p class="text-xl font-bold text-gray-600">{{ $total_peserta }}</p>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2  gap-4">
                <div class="bg-white rounded-lg p-4 ">
                    <h3 class="text-xl font-bold">Peserta Lomba Menggambar & Mewarnai - {{ $data_per_cabang[1] + $data_per_cabang[2] }}</h3>
                    <table class="w-full text-sm text-left border-gray-200">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                </th>
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    Pendaftar
                                </th>
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    Peserta
                                </th>
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-200">
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                    Kategori A
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[1] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang[1] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[1]+$data_per_cabang[1] }}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                    Kategori B
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[2] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang[2] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[2]+$data_per_cabang[2] }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bg-white rounded-lg p-4 ">
                    <h3 class="text-xl font-bold">Peserta Cerdas Cermat - {{ $data_per_cabang[9] + $data_per_cabang[10] }}</h3>
                    <table class="w-full text-sm text-left border-gray-200">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                </th>
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    Pendaftar
                                </th>
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    Peserta
                                </th>
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-200">
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                    Kategori SD
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[9] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang[9] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[9]+$data_per_cabang[9] }}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                    Kategori SMP
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[10] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang[10] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[10]+$data_per_cabang[10] }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bg-white rounded-lg p-4 ">
                    <h3 class="text-xl font-bold">Peserta Lomba Adzan & Iqomah - {{ $data_per_cabang[3] + $data_per_cabang[4] + $data_per_cabang[5] }}</h3>
                    <table class="w-full text-sm text-left border-gray-200">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                </th>
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    Pendaftar
                                </th>
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    Peserta
                                </th>
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-200">
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                    Kategori A
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[3] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang[3] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[3]+$data_per_cabang[3] }}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                    Kategori B
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[4] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang[4] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[4]+$data_per_cabang[4] }}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                    Kategori C
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[5] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang[5] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[5]+$data_per_cabang[5] }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="bg-white rounded-lg p-4 ">
                    <h3 class="text-xl font-bold">Peserta Lomba Tahfidz - {{ $data_per_cabang[6] + $data_per_cabang[7] + $data_per_cabang[8] }}</h3>
                    <table class="w-full text-sm text-left border-gray-200">
                        <thead>
                            <tr class="border-b border-gray-200">
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                </th>
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    Pendaftar
                                </th>
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    Peserta
                                </th>
                                <th class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-gray-200">
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                    Kategori A
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[6] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang[6] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[6]+$data_per_cabang[6] }}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                    Kategori B
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[7] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang[7] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[7]+$data_per_cabang[7] }}
                                </td>
                            </tr>
                            <tr class="border-b border-gray-200">
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium bg-gray-50">
                                    Kategori C
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[8] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang[8] }}
                                </td>
                                <td class="px-3 py-3 uppercase text-gray-900 font-medium">
                                    {{ $data_per_cabang_pendaftar[8]+$data_per_cabang[8] }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="items-center justify-end flex space-x-2">
                <a href="{{ route('admin-ramadhan.peserta-lomba.export')}}" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                    Export Semua Peserta
                    @svg('carbon-download', 'ml-2 text-white h-4 w-4')
                </a>
                {{-- <Link modal max-width="lg" href="{{ route('admin.jadwal.create', ['unit' => $unit, 'periode' => $periode]) }}" class="text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                    Tambah Data
                    @svg('carbon-add-filled', 'ml-2 text-white h-4 w-4')
                </Link> --}}
            </div>
            @php
                $currentSortBy  = request('sort_by', 'created_at');
                $currentSortDir = request('sort_dir', 'desc');

                function sortLink($column) {
                    $dir = request('sort_dir') === 'asc' ? 'desc' : 'asc';

                    return request()->fullUrlWithQuery([
                        'sort_by'  => $column,
                        'sort_dir' => $dir,
                    ]);
                }

                function sortIcon($column) {
                    if (request('sort_by') !== $column) return '';

                    return request('sort_dir') === 'asc' ? '↑' : '↓';
                }
            @endphp
            <div class="container mx-auto">
                <x-splade-form method="GET" class="sm:flex items-center sm:space-x-2 border border-gray-300 rounded-lg p-2 mb-2"
                    :default="[
                            'cari' => request()->query('cari') ?? '',
                            'jenis_peserta' => request()->query('jenis_peserta') ?? '',
                            'status' => request()->query('status') ?? '',
                            'cabang' => request()->query('cabang'),
                        ],
                    ">
                    <x-splade-input value="{{ request()->query('cari') }}" name="cari" placeholder="Cari" class="flex-grow"/>
                    <x-splade-select name="cabang" multiple>
                        <option value="">-- Cabang Lomba</option>
                        @foreach ( $data_cabang as $item_cabang_f)
                            <option value="{{ $item_cabang_f->id }}">{!! $item_cabang_f->nama !!}</option>
                        @endforeach
                    </x-splade-select>
                    <x-splade-select name="jenis_peserta">
                        <option value="" disabled selected>-- Jenis</option>
                        <option value="ikhwan">Ikhwan</option>
                        <option value="akhwat">Akhwat</option>
                        <option value="">Semua</option>
                    </x-splade-select>
                    <x-splade-select name="status_proses">
                        <option value="" disabled selected>-- Status Mendaftar</option>
                        <option value="mendaftar">Mendaftar</option>
                        <option value="tidak-lolos">Tidak Lolos Penyisihan</option>
                        <option value="final">Final</option>
                        <option value="juara">Juara</option>
                        <option value="">Semua</option>
                    </x-splade-select>
                    <x-splade-input value="{{ request()->query('tanggal_lahir') }}" name="tanggal_lahir" placeholder="Tanggal Lahir" date range/>
                    <x-splade-submit :label="__('Cari')"/>
                </x-splade-form>
            </div>
            <div class="relative overflow-x-auto border rounded-md mb-4 bg-white">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                    <thead>
                        <tr class="border-b border-gray-200 ">
                            <th scope="col" class="p-4 uppercase">
                                <a href="{{ sortLink('created_at') }}" class="flex items-center gap-1">
                                    Tanggal Daftar
                                    <span>{{ sortIcon('created_at') }}</span>
                                </a>
                            </th>
                            <th scope="col" class="uppercase">
                                No Telp
                            </th>
                            <th scope="col" class="uppercase">
                                <a href="{{ sortLink('nama') }}" class="flex items-center gap-1">
                                    Peserta
                                    <span>{{ sortIcon('nama') }}</span>
                                </a>
                            </th>
                            <th scope="col" class="uppercase">
                                Jenis
                            </th>
                            <th scope="col" class="uppercase">
                                <a href="{{ sortLink('tanggal_lahir') }}" class="flex items-center gap-1">
                                    Tanggal Lahir
                                    <span>{{ sortIcon('tanggal_lahir') }}</span>
                                </a>
                            </th>
                            <th scope="col" class="uppercase">
                                Cabang
                            </th>
                            <th scope="col" class="uppercase">
                                Proses
                            </th>
                            <th scope="col" class="uppercase">
                                Pembayaran
                            </th>
                            <th scope="col" class="uppercase">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_peserta_lomba as $item)
                            <tr class="text-gray-700 border-b border-gray-200 py-4">
                                <td class="p-4 uppercase font-semibold flex">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y - H:i') }}
                                </td>
                                <td class="uppercase">
                                    <a href="https://wa.me/{{ $item->user->phone_number }}" class="text-primary-700 border border-primary-700 p-2 rounded-md font-semibold">
                                        {{ $item->user->phone_number }}
                                    </a>
                                </td>
                                <td class="uppercase">
                                    <span class="text-gray-500 font-semibold">
                                        {{ $item->nama }}
                                    </Link>
                                </td>
                                <td class="uppercase">
                                    <Link href="#" class="text-gray-500 font-semibold">
                                        {{ $item->jenis_kelamin }}
                                    </Link>
                                </td>
                                <td class="uppercase">
                                    <span class="text-gray-500 font-semibold">
                                        {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d M Y') }}
                                    </span>
                                </td>
                                <td class="uppercase">
                                    <div class="flex flex-col">
                                        @php
                                            $a = 0;
                                        @endphp
                                        @foreach ($item->pendaftaran as $item_pendaftaran)
                                            @php
                                                $a +=1 ;
                                            @endphp
                                            @if ($a != 1)
                                                <hr>
                                            @endif
                                            <span>{{ $item_pendaftaran->cabang->nama }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="uppercase">
                                    <div class="flex flex-col">
                                        @php
                                            $a = 0;
                                        @endphp
                                        @foreach ($item->pendaftaran as $item_pendaftaran)
                                            @php
                                                $a +=1 ;
                                            @endphp
                                            @if ($a != 1)
                                                <hr>
                                            @endif
                                            <span>{{ $item_pendaftaran->status }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="uppercase">
                                    @if ($item->transaksi->status == 1)
                                        <span class="bg-yellow-300 text-gray-900 px-2 py-1 text-xs font-semibold rounded-xl">Menunggu Pembayaran</span>
                                    @elseif ($item->transaksi->status == 2)
                                        <span class="bg-blue-500 text-white px-2 py-1 text-xs font-semibold rounded-xl">Menunggu Konfirmasi</span>
                                    @elseif ($item->transaksi->status == 3)
                                        <span class="bg-green-500 text-white px-2 py-1 text-xs font-semibold rounded-xl">Lunas</span>
                                    @elseif ($item->transaksi->status == 4)
                                        <span class="bg-red-500 text-white px-2 py-1 text-xs font-semibold rounded-xl">Kadaluarsa</span>
                                    @else
                                        <span class="bg-gray-500 text-white px-2 py-1 text-xs font-semibold rounded-xl">Batal</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center justify-center">
                                        {{-- @if ($item->status == 1)
                                            <Link href="{{ route('admin-ramadhan.transaksi-lomba.konfirmasi', ['transaksi' => $item->id])}}" class="relative text-white border border-yellow-400 bg-yellow-400 rounded-md p-2 mr-2">
                                                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-500 rounded-full">0</span>
                                                <span class="absolute top-0 right-4 inline-flex items-center justify-center px-1 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-sky-500 rounded-full">0</span>
                                                <x-carbon-notification class="w-4 h-4 mr-1 text-white"/>
                                            </Link>
                                        @endif
                                        <a href="{{ route('website.lttq.invoice', ['transaksi' => $item->id]) }}" target="_blank" class="text-primary-700 border border-primary-700 rounded-md p-2">
                                            <x-carbon-view class="w-4 h-4 text-primary-700"/>
                                        </a>
                                        @if ($item->status == 2)
                                            <Link href="{{ route('admin-ramadhan.transaksi-lomba.konfirmasi', ['transaksi' => $item->id])}}" class="text-white border border-sky-500 bg-sky-500 rounded-md p-2 ml-2">
                                                <x-carbon-checkmark class="w-4 h-4 text-white"/>
                                            </Link>
                                        @endif --}}

                                        {{-- <Link href="#" target="_blank" class="text-yellow-500 border border-yellow-500 rounded-md p-2 ml-2">
                                            <x-carbon-edit class="w-4 h-4 text-yellow-500"/>
                                        </Link> --}}
                                        <x-splade-form action="{{ route('admin-ramadhan.peserta-lomba.destroy', ['peserta' => $item->id]) }}" method="delete"
                                            confirm
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="text-red-500 border border-red-500 rounded-md p-2 ml-2">
                                                <x-carbon-trash-can class="w-4 h-4 text-red-500"/>
                                            </button>
                                        </x-splade-form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-2 text-xs text-gray-500">
                {{ $data_peserta_lomba->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-layouts.main>
