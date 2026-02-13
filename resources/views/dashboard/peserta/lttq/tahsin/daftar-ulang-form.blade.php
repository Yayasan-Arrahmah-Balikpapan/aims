<x-app-layout>

    <div class="text-center py-8 bg-gray-100">
        <p class="text-sm text-gray-600">
            <Link href="{{ url('/') }}/dashboard/peserta/lttq/tahsin/daftar-ulang" class="text-md text-gray-600 hover:text-gray-900">
                &larr; Kembali
            </Link>
        </p>
    </div>

    <div class=" flex justify-center items-center p-4 bg-gray-100">
        <div class="w-full sm:max-w-lg px-6 py-4 bg-white shadow-md rounded-lg">
            <div class="space-y-2 flex items-center justify-center gap-6 md:space-y-0">
                <a href="#" class="shrink-0 m-4">
                    <img class="w-32" src="{{ url('/') }}/assets/img/lttq/tahsin.png">
                </a>
            </div>
            <h1 class="text-2xl font-bold text-center">Daftar Ulang Tahsin</h1>
            <p class="text-center font-normal text-md pb-2">Angkatan {{ $data_periode->angkatan }}</p>
            <x-splade-form action="{{ route('dashboard.peserta.lttq.tahsin.daftar-ulang.form-store', ['peserta' => $peserta]) }}"
                confirm-text="Apakah data yang anda masukkan sudah benar ?"
                confirm="Konfirmasi"
                confirm-button="Benar"
                cancel-button="Belum"
                method="POST"
                 :default="[
                                'phone_number' => $data_peserta->peserta->phone_number ?? '',
                            ]"
                >
                @if ($data_peserta->status_daftar_ulang == 'belum daftar ulang')
                    @csrf
                @endif
                <div class="flex items-center">
                    <div class="relative w-full">
                        <x-splade-input type="tel" :label="__('Nomor HP Whatsapp')" name="phone_number" size="20" minlength="8" maxlength="15"
                            class="block text-gray-900 bg-transparent appearance-none peer"
                            placeholder="Masukkan Nomor : 08123456xxxx" required disabled />
                        </div>
                    </div>
                <div class="p-2 sm:p-4 bg-white border border-gray-200 rounded-lg">
                    <h3 class="mb-4 text-xl font-semibold uppercase">{{ $data_peserta->peserta->nama }}</h3>
                    <ul class="grid grid-cols-6 gap-2">
                        <li class="col-span-3">
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
                        <li class="col-span-3">
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
                        <li class="col-span-3">
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
                        <li class="col-span-3">
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
                        <li class="col-span-3">
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
                        <li class="col-span-3">
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

                <hr class="my-4">

                <div class="p-2 sm:p-4 bg-white border border-gray-200 rounded-lg">
                    {{-- <h3 class="mb-4 text-xl font-semibold uppercase">{{ $data_peserta->peserta->nama }}</h3> --}}
                    <ul class="grid grid-cols-1 gap-2">
                        <li class="col-span-3">
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-normal text-gray-500 truncate ">
                                        Hasil Level
                                    </p>
                                    <p class="text-base font-semibold text-gray-900">
                                        {{ $data_peserta->data_nilai['ujian'] ? $data_level[$data_peserta->data_nilai['ujian']] : $data_level[$data_peserta->jadwal->level_id] }}
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="col-span-3">
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-normal text-gray-500 truncate ">
                                        Keterangan
                                    </p>
                                    <p class="text-base font-semibold text-gray-900">
                                        {{ $data_peserta->data_nilai['keteranganhasilujian'] ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

                <hr class="mt-4">

                @if ($data_peserta->data_nilai['ujian'] == 11)
                    <div class="text-center bg-sky-100 border border-sky-300 rounded-md p-4 my-4">
                        <h1 class="text-lg font-bold text-gray-700">
                            Karena telah mencapai level Tajwidi, Anda akan di arahkan ke form pendaftaran Yayasan Al-Haqq Indonesia.
                        </h1>
                        <h1 class="text-md text-gray-700">
                            Silah isi google form dan menunggu dihubungi oleh admin yayasan Al-Haqq Indonesia.
                        </h1>
                        <div class="my-2">
                            <a target="_blank" href="https://docs.google.com/forms/d/e/1FAIpQLSc2_AR0PDkF4q3zLQszYdrOnygi0x6Fwq1pg4_ubiXBN8p7lQ/viewform"
                                class="bg-primary-700 text-medium text-white rounded-md mt-2 flex items-center justify-between p-2 w-full">
                                Klik Link Daftar Ulang Tajwidi
                                <x-carbon-chevron-right class="h-6 w-6 ml-2" />
                            </a>
                        </div>
                    </div>
                @else
                    <div class="border border-gray-300 bg-gray-100 rounded-md p-4 my-4">
                        @if ($data_peserta->status_daftar_ulang == 'belum daftar ulang')
                            <x-splade-select class="text-2xl " name="jadwal" :label="__('Pilih Jadwal')" required>
                                <option value="" disabled selected>-- Pilih Jadwal</option>
                                @foreach ($data_jadwal as $jadwal)
                                    <option class="text-sm flex" value="{{ $jadwal->id }}" {{ $jadwal->kelas->count() >= $jadwal->batasan_peserta ? 'disabled' : '' }}>
                                        {{
                                            $jadwal->kelas->count() >= $jadwal->batasan_peserta
                                                    ? 'Penuh - '.$jadwal->pengajar->kode_nama_pengajar . ', ' .$jadwal->hari_belajar . ' ' . $jadwal->level->nama . ' ,' . $jadwal->jam_mulai . ' WITA - ' . $jadwal->status_belajar . ' - ' . $jadwal->kelas->count() . '/' . $jadwal->batasan_peserta
                                                    : ($jadwal->pengajar->kode_nama_pengajar . ', ' .$jadwal->hari_belajar . ' ' . $jadwal->level->nama . ' ,' . $jadwal->jam_mulai . ' WITA - ' . $jadwal->status_belajar . ' - ' . $jadwal->kelas->count() . '/' . $jadwal->batasan_peserta)
                                        }}
                                    </option>
                                @endforeach
                            </x-splade-select>
                        @else
                        <div class="text-center">
                            <h1 class="text-lg">
                                Peserta telah menyelsaikan proses daftar ulang dan memilih jadwal tahsin
                            </h1>
                            <h1 class="text-lg font-bold">
                                Jadwal yang sudah dipilih :
                            </h1>
                            <h1 class="text-lg font-bold">
                                {{ $data_peserta_sudah_daftar->jadwal->nama_jadwal }}
                            </h1>
                        </div>
                        <p class="text-md my-4 pt-2 flex items-center justify-center">

                            <Link href="{{ route('dashboard.peserta.data') }}" class="flex p-2 border border-gray-300 rounded-md hover:bg-gray-200 hover:text-gray-900">
                                Ke Profile Data Peserta
                                <x-carbon-user class="h-6 w-6 ml-2" />
                            </Link>
                        </p>


                        @endif

                    </div>

                    @if ($data_peserta->status_daftar_ulang == 'belum daftar ulang')

                        <hr class="mb-4">

                        <h1 class="text-md mb-2">Pembiayaan</h1>
                        <div class="">
                            <div class="relative overflow-x-auto border rounded-md mb-4">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                                    <thead>
                                        <tr class="border-b border-gray-200 dark:border-gray-700">
                                            <th scope="col"
                                                class="px-3 py-3 font-bold text-gray-600 whitespace-nowrap bg-gray-50 ">
                                                Jenis Pembayaran
                                            </th>
                                            <th scope="col"
                                                class="px-3 py-3 font-bold text-gray-600 whitespace-nowrap bg-gray-50 text-center">
                                                Pilihan
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($data_biaya as $item_biaya)
                                            <tr class="border-b text-sm border-gray-200 0">
                                                <td class="px-3 py-3 font-semibold uppercase text-gray-900">
                                                    {{ $item_biaya->nama }}
                                                    <div class="font-base text-gray-600">
                                                        Rp. {{ number_format($item_biaya->nominal, 0, ',', '.') }}
                                                    </div>
                                                </td>
                                                <td class="px-3 py-3 font-semibold uppercase text-gray-900 text-center">
                                                    @if ($item_biaya->wajib_dibayar_awal == true)
                                                        <div class="flex items-center justify-center">
                                                            <div class="bg-primary-600 p-1 rounded-md">
                                                                <x-carbon-checkmark class="h-4 w-4 text-white" />
                                                            </div>
                                                        </div>
                                                    @else
                                                        <input type="checkbox" v-model="form.pembayaran{{ $item_biaya->id }}" name="pembayaran{{ $item_biaya->id }}"
                                                            class="w-6 h-6 rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                                        >

                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="my-4 bg-stone-100 p-4 rounded-lg font-semibold">
                            <p class="text-sm text-gray-500 mb-2">
                                Dengan ini saya menyetujui aturan-aturan yang berlaku untuk mendaftar diri saya sebagai peserta tahsin Ar Rahmah:
                            </p>
                            <table class="w-full text-xs text-gray-700">
                                <tbody>
                                    <tr class="border-b">
                                        <td class="px-4">1.</td>
                                        <td class="py-2">Tahsin LTTQ Ar Rahmah Balikpapan menggunakan Metode Al Haqq.</td>
                                    </tr>
                                    <tr class="border-b bg-stone-200">
                                        <td class="px-4">2.</td>
                                        <td class="py-2">Jumlah pertemuan tahsin adalah sebanyak 16 kali pertemuan dalam 1 level (termasuk kuliah perdana).</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="px-4">3.</td>
                                        <td class="py-2">Jumlah pertemuan tahsin dalam sepekan diadakan sebanyak 1 kali dengan durasi maksimal 2 jam.</td>
                                    </tr>
                                    <tr class="border-b bg-stone-200">
                                        <td class="px-4">4.</td>
                                        <td class="py-2">SPP wajib dibayarkan sebanyak 480.000 dalam 1 level pembelajaran (diluar biaya pendaftaran, modul, buku prestasi, dan mushaf).</td>
                                    </tr>
                                    <tr class="border-b">
                                        <td class="px-4">5.</td>
                                        <td class="py-2">Peserta wajib membeli perlengkapan tahsin; Mushaf Rasm Utsmani, Modul dan Buku Prestasi.</td>
                                    </tr>
                                    <tr class="border-b bg-stone-200">
                                        <td class="px-4">6.</td>
                                        <td class="py-2">Peserta wajib mengikuti minimal 10 pertemuan agar bisa mengikuti ujian.</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4">7.</td>
                                        <td class="py-2">Peserta wajib mengikuti aturan tambahan jika dikeluarkan sewaktu-waktu oleh pihak LTTQ Ar Rahmah Balikpatan.</td>
                                    </tr>
                                    <tr class="border-b bg-stone-200">
                                        <td class="px-4 ">8.</td>
                                        <td class="py-2">Peserta yang terdaftar kemudian membatalkan keikutsertaan kegiatan Tahsin di LTTQ Ar Rahmah Balikpapan, Maka refund (pengembalian biaya pembayaran) bisa diberlakukan kecuali Biaya Pendaftaran.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 border p-4 rounded-md">
                            <label for="donasi" class="block text-sm font-medium text-gray-700">Yuk salurkan infaq terbaikmu :)</label>
                            <div class="grid grid-cols-2 gap-2 mt-2">
                                <div>
                                    <label class="flex items-center space-y-2">
                                        <input type="radio" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded" name="pembayaran_donasi" v-model="form.pembayarandonasi" value="0" checked>
                                        <span class="ml-2 block text-sm text-gray-700">0</span>
                                    </label>
                                    <hr>
                                    @foreach ([
                                        5000 => 'Rp 5.000',
                                        10000 => 'Rp 10.000',
                                        25000 => 'Rp 25.000',
                                        50000 => 'Rp 50.000',
                                    ] as $value => $label)
                                        <label class="flex items-center space-y-2">
                                            <input type="radio" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded" name="pembayaran_donasi" v-model="form.pembayarandonasi" value="{{ $value }}">
                                            <span class="ml-2 block text-sm text-gray-700">{{ $label }}</span>
                                        </label>
                                        <hr>
                                    @endforeach
                                </div>
                                <div>
                                    @foreach ([
                                        100000 => 'Rp 100.000',
                                        200000 => 'Rp 200.000',
                                        500000 => 'Rp 500.000',
                                        1000000 => 'Rp 1.000.000',
                                    ] as $value => $label)
                                        <label class="flex items-center space-y-2">
                                            <input type="radio" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded" name="pembayaran_donasi" v-model="form.pembayarandonasi" value="{{ $value }}">
                                            <span class="ml-2 block text-sm text-gray-700">{{ $label }}</span>
                                        </label>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                            <label class="flex items-center pt-2">
                                <input type="radio" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded" name="pembayaran_donasi" v-model="form.pembayarandonasi" value="custom">
                                <input type="number" class="ml-2 block w-full border-gray-300 rounded" name="pembayaran_custom_donasi" v-model="form.pembayarandonasicustom" placeholder="Atau Masukkan nominal" min="0" step="1000" disabled>
                            </label>
                            <x-splade-script>
                                document.querySelectorAll('input[name="pembayaran_donasi"]').forEach(radio => {
                                    radio.addEventListener('change', function() {
                                        const customInput = document.querySelector('input[name="pembayaran_custom_donasi"]');
                                        if (this.value === 'custom') {
                                            customInput.disabled = false;
                                            customInput.focus();
                                        } else {
                                            customInput.disabled = true;
                                        }
                                    });
                                });
                            </x-splade-script>
                        </div>

                        <div class="flex items-center justify-center mt-6">
                            <x-splade-submit class="bg-primary-700 text-medium text-white py-2.5 px-5 rounded-lg flex items-center justify-between">
                                Daftar & Lanjutkan Pembayaran <x-carbon-chevron-right class="h-8 w-8 pl-2" />
                            </x-splade-submit>
                        </div>
                    @endif
                @endif
            </x-splade-form>
        </div>
    </div>

    <div class="text-center py-8 bg-gray-100">
        <div class="flex items-center justify-center">
            <img src="{{ url('/') }}/assets/pembayaran/SSL-Secured.svg" alt="ssl" class="h-16 pt-3">
            <img class="h-12 mt-5 rounded-md" src="https://ipaymu.com/wp-content/themes/ipaymu_v2/assets/new-assets/image/iPaymu-PCIDSS.jpeg" alt="ipaymu">
        </div>
        <p class="text-sm pt-4 text-gray-600">
            &copy; {{ date('Y') }} arrahmahbalikpapan.or.id
        </p>
    </div>
</x-app-layout>
