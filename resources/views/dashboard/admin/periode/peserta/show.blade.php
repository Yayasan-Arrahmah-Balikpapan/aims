<x-layouts.main :unit="$unit">

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            Peserta, Periode {{ $unit }}  Angkatan {{ $dataperiode->angkatan }}, Tahun {{ $dataperiode->tahun_ajaran }}
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        @include('dashboard.admin.periode.menu')
        <div class="w-full grid sm:grid-cols-2 space-x-2 ml-2">
            <div class="px-3 bg-white border border-gray-200 text-medium dark:text-gray-400 rounded-lg">
                <x-splade-form action="{{ route('admin.peserta.update', ['unit' => $unit, 'periode' => $periode, 'peserta' => $peserta]) }}" method="POST" onkeydown="return event.key != 'Enter';"
                    :default="[
                        'phone_number' => $data_peserta->peserta->phone_number ?? null,
                        'jenis_peserta' => $data_peserta->peserta->jenis_peserta ?? 'ikhwan',
                        'domisili' => $data_peserta->peserta->biodata['kota_domisili'] ?? '',
                        'nama_peserta' => $data_peserta->peserta->nama ?? null,
                        'tanggal_lahir' => $data_peserta->peserta->tanggal_lahir ?? null,
                        'alamat' => $data_peserta->peserta->biodata['alamat'] ?? null,
                        'jadwal' => $data_peserta->jadwal_id ?? '0',
                    ]"
                >
                    @csrf

                    <div class="relative">
                        <x-forms.body >
                            <label class="flex text-gray-700">
                                Masukkan Nomor HP Whatsapp Aktif :
                            </label>
                            <div class="flex items-center">
                                <div class="relative w-full">
                                    <x-splade-input type="tel" name="phone_number" minlength="9" maxlength="14" placeholder="Masukkan Nomor Disini " required />
                                </div>
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
                            <hr class="my-4">
                            <x-splade-submit label="Simpan" />
                        </x-forms.body>

                    </div>
                </x-splade-form>
            </div>
            <div class="px-3 bg-white border border-gray-200 text-medium text-gray-500 dark:text-gray-400 rounded-lg">
                <div class="p-4 mb-4  2xl:col-span-2">
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
                            @forelse ($data_transaksi as $item)
                                <li class="p-4 border rounded-md bg-white">
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
                                </li>
                            @empty
                                <li class="p-4">
                                    Belum Ada Riwayat Aktivitas
                                </li>
                            @endforelse
                        </div>
                    </div>
            </div>
        </div>
    </div>
</x-layouts.main>

