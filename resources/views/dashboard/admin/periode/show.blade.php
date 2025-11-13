<x-layouts.main :unit="$unit">
    <x-layouts.card>
        <h2 class="text-2xl font-bold ">Manajemen Periode {{ $unit }} {{ $data_periode->nama }}</h2>
    </x-layouts.card>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <x-layouts.card>
            <h4 class="text-xl font-bold px-4">Info</h4>
            <x-splade-form action="{{ route('admin.periode.update', ['unit' => $unit, 'periode' => $data_periode->id]) }}" method="PUT" onkeydown="return event.key != 'Enter';"
                :default="[
                    'aktifkan_pendaftaran' => $data_periode->aktifkan_pendaftaran,
                    'tahun_ajaran' => $data_periode->tahun_ajaran,
                    'angkatan' => $data_periode->angkatan,
                    'waktu_start' => $data_periode->waktu_start,
                    'waktu_end' => $data_periode->waktu_end,
                    'nama' => $data_periode->nama,
                    'kategori' => $data_periode->kategori,
                ]"
            >
                @csrf
                <div class="relative p-4">
                    <x-splade-input name="nama" :label="__('Nama Periode')" required min="3" oninvalid="this.setCustomValidity('Harus Diisi, Minimal 3 Huruf')" disabled/>
                    <div class="grid grid-cols-2 gap-2">
                        <x-splade-input type="number" name="angkatan" :label="__('Angkatan')" required min="3" oninvalid="this.setCustomValidity('Harus Diisi, Minimal 3 Huruf')"/>
                        <x-splade-input name="tahun_ajaran" :label="__('Tahun Ajaran')" required min="3" oninvalid="this.setCustomValidity('Harus Diisi, Minimal 3 Huruf')"/>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <x-splade-input name="waktu_start" :label="__('Waktu Mulai')" date />
                        <x-splade-input name="waktu_end" :label="__('Waktu Berakhir')" date />
                    </div>
                    <x-splade-select name="aktifkan_pendaftaran" :label="__('Status Pendaftaran')" choices>
                        <option value="0">Tutup Pendaftaran</option>
                        <option value="1">Buka Pendaftaran</option>
                    </x-splade-select>
                    <x-splade-select name="kategori" :label="__('Kategori')" :options="$item_kategori" option-label="nama" option-value="slug" choices required/>
                </div>
                <div class="flex items-center p-6">
                    <input id="konfirmasi-checkbox" type="checkbox" v-model="form.agree_with_terms" class="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                    <label for="konfirmasi-checkbox" class="text-sm font-medium text-gray-900 px-3">Konfirmasi</label>
                </div>
                <div class="flex items-center p-6 border-t border-gray-200 rounded-b ">
                    <x-splade-submit label="Simpan" v-show="form.agree_with_terms"/>
                </div>
            </x-splade-form>
        </x-layouts.card>
        <x-layouts.card>
            <h4 class="text-xl font-bold px-4">Jenis Absensi</h4>
            @php
                $data_jenis_absensi = $data_periode->format_absensi ?? 1;
            @endphp
            <x-splade-form action="{{ route('admin.periode.jenisabsensi.update', ['unit' => $unit, 'periode' => $data_periode->id]) }}" method="POST"
                :default="[
                    'jenis_absensi' => $data_jenis_absensi['jenis_absensi'] ?? 0,
                    'jumlah_pertemuan' => $data_jenis_absensi['jumlah_pertemuan'] ?? 0,
                    'jenis_laporan' => $data_jenis_absensi['jenis_laporan'] ?? 0,
                ]"
            >
                @csrf
                <div class="relative p-4">
                    <div class="space-y-2">
                        <div class="border border-gray-300 rounded-lg p-4">
                            <x-splade-radio name="jenis_absensi" value="1" :label="__('Berdasarkan Tanggal')" required/>
                            <div class="flex mt-2" v-show="form.jenis_absensi == 1">
                                <x-splade-select name="jenis_laporan" :label="__('Jenis Laporan')" required>
                                    <option value="harian">Harian</option>
                                    {{-- <option value="mingguan">Mingguan</option> --}}
                                    <option value="bulanan">Bulanan</option>
                                </x-splade-select>
                            </div>
                        </div>
                        <div class="border border-gray-300 rounded-lg p-4">
                            <x-splade-radio name="jenis_absensi" value="2" :label="__('Banyak Pertemuan')" required/>
                            <div class="flex mt-2" v-show="form.jenis_absensi == 2">
                                <x-splade-input type="number" name="jumlah_pertemuan" :label="__('Jumlah Pertemuan')" />
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <span class="text-sm text-gray-700">
                            Catatan: Ini akan mempengaruhi semua format yang tampil pada sistem.
                        </span>
                    </div>
                </div>
                <div class="flex items-center p-6 border-t border-gray-200 rounded-b ">
                    <x-splade-submit label="Update"/>
                </div>
            </x-splade-form>
        </x-layouts.card>
    </div>
    <hr class="mt-4">
    <div class="grid grid-cols-1 md:grid-cols-3">
        <div>
            <x-layouts.card>
                <h4 class="text-xl font-bold px-4">Biaya Daftar</h4>
                <x-splade-form action="{{ route('admin.periode.biaya.daftar.store', ['unit' => $unit, 'periode' => $data_periode->id]) }}"
                    :default="[
                            'wajib_dibayar_oleh' => 'umum',
                        ]"
                    preserve-scroll
                >
                    @csrf
                    <div class="relative p-4">
                        <div class="grid grid-cols-2 gap-2">
                            <x-splade-input name="nominal" :label="__('Nominal tanpa titik')" type="number" required/>
                            <x-splade-select name="wajib_dibayar_oleh" :label="__('Untuk Peserta')" choices>
                                <option value="umum">Umum</option>
                                <option value="warga">Warga</option>
                                <option value="karyawan">Karyawan</option>
                            </x-splade-select>
                        </div>
                    </div>
                    <div class="p-4">
                        <x-splade-submit label="Simpan"/>
                    </div>
                </x-splade-form>
            </x-layouts.card>
            <x-layouts.card>
                <h4 class="text-xl font-bold px-4">Tambah Item Biaya</h4>
                <x-splade-form action="{{ route('admin.periode.biaya.store', ['unit' => $unit, 'periode' => $data_periode->id]) }}"
                    :default="[
                        'wajib_dibayar_awal' => '0',
                        'wajib_dibayar_oleh' => 'umum',
                        'status_dicicil' => '0',
                    ]"
                    preserve-scroll
                >
                    @csrf
                    <div class="relative p-4">
                        <div class="grid grid-cols-2 gap-2">
                            <x-splade-input name="nama" :label="__('Nama Item')" required/>
                            <x-splade-input name="nominal" :label="__('Nominal tanpa titik')" type="number" required/>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <x-splade-select name="wajib_dibayar_awal" :label="__('Wajib Dibayar Awal Daftar')" choices>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </x-splade-select>
                            <x-splade-select name="wajib_dibayar_oleh" :label="__('Untuk Peserta')" choices>
                                <option value="umum">Umum</option>
                                <option value="warga">Warga</option>
                                <option value="karyawan">Karyawan</option>
                            </x-splade-select>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <x-splade-select name="status_dicicil" :label="__('Bisa Dicicil')" choices>
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </x-splade-select>
                        </div>
                        <x-splade-input name="keterangan" :label="__('Keterangan')"/>
                    </div>
                    <div class="p-4">
                        <x-splade-submit label="Tambah"/>
                    </div>
                </x-splade-form>
            </x-layouts.card>
        </div>
        <div class="col-span-2">
            <x-layouts.card>
                <h4 class="text-xl font-bold px-4">Daftar Item Biaya</h4>
                <div class="pt-4 relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                            <tr>
                                <th scope="col" class="px-2 py-3">Nama</th>
                                <th scope="col" class="px-2 py-3">Nominal</th>
                                <th scope="col" class="px-2 py-3">Wajib Dibayar Awal</th>
                                <th scope="col" class="px-2 py-3">Untuk Peserta</th>
                                <th scope="col" class="px-2 py-3">Keterangan</th>
                                <th scope="col" class="px-2 py-3">Bisa Dicicil</th>
                                <th scope="col" class="px-2 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($item_biaya as $biaya)
                                <tr class="bg-white border-b border-gray-200">
                                    <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                        {{ $biaya->nama }}
                                    </th>
                                    <td class="px-2 py-4">
                                        Rp {{ number_format($biaya->nominal, 0, ',', '.') }}
                                    </td>
                                    <td class="px-2 py-4">
                                        {{ $biaya->wajib_dibayar_awal ? 'Ya' : 'Tidak' }}
                                    </td>
                                    <td class="px-2 py-4">
                                        {{ $biaya->wajib_dibayar_oleh }}
                                    </td>
                                    <td class="px-2 py-4">
                                        {{ $biaya->keterangan }}
                                    </td>
                                    <td class="px-2 py-4">
                                        {{ $biaya->status_dicicil ? 'Ya' : 'Tidak' }}
                                    </td>
                                    <td class="px-2 py-4">
                                        <x-splade-form action="{{ route('admin.periode.biaya.destroy', ['unit' => $unit, 'periode' => $data_periode->id, 'biaya' => $biaya->id]) }}" method="DELETE"
                                            confirm="Konfirmasi Hapus Data"
                                            confirm-text="Apakah yakin data {{ $biaya->nama }} dihapus ?"
                                            confirm-button="Ya"
                                            cancel-button="Tidak"
                                            preserve-scroll
                                        >
                                            @csrf
                                            <button type="submit" class="text-red-500 underline">Hapus</button>
                                        </x-splade-form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </x-layouts.card>
        </div>
    </div>
    <hr class="my-4">
    <x-layouts.card>
        <h4 class="text-xl font-bold px-4">Notifikasi Pesan Whatsapp</h4>

        {{-- <div class="p-4 border rounded-lg m-2">
            <div class="flex items-center justify-center p-2 text-lg font-semibold">
                Penggunaan Tag Mailing List
            </div>
            <div class="grid gap-4 grid-cols-3">
                <div class="space-y-2">
                    <div class="text-lg underline">
                        Biodata
                    </div>
                    <div class="space-y-2">
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Nama</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Nama}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">No Telp</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{No Telp}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Email</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Email}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Gender</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Gender}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Alamat</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Alamat}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Kota</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Kota}</dd>
                        </dl>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="text-lg underline">
                        Data
                    </div>
                    <div class="space-y-2">
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Jadwal</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Jadwal}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Pengajar</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Pengajar}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Level</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Level}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Hari</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Hari}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Jam</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Jam}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Jenis Pembelajaran</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Jenis Pembelajaran}</dd>
                        </dl>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="text-lg underline">
                        Pembayaran
                    </div>
                    <div class="space-y-2">
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Invoice</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Invoice}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Total Biaya Pembayaran</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Total Biaya Pembayaran}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Total Selesai Pembayaran</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Total Selesai Pembayaran}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Bulan Terlunasi</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Bulan Terlunasi}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Bulan Tunggakan</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Bulan Tunggakan}</dd>
                        </dl>
                        <dl class="flex items-center justify-between gap-4 border p-2 rounded-md">
                            <dt class="text-gray-500 dark:text-gray-400">Biaya Tunggakan</dt>
                            <dd class="text-base font-medium text-gray-900 dark:text-white">{Biaya Tunggakan}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="p-4">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-2">
                @php
                    $list = [
                        'Pendaftaran Baru' => 'pendaftaran-baru',
                        'Pendaftar Lanjutan' => 'pendaftar-lanjutan',
                        'Mendapatkan Level' => 'mendapatkan-level',
                        'Pengingat Pilih Jadwal' => 'pengingat-pilih-jadwal',
                        'Mendapatkan Jadwal' => 'mendapatkan-jadwal',
                        'Pengingat Pembayaran' => 'pengingat-pembayaran',
                        'Selesai Pembayaran' => 'selesai-pembayaran',
                        'Selesai Ujian' => 'selesai-ujian',
                        'Notifikasi Tambahan 1' => 'tambahan-1',
                        'Notifikasi Tambahan 2' => 'tambahan-2',
                        'Notifikasi Tambahan 3' => 'tambahan-3',
                    ];
                @endphp
                @foreach($list_notifikasi as $item_notifikasi)
                <div class="">
                    <Link modal href="{{ route('admin.periode.notifikasi', ['unit' => $unit, 'periode' => $data_periode->id, 'notifikasi' => $item_notifikasi->slug]) }}"
                        class="text-xs uppercase font-semibold py-3 px-3 bg-sky-100 rounded-lg flex justify-between">
                        {{ $item_notifikasi->nama }}
                        <x-carbon-edit class="w-5 h-5 text-gray-500"/>
                    </Link>
                </div>
                @endforeach
            </div>
        </div>


    </x-layouts.card>

</x-layouts.main>
