<div class="min-h-screen bg-gray-100">

    <div class="text-center py-8 bg-gray-100">
        <p class="text-sm text-gray-600">
            <Link href="{{ url('/') }}/dashboard" class="text-md text-gray-600 hover:text-gray-900">
                &larr; Kembali
            </Link>
        </p>
    </div>

    <div class=" flex justify-center items-center p-4 bg-gray-100">
        <div class="w-full sm:max-w-lg mt-6 px-6 py-4 bg-white shadow-md rounded-lg">
            <div class="space-y-2 flex items-center justify-center gap-6 md:space-y-0">
                <a href="#" class="shrink-0 m-4">
                    <img class="w-32" src="{{ url('/') }}/assets/img/lttq/tahsin.png">
                </a>
            </div>
            <h1 class="text-2xl font-bold text-center">Pendaftaran Tahsin</h1>
            <p class="text-center font-normal text-md pb-2">Angkatan {{ $periode->angkatan }}</p>
            <x-splade-form action="{{ route('website.lttq.tahsin.pendaftaran.store') }}"
                confirm-text="Apakah data yang anda masukkan sudah benar ?"
                confirm="Konfirmasi"
                confirm-button="Benar"
                cancel-button="Belum"
                method="POST"
                :default="[
                                'phone_number' => auth()->user()->phone_number ?? '',
                                'jenis_peserta' => 'ikhwan',
                                'pembelajaran' => 1,
                                'kota_domisili' => 'Kota Balikpapan',
                                'pembayaranpendaftaran' => true,
                                'pembayaranspp1' => true,
                            ]"
                >
                @csrf

                @auth
                    <div class="flex items-center">
                        <div class="relative w-full">
                            <x-splade-input type="tel" :label="__('Nomor HP Whatsapp')" name="phone_number" size="20" minlength="8" maxlength="15"
                                class="block text-gray-900 bg-transparent appearance-none peer"
                                placeholder="Masukkan Nomor : 08123456xxxx" required disabled />
                        </div>
                    </div>
                @else
                    <div class="flex items-center mt-2">
                        <x-splade-select name="phone_code" :label="__('Nomor HP Whatsapp')" value="62" class="py-0 w-60 text-sm block" choices
                            required>
                            @include('components.website.phone-code')
                        </x-splade-select>
                    </div>
                    <div class="flex items-center">
                        <div class="relative w-full">
                            <x-splade-input type="tel" name="phone_number" size="20" minlength="8" maxlength="15"
                                class="block text-gray-900 bg-transparent appearance-none peer"
                                placeholder="Masukkan Nomor : 08123456xxxx" required />
                        </div>
                    </div>
                    <div class="flex items-center justify-end ">
                        <div class="text-sm text-gray-500">
                            Contoh : 08123456789
                        </div>
                    </div>
                @endauth

                <x-splade-input id="name" type="text" name="name" :label="__('Nama Peserta')" required autofocus />
                <x-splade-select name="jenis_peserta" :label="__('Jenis Peserta')" required value="ikhwan" >
                    <option value="ikhwan">Ikhwan / Laki-laki</option>
                    <option value="akhwat">Akhwat / Perempuan</option>
                </x-splade-select>

                <div class="border border-gray-300 rounded-md p-4 my-4">
                    <span class="block mb-1 text-gray-700 font-sans"> Tanggal Lahir </span>
                    <div class="grid grid-cols-3 gap-0">
                        <x-splade-select name="tanggal" :label="__('Tanggal')" required >
                            <option value="" disabled selected>-- Pilih Tanggal</option>
                            @foreach (range(1, 31) as $tanggal)
                                <option value="{{ $tanggal }}">{{ $tanggal }}</option>
                            @endforeach
                        </x-splade-select>
                        <x-splade-select name="bulan" :label="__('Bulan')" required >
                            <option value="" disabled selected>-- Pilih Bulan</option>
                            @foreach ([
                                ['name' => 'Januari', 'value' => '1'],
                                ['name' => 'Februari', 'value' => '2'],
                                ['name' => 'Maret', 'value' => '3'],
                                ['name' => 'April', 'value' => '4'],
                                ['name' => 'Mei', 'value' => '5'],
                                ['name' => 'Juni', 'value' => '6'],
                                ['name' => 'Juli', 'value' => '7'],
                                ['name' => 'Agustus', 'value' => '8'],
                                ['name' => 'September', 'value' => '9'],
                                ['name' => 'Oktober', 'value' => '10'],
                                ['name' => 'November', 'value' => '11'],
                                ['name' => 'Desember', 'value' => '12'],
                            ] as $bulan)
                                <option value="{{ $bulan['value'] }}">{{ $bulan['name'] }}</option>
                            @endforeach
                        </x-splade-select>
                        <x-splade-select name="tahun" :label="__('Tahun')" required >
                            <option value="" disabled selected>-- Pilih Tahun</option>
                            @php
                                $tahun_terakhir = date('Y', strtotime('-12 years'));
                                $tahun_pertama = 1950;
                            @endphp
                            @for ($i = $tahun_terakhir; $i >= $tahun_pertama; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </x-splade-select>
                    </div>
                </div>
                <x-splade-select name="kota_domisili" :label="__('Kota Domisili')" choices>
                    @foreach($dataindo as $provinsi)
                        @foreach($provinsi['kota'] as $kota)
                            <option value="{{ $kota }}">{{ $kota }}</option>
                        @endforeach
                    @endforeach
                </x-splade-select>
                <x-splade-input id="alamat" type="text" name="alamat" :label="__('Alamat Tinggal')" required />
                <x-splade-select id="pekerjaan" name="pekerjaan" :label="__('Pekerjaan')" required >
                    <option value="" disabled selected>-- Pilih Pekerjaan</option>
                    <option value="Pelajar">Pelajar</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Karyawan">Karyawan</option>
                    <option value="Wirausaha">Wirausaha</option>
                    <option value="TNI">TNI</option>
                    <option value="Polri">Polri</option>
                    <option value="PNS">PNS</option>
                    <option value="Dosen">Dosen</option>
                    <option value="Guru">Guru</option>
                    <option value="Pengajar">Pengajar</option>
                    <option value="Tenaga Kesehatan">Tenaga Kesehatan</option>
                    <option value="Lainnya">Lainnya</option>
                </x-splade-select>

                <div class="my-4">
                    <span class="block mb-1 text-gray-700 font-sans"> Upload KTP Peserta <span aria-hidden="true" class="text-red-600" title="This field is required">*</span></span>
                    <KtpUpload upload-url="{{ route('website.lttq.tahsin.pendaftaran.store.ktp') }}"></KtpUpload>
                </div>

                <x-splade-select name="pembelajaran" :label="__('Pembelajaran')" required >
                    <option value="1">Offline / Hadir di lokasi</option>
                    <option value="2">Online / Zoom Meeting</option>
                    <option value="3">Offline dan Online</option>
                </x-splade-select>

                <hr class="my-4">

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                <div class="mb-2">
                    <h1 class="text-lg font-semibold mb-4">Rekaman Tilawah Quran Surah Fussilat Ayat 44-46</h1>
                    <div>
                        <div class="py-4">
                            <RecordVoice></RecordVoice>
                        </div>
                        <div class="border rounded-lg p-2 bg-stone-50" style="height: 400px; overflow: auto;">
                            <div style="height: 500px;">
                                <link rel="preconnect" href="https://fonts.googleapis.com">
                                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                                <link href="https://fonts.googleapis.com/css2?family=Scheherazade+New:wght@400;500;600;700&display=swap" rel="stylesheet">

                                @foreach($ayat as $key => $item)
                                    <div class="border-b py-2">
                                        <p class="text-4xl text-center tracking-wide align-[4px] leading-loose" dir="rtl" style="font-family: 'Scheherazade New', serif;">{{ $item }}</p> <x-carbon-circle-solid class="h-4 w-4 bg-gray-200" /><!-- Menampilkan teks Arabic dalam format Uthmani -->
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="file-upload" style="display: none;">
                        <p class="text-xs">Maksimal Ukuran File 20MB</p>
                        <AudioUpload upload-url="{{ route('website.lttq.tahsin.pendaftaran.store.rekaman') }}"></AudioUpload>
                    </div>
                </div>

                <hr class="my-4">
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

                                {{-- <tr class="border-b text-sm border-gray-200 0">
                                    <td class="px-3 py-3 font-semibold uppercase text-gray-900">
                                        Kode Unik
                                        <div class="font-base text-gray-600">
                                            123
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 font-semibold uppercase text-gray-900 text-center">

                                    </td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                    {{-- <ListBiayaPendaftaran></ListBiayaPendaftaran> --}}
                    {{-- @php
                        $total = 0;
                    @endphp
                    @foreach ([
                        ['name' => 'pendaftaran', 'label' => 'PENDAFTARAN', 'value' => 100000, 'disabled' => false, 'checked' => true, 'required' => true],
                        ['name' => 'spp1', 'label' => 'SPP BULAN I', 'value' => 120000, 'disabled' => false, 'checked' => true, 'required' => true],
                        ['name' => 'spp2', 'label' => 'SPP BULAN II', 'value' => 120000, 'disabled' => false, 'checked' => false, 'required' => false],
                        ['name' => 'spp3', 'label' => 'SPP BULAN III', 'value' => 120000, 'disabled' => false, 'checked' => false, 'required' => false],
                        ['name' => 'spp4', 'label' => 'SPP BULAN IV', 'value' => 120000, 'disabled' => false, 'checked' => false, 'required' => false],
                    ] as $data)
                        <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                                    <input type="checkbox" data="checkbox" class="w-5 h-5 {{ $data['disabled'] ? 'text-blue-300' : 'text-blue-600' }}  bg-gray-100 border-gray-300 rounded focus:ring-blue-500 " name="pembayaran_{{ $data['name'] }}"
                                        v-model="form.pembayaran{{ $data['name'] }}"
                                        value="{{ $data['name'] }}"
                                        id="{{ strtolower($data['name']) }}"
                                        {{ $data['checked'] ? 'checked' : '' }}
                                        {{ $data['disabled'] ? 'disabled' : '' }}
                                        {{ $data['required'] ? 'required' : '' }}
                                        />
                                    <label for="{{ strtolower($data['name']) }}" class="ms-2 text-sm font-medium text-gray-900 ">{{ $data['label'] }} {!! $data['required'] ? '<span aria-hidden="true" class="text-red-600" title="This field is required">*</span>' : '' !!}</label>
                                </dt>
                                <dd class="text-base font-semibold text-gray-900 flex justify-between">
                                    <div class="mr-2">
                                        Rp
                                    </div>
                                    <div>
                                        {{ number_format($data['value']) }}
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    @endforeach --}}
                    {{-- <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                        <dt class="text-base font-bold text-gray-900 dark:text-white">Sub Total</dt>
                        <dd id="sub-total" class="text-base font-bold text-gray-900 dark:text-white">Rp 0</dd>
                    </dl> --}}
                </div>





                {{-- <div class="flex items-center justify-center">
                    <button type="button" class="underline text-medium text-primary-700 rounded-lg flex items-center justify-between" onclick="checkRequired()">
                        Saya telah mengisi kolom input dengan benar
                    </button>

                    <div id="konfirmasidaftar" style="display:block">
                        <Link href="#konfirmasi-daftar" class="bg-primary-700 text-medium text-white py-2.5 px-5 rounded-lg flex items-center justify-between">
                            Daftar dan Lanjutkan
                        </Link>
                    </div>
                </div>

                <x-splade-script>
                    function checkRequired() {
                        let allValid = true;
                        document.querySelectorAll('input[required]').forEach((elem) => {
                            if (!elem.checkValidity()) {
                                allValid = false;
                            }
                        });
                        if (allValid) {
                            document.getElementById('konfirmasidaftar').style.display = 'block';
                        } else {
                            document.getElementById('konfirmasidaftar').style.display = 'none';
                        }
                    }
                </x-splade-script> --}}


                {{-- <x-splade-modal name="konfirmasi-daftar">
                    <div class="p-4">
                        <h2 class="text-2xl font-semibold">Konfirmasi Pendaftaran</h2> --}}
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
                            <button type="submit" class="bg-primary-700 text-medium text-white py-2.5 px-5 rounded-lg flex items-center justify-between">
                                Daftar & Lanjutkan Pembayaran <x-carbon-chevron-right class="h-8 w-8 pl-2" />
                            </button>
                        </div>
                    {{-- </div>
                </x-splade-modal> --}}
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
</div>

