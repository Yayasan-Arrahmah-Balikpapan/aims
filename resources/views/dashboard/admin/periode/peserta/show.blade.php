<x-layouts.main :unit="$unit">

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            Peserta, Periode {{ $unit }}  Angkatan {{ $dataperiode->angkatan }}, Tahun {{ $dataperiode->tahun_ajaran }}
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        @include('dashboard.admin.periode.menu')
        <div class="w-full flex space-x-2 lg:ml-2 mt-2 lg:mt-0">
            <div class="px-3 w-1/1 lg:w-3/6 bg-white border border-gray-200 text-medium dark:text-gray-400 rounded-lg">
                <x-splade-form action="{{ route('admin.peserta.update', ['unit' => $unit, 'periode' => $periode, 'peserta' => $peserta]) }}" method="POST" onkeydown="return event.key != 'Enter';"
                    :default="[
                        'phone_number' => $data_peserta->peserta->phone_number ?? null,
                        'jenis_peserta' => $data_peserta->peserta->jenis_peserta ?? 'ikhwan',
                        'domisili' => $data_peserta->peserta->biodata['kota_domisili'] ?? '',
                        'nama_peserta' => $data_peserta->peserta->nama ?? null,
                        'tanggal_lahir' => $data_peserta->peserta->tanggal_lahir ?? null,
                        'alamat' => $data_peserta->peserta->biodata['alamat'] ?? null,
                        'jadwal' => $data_peserta->jadwal_id ?? '0',
                        'status_penerimaan' => $data_peserta->status_penerimaan ?? 'umum',
                        'status_daftar' => $data_peserta->status_daftar ?? 'baru',
                        'status_pendaftaran' => $data_peserta->status_pendaftaran ?? 'belum diberikan level',
                        'status_aktif' => $data_peserta->status_aktif ?? 'diproses',
                        'status_ujian' => $data_peserta->status_ujian ?? 'belum ujian',
                        'status_daftar_ulang' => $data_peserta->status_daftar_ulang ?? 'belum daftar ulang',
                        'status_domisili' => $data_peserta->status_domisili ?? '1'
                    ]"
                >
                    @csrf

                    <div class="relative">
                        <x-forms.body >
                            <h3 class="text-xl font-semibold text-gray-500">Biodata - {{ $data_peserta->nis_peserta ?? '' }}</h3>
                            <hr class="my-4">
                            <label class="flex text-gray-700">
                                Masukkan Nomor HP Whatsapp Aktif :
                            </label>
                            <div class="flex items-center">
                                <div class="relative w-full">
                                    <x-splade-input type="tel" name="phone_number" minlength="9" maxlength="14" placeholder="Masukkan Nomor Disini " required />
                                </div>
                            </div>
                            <div class="flex items-center">
                                <a href="https://wa.me/{{ $data_peserta->peserta->phone_number }}" target="_blank" class="text-sm text-gray-500 font-bold">
                                    Klik Link WhatsApp wa.me/{{ $data_peserta->peserta->phone_number }}
                                </a>
                            </div>
                            <div class="flex items-center justify-end ">
                                <div class="text-sm text-gray-500">
                                    Harus pake kode negara : 628123456789
                                </div>
                            </div>
                            <x-splade-input name="nama_peserta" :label="__('Nama peserta')" required/>
                            <x-splade-select name="jenis_peserta" :label="__('Gender')" choices>
                                <option value="ikhwan">Ikhwan / Laki-laki</option>
                                <option value="akhwat">akhwat / Perempuan</option>
                            </x-splade-select>
                            <x-splade-input name="tanggal_lahir" :label="__('Tanggal Lahir')" date required/>
                            <x-splade-select name="jadwal" :label="__('Jadwal')" choices>
                                <option value="">-- Pilih</option>
                                @foreach ($jadwals as $jadwal)
                                    <option value="{{ $jadwal->id }}">{{ $jadwal->nama_jadwal }}</option>
                                @endforeach
                                <option value="0">-- BELUM PILIH --</option>
                            </x-splade-select>
                            <x-splade-select name="status_domisili" :label="__('Asal Kota')" :options="[
                                '1' => 'Kota Balikpapan',
                                '0' => 'Luar Kota Balikpapan',
                            ]" choices />
                            <hr class="my-4">
                            <div class="flex gap-2 border border-red-300 p-2 rounded-lg bg-red-50">
                                <div class="w-full lg:w-1/2">
                                   <x-splade-select name="status_penerimaan" :label="__('Status Penerimaan')" :options="[
                                        'umum' => 'Umum',
                                        'karyawan' => 'Karyawan',
                                        'pengajar' => 'Pengajar',
                                        'beasiswa' => 'Beasiswa',
                                    ]" choices />
                                    <x-splade-select name="status_daftar" :label="__('Status Daftar')" :options="[
                                        'baru' => 'Baru',
                                        'melanjutkan' => 'Peserta Lanjutan',
                                    ]" choices />
                                    <x-splade-select name="status_pendaftaran" :label="__('Status Pendaftaran')" :options="[
                                        'belum diberikan level' => 'Belum Diberikan Level',
                                        'belum pilih jadwal' => 'Belum Pilih Jadwal',
                                        'selesai pilih jadwal' => 'Selesai Pilih Jadwal',
                                    ]" choices />
                                </div>
                                <div class="w-1/1 lg:w-1/2">
                                   <x-splade-select name="status_aktif" :label="__('Status Aktif')" :options="[
                                        'diproses' => 'Diproses',
                                        'aktif' => 'Aktif',
                                        'ditangguhkan' => 'Ditangguhkan',
                                        'off' => 'Off',
                                    ]" choices />
                                    <x-splade-select name="status_ujian" :label="__('Status Ujian')" :options="[
                                        'belum ujian' => 'Belum Ujian',
                                        'selesai ujian' => 'Selesai Ujian',
                                    ]" choices />
                                    <x-splade-select name="status_daftar_ulang" :label="__('Status Daftar Ulang')" :options="[
                                        'belum daftar ulang' => 'Belum Daftar Ulang',
                                        'selesai daftar ulang' => 'Selesai Daftar Ulang',
                                    ]" choices />
                                </div>
                            </div>
                            <div class="flex gap-2 my-4 border border-green-300 p-2 rounded-lg bg-green-50">
                                <x-splade-select class="w-full" name="nilai_ujian" :label="__('Nilai Ujian')" :options="[
                                    'belum ujian' => 'Belum Ujian',
                                    'selesai ujian' => 'Selesai Ujian',
                                ]" choices />
                            </div>
                            <x-splade-submit class="mt-4" label="Simpan" />
                        </x-forms.body>

                    </div>
                </x-splade-form>
            </div>
            <div class="px-3 w-1/1 lg:w-3/6 bg-white border border-gray-200 text-medium text-gray-500 dark:text-gray-400 rounded-lg">
                <div class="p-4 mb-4 2xl:col-span-2">
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

                            <div class="flex justify-between mb-2 items-center">
                                <h3 class="text-md py-2 text-gray-500 font-semibold uppercase">Pembayaran</h3>
                                <Link href="{{ route('admin.peserta.pembayaran', ['unit' => $unit, 'periode' => $periode, 'peserta' => $data_peserta->id]) }}" class="flex items-center border border-yellow-500 text-yellow-500 hover:text-white hover:bg-yellow-500 px-2 py-1 rounded text-sm">
                                    Tambah Data <x-carbon-add-alt class="ml-2 w-4 h-4" />
                                </Link>
                            </div>
                            <div class="border rounded-md mb-4">
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

                            @forelse ($data_transaksi as $item)
                                <div class="p-4 border rounded-md bg-white">
                                    <div class="flex">
                                        <Link href="{{ route('admin.transaksi.show', ['unit' => $unit, 'periode' => $periode, 'transaksi' => $item->id]) }}" target="_blank" class="text-yellow-500 flex items-center justify-center border border-yellow-500 rounded-md p-1 ml-2">
                                            Edit <x-carbon-edit class="w-4 h-4 ml-2 text-yellow-500"/>
                                        </Link>
                                    </div>
                                    <div class="flex items-center justify-between border-b pb-2">
                                        <div class="flex-1 min-w-0 sm:ms-4">
                                            <p class="text-sm font-bold text-gray-900 uppercase">
                                                INVOICE : {{ \Carbon\Carbon::parse($item->created_at)->format('Ymd') }}-{{ $item->id}}
                                            </p>
                                            {{-- <p class="text-sm text-gray-500 uppercase">
                                                {{ $item->created_at->format('d F Y') }}
                                            </p> --}}
                                        </div>

                                        @if ($item->status == 1)
                                            <span class="bg-yellow-300 text-gray-900 px-2 py-1 rounded xs flex">Menunggu Pembayaran</span>
                                        @elseif ($item->status == 2)
                                            <span class="bg-blue-500 text-white px-2 py-1 rounded xs flex">Menunggu Konfirmasi</span>
                                        @elseif ($item->status == 3)
                                            <span class="bg-green-500 text-white px-2 py-1 rounded xs flex">LUNAS</span>
                                        @elseif ($item->status == 4)
                                            <span class="bg-red-500 text-white px-2 py-1 rounded xs flex">Kadaluarsa</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center pt-2">
                                        <div class="flex-1 min-w-0 sm:ms-4">
                                            <Link href="{{ route('dashboard.peserta', ['uuid' => $item->kelas->uuid ]) }}">
                                                <p class="text-md font-medium text-gray-900 uppercase">
                                                    {{ $item->kelas->nis_peserta }} - {{ $item->kelas->peserta->nama }}
                                                </p>
                                                <p class="text-sm text-gray-500 uppercase">
                                                    {{ $item->periode->unit->nama }} {{ $item->periode->nama }}
                                                </p>
                                            </Link>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                            <Link href="{{ route('website.lttq.invoice', ['uuid' => $item->uuid, 'program' => $item->program_slug]) }}"
                                                class="text-sm flex font-semibold  border-primary-700 text-primary-700 hover:text-white bg-white  hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
                                                Lihat Invoice
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-4">
                                    Belum Ada Riwayat Aktivitas
                                </div>
                            @endforelse
                        </div>
                    </div>
            </div>
            {{-- <div class="px-3 lg:w-1/6 bg-white border border-gray-200 text-medium dark:text-gray-400 rounded-lg">
                <div class="p-4">
                    <div>
                        <h5 class="text-xs font-medium text-gray-500 uppercase ">
                            Tambah Pembayaran
                        </h5>
                        <div class="flex items-center justify-between mb-4">
                            <h1 class="text-xl mt-0 font-semibold text-gray-900 hover:underline dark:text-white">
                                0
                            </h1>
                            <div>
                                <Link modal href="{{ route('admin.peserta.potongan', ['unit' => $unit, 'periode' => $periode ,'peserta' => $peserta]) }}" class=" border-primary-700 ml-2 border px-2 py-1 rounded text-sm text-primary-700">
                                    Tambah
                                </Link>
                            </div>
                        </div>
                    </div>
                    <hr class="my-8">
                    <div class="mt-auto">
                        <h5 class="text-xs font-medium text-gray-500 uppercase ">
                            Hapus Permanen
                        </h5>
                        <div class="flex items-center justify-between">
                            <Link href="#" class="border border-red-500 text-red-500 hover:text-white hover:bg-red-500 px-2 py-1 rounded text-sm" onclick="confirm('Yakin ingin menghapus permanen?') || event.stopImmediatePropagation()">
                                Hapus Data Permanen
                            </Link>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</x-layouts.main>

