<div class="min-h-screen bg-gray-100">

    <div class="text-center py-4 bg-gray-100">
        <p class="text-md space-x-10">
            <Link href="{{ url('/') }}" class=" text-gray-600 hover:text-gray-900">
                &larr; Kembali
            </Link>

            @auth
                <Link href="{{ url('/') }}/dashboard" class="p-2 border rounded-md border-gray-600 text-800 hover:text-primary-900">
                    Ke Dashboard &#x02192;
                </Link>
            @endauth
        </p>
    </div>

    <div class=" flex justify-center items-center p-4 bg-gray-100">
        <div class="w-full sm:max-w-lg px-6 py-4 bg-white shadow-md rounded-lg">
            <div class="space-y-2 flex items-center justify-center gap-6 md:space-y-0">
                <a href="#" class="shrink-0 m-4">
                    <img class="w-48" src="{{ asset('assets/logo/logo-ramadhan-1447h.png') }}" alt="Logo Lomba Ramadhan">
                </a>
            </div>
            <h1 class="text-2xl font-bold text-center">Pendaftaran Lomba</h1>
            <p class="text-center font-normal text-md pb-2">Semarak Ramadhan 1447 H</p>
            <x-splade-form action="{{ route('website.ramadhan.lomba.daftar.store') }}"
                confirm-text="Apakah data yang anda masukkan sudah benar ?"
                confirm="Konfirmasi"
                confirm-button="Benar"
                cancel-button="Belum"
                method="POST"
                :default="[
                                'phone_number' => auth()->user()->phone_number ?? '',
                                'jenis_peserta' => 'ikhwan',
                            ]"
                >
                @csrf

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
                                $tahun_terakhir = date('Y', strtotime('-3 years'));
                                $tahun_pertama = 2000;
                            @endphp
                            @for ($i = $tahun_terakhir; $i >= $tahun_pertama; $i--)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </x-splade-select>
                    </div>
                </div>
                <x-splade-input id="alamat" type="text" name="alamat" :label="__('Alamat Tinggal')" required />

                <hr class="my-4">
                <h1 class="text-lg">Pilih Pendaftaran Jenis Lomba</h1>
                <h1 class="text-sm mb-2 bg-red-300 p-1 rounded-md">Centang Bagian Kanan Setiap PIlihan Lomba</h1>
                <h1 class="text-sm mb-2 bg-green-200 p-1 rounded-md">Boleh Pilih Lebih Dari Satu Lomba</h1>
                <div class="">
                    <div class="relative overflow-x-auto border rounded-md mb-4">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                            <thead>
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <th scope="col"
                                        class="px-3 py-3 font-bold text-gray-600 whitespace-nowrap bg-gray-50 ">
                                        Perlombaan
                                    </th>
                                    <th scope="col"
                                        class="px-3 py-3 font-bold text-gray-600 whitespace-nowrap bg-gray-50 text-center">
                                        Pilihan
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b text-sm border-gray-200 0">
                                    <td class="px-3 py-3 font-semibold text-gray-900">
                                        LOMBA MENGGAMBAR & MEWARNAI A
                                        <div class="text-gray-600 bg-blue-50 font-medium p-1 mb-1 rounded-md">
                                            Anak Usia 4-6 Tahun - Mewarnai
                                        </div>
                                        <div class="font-base text-md text-gray-700 border border-gray-500 rounded-md inline-block p-1">
                                            RP. 50.000,-
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 font-semibold text-gray-900 flex justify-center items-center">
                                        <input type="checkbox" v-model="form.pembayaran1" name="pembayaran1"
                                            class="w-6 h-6 rounded border-gray-500 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                        >
                                    </td>
                                </tr>
                                <tr class="border-b text-sm border-gray-200 0">
                                    <td class="px-3 py-3 font-semibold text-gray-900">
                                        LOMBA MENGGAMBAR & MEWARNAI B
                                        <div class="text-gray-600 bg-blue-50 font-medium p-1 mb-1 rounded-md">
                                            Anak Usia 7-10 Tahun - Menggambar & Mewarnai
                                        </div>
                                        <div class="font-base text-md text-gray-700 border border-gray-500 rounded-md inline-block p-1">
                                            RP. 50.000,-
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 font-semibold text-gray-900 flex justify-center items-center">
                                        <input type="checkbox" v-model="form.pembayaran2" name="pembayaran2"
                                            class="w-6 h-6 rounded border-gray-500 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                        >
                                    </td>
                                </tr>
                                <tr class="border-b text-sm border-gray-200 0">
                                    <td class="px-3 py-3 font-semibold text-gray-900">
                                        LOMBA ADZAN & IQOMAH A
                                        <div class="text-gray-600 bg-green-50 font-medium p-1 mb-1 rounded-md">
                                            Anak Usia 5-8 Tahun
                                        </div>
                                        <div class="font-base text-md text-gray-700 border border-gray-500 rounded-md inline-block p-1">
                                            RP. 50.000,-
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 font-semibold text-gray-900 flex justify-center items-center">
                                        <input type="checkbox" v-model="form.pembayaran3" name="pembayaran3"
                                            class="w-6 h-6 rounded border-gray-500 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                        >
                                    </td>
                                </tr>
                                <tr class="border-b text-sm border-gray-200 0">
                                    <td class="px-3 py-3 font-semibold text-gray-900">
                                        LOMBA ADZAN & IQOMAH B
                                        <div class="text-gray-600 bg-green-50 font-medium p-1 mb-1 rounded-md">
                                            Anak Usia 9-12 Tahun
                                        </div>
                                        <div class="font-base text-md text-gray-700 border border-gray-500 rounded-md inline-block p-1">
                                            RP. 50.000,-
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 font-semibold text-gray-900 flex justify-center items-center">
                                        <input type="checkbox" v-model="form.pembayaran4" name="pembayaran4"
                                            class="w-6 h-6 rounded border-gray-500 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                        >
                                    </td>
                                </tr>
                                <tr class="border-b text-sm border-gray-200 0">
                                    <td class="px-3 py-3 font-semibold text-gray-900">
                                        LOMBA ADZAN & IQOMAH C
                                        <div class="text-gray-600 bg-green-50 font-medium p-1 mb-1 rounded-md">
                                            Anak Usia 13-15 Tahun
                                        </div>
                                        <div class="font-base text-md text-gray-700 border border-gray-500 rounded-md inline-block p-1">
                                            RP. 50.000,-
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 font-semibold text-gray-900 flex justify-center items-center">
                                        <input type="checkbox" v-model="form.pembayaran5" name="pembayaran5"
                                            class="w-6 h-6 rounded border-gray-500 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                        >
                                    </td>
                                </tr>
                                <tr class="border-b text-sm border-gray-200 0">
                                    <td class="px-3 py-3 font-semibold text-gray-900">
                                        LOMBA TAHFIDZ A
                                        <div class="text-gray-600 bg-yellow-50 font-medium p-1 mb-1 rounded-md">
                                            Anak Usia 3-6 Tahun
                                        </div>
                                        <div class="font-base text-md text-gray-700 border border-gray-500 rounded-md inline-block p-1">
                                            RP. 50.000,-
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 font-semibold text-gray-900 flex justify-center items-center">
                                        <input type="checkbox" v-model="form.pembayaran6" name="pembayaran6"
                                            class="w-6 h-6 rounded border-gray-500 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                        >
                                    </td>
                                </tr>
                                <tr class="border-b text-sm border-gray-200 0">
                                    <td class="px-3 py-3 font-semibold text-gray-900">
                                        LOMBA TAHFIDZ B
                                        <div class="text-gray-600 bg-yellow-50 font-medium p-1 mb-1 rounded-md">
                                            Anak Usia 7-10 Tahun
                                        </div>
                                        <div class="font-base text-md text-gray-700 border border-gray-500 rounded-md inline-block p-1">
                                            RP. 50.000,-
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 font-semibold text-gray-900 flex justify-center items-center">
                                        <input type="checkbox" v-model="form.pembayaran7" name="pembayaran7"
                                            class="w-6 h-6 rounded border-gray-500 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                        >
                                    </td>
                                </tr>
                                <tr class="border-b text-sm border-gray-200 0">
                                    <td class="px-3 py-3 font-semibold text-gray-900">
                                        LOMBA TAHFIDZ C
                                        <div class="text-gray-600 bg-yellow-50 font-medium p-1 mb-1 rounded-md">
                                            Anak Usia 11-15 Tahun
                                        </div>
                                        <div class="font-base text-md text-gray-700 border border-gray-500 rounded-md inline-block p-1">
                                            RP. 50.000,-
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 font-semibold text-gray-900 flex justify-center items-center">
                                        <input type="checkbox" v-model="form.pembayaran8" name="pembayaran8"
                                            class="w-6 h-6 rounded border-gray-500 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                        >
                                    </td>
                                </tr>
                                <tr class="border-b text-sm border-gray-200 0">
                                    <td class="px-3 py-3 font-semibold text-gray-900">
                                        LOMBA CERDAS CERMAT (Per-Kelompok)
                                        <div class="text-gray-600 bg-red-50 font-medium p-1 mb-1 rounded-md">
                                            Kategori SD Kelas 4-6
                                        </div>
                                        <div id="formsd" class="" v-show="form.pembayaran9">
                                            <div class="border rounded-md p-2">
                                                <x-splade-input type="text" name="namapesertasd1" :label="__('Nama Peserta 1')"/>
                                                <x-splade-input type="text" name="asalsekolahsd1" :label="__('Asal Sekolah Peserta 1')"/>
                                                <div class="mb-1 grid grid-cols-2 gap-1">
                                                    <x-splade-input type="text" name="kelaspesertasd1" :label="__('Kelas Peserta 1')"/>
                                                    <x-splade-select name="jenispesertasd1" :label="__('Jenis Peserta 1')" >
                                                        <option value="ikhwan">Ikhwan / Laki-laki</option>
                                                        <option value="akhwat">Akhwat / Perempuan</option>
                                                    </x-splade-select>
                                                </div>
                                            </div>
                                            <div class="border rounded-md p-2">
                                                <x-splade-input type="text" name="namapesertasd2" :label="__('Nama Peserta 2')"/>
                                                <x-splade-input type="text" name="asalsekolahsd2" :label="__('Asal Sekolah Peserta 2')"/>
                                                <div class="mb-1 grid grid-cols-2 gap-1">
                                                    <x-splade-input type="text" name="kelaspesertasd2" :label="__('Kelas Peserta 2')"/>
                                                    <x-splade-select name="jenispesertasd2" :label="__('Jenis Peserta 2')" >
                                                        <option value="ikhwan">Ikhwan / Laki-laki</option>
                                                        <option value="akhwat">Akhwat / Perempuan</option>
                                                    </x-splade-select>
                                                </div>
                                            </div>
                                            <div class="border rounded-md p-2">
                                                <x-splade-input type="text" name="namapesertasd3" :label="__('Nama Peserta 3')"/>
                                                <x-splade-input type="text" name="asalsekolahsd3" :label="__('Asal Sekolah Peserta 3')"/>
                                                <div class="mb-1 grid grid-cols-2 gap-1">
                                                    <x-splade-input type="text" name="kelaspesertasd3" :label="__('Kelas Peserta 3')"/>
                                                    <x-splade-select name="jenispesertasd3" :label="__('Jenis Peserta 3')" >
                                                        <option value="ikhwan">Ikhwan / Laki-laki</option>
                                                        <option value="akhwat">Akhwat / Perempuan</option>
                                                    </x-splade-select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="font-base text-md text-gray-700 border border-gray-500 rounded-md inline-block p-1">
                                            RP. 100.000,-
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 font-semibold text-gray-900 flex justify-center items-center">
                                        <input id="inputformsd" type="checkbox" v-model="form.pembayaran9" name="pembayaran9"
                                            class="w-6 h-6 rounded border-gray-500 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                        >
                                    </td>
                                </tr>
                                <tr class="border-b text-sm border-gray-200 0">
                                    <td class="px-3 py-3 font-semibold text-gray-900">
                                        LOMBA CERDAS CERMAT (Per-Kelompok)
                                        <div class="text-gray-600 bg-red-50 font-medium p-1 mb-1 rounded-md">
                                            Kategori SMP Kelas 7-9
                                        </div>
                                        <div id="formsmp" class="" v-show="form.pembayaran10">
                                            <div class="border rounded-md p-2">
                                                <x-splade-input type="text" name="namapesertasmp1" :label="__('Nama Peserta 1')"/>
                                                <x-splade-input type="text" name="asalsekolahsmp1" :label="__('Asal Sekolah Peserta 1')"/>
                                                <div class="mb-1 grid grid-cols-2 gap-1">
                                                    <x-splade-input type="text" name="kelaspesertasmp1" :label="__('Kelas Peserta 1')"/>
                                                    <x-splade-select name="jenispesertasmp1" :label="__('Jenis Peserta 1')" >
                                                        <option value="ikhwan">Ikhwan / Laki-laki</option>
                                                        <option value="akhwat">Akhwat / Perempuan</option>
                                                    </x-splade-select>
                                                </div>
                                            </div>
                                            <div class="border rounded-md p-2">
                                                <x-splade-input type="text" name="namapesertasmp2" :label="__('Nama Peserta 2')"/>
                                                <x-splade-input type="text" name="asalsekolahsmp2" :label="__('Asal Sekolah Peserta 2')"/>
                                                <div class="mb-1 grid grid-cols-2 gap-1">
                                                    <x-splade-input type="text" name="kelaspesertasmp2" :label="__('Kelas Peserta 2')"/>
                                                    <x-splade-select name="jenispesertasmp2" :label="__('Jenis Peserta 2')" >
                                                        <option value="ikhwan">Ikhwan / Laki-laki</option>
                                                        <option value="akhwat">Akhwat / Perempuan</option>
                                                    </x-splade-select>
                                                </div>
                                            </div>
                                            <div class="border rounded-md p-2">
                                                <x-splade-input type="text" name="namapesertasmp3" :label="__('Nama Peserta 3')"/>
                                                <x-splade-input type="text" name="asalsekolahsmp3" :label="__('Asal Sekolah Peserta 3')"/>
                                                <div class="mb-1 grid grid-cols-2 gap-1">
                                                    <x-splade-input type="text" name="kelaspesertasmp3" :label="__('Kelas Peserta 3')"/>
                                                    <x-splade-select name="jenispesertasmp3" :label="__('Jenis Peserta 3')" >
                                                        <option value="ikhwan">Ikhwan / Laki-laki</option>
                                                        <option value="akhwat">Akhwat / Perempuan</option>
                                                    </x-splade-select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="font-base text-md text-gray-700 border border-gray-500 rounded-md inline-block p-1">
                                            RP. 100.000,-
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 font-semibold text-gray-900 flex justify-center items-center">
                                        <input type="checkbox" v-model="form.pembayaran10" name="pembayaran10"
                                            class="w-6 h-6 rounded border-gray-500 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="bg-gray-100 text-xs font-medium text-gray-500 p-1 text-end">* Centang Jika Memilih</p>
                    </div>

                </div>
                <hr>
                <div class="my-4 bg-stone-100 p-4 rounded-lg font-semibold">
                    <p class="text-sm text-gray-500 mb-2">
                        Dengan ini saya menyetujui aturan-aturan yang berlaku untuk mendaftar diri sebagai Peserta Lomba Semarak Ramadhan Arrahmah :
                    </p>
                    <table class="w-full text-xs text-gray-700">
                        <tbody>
                            <tr class="border-b">
                                <td class="px-4">1.</td>
                                <td class="py-2">Peserta lomba adalah anak yang didaftarkan secara resmi oleh orang tua/wali.</td>
                            </tr>
                            <tr class="border-b bg-stone-200">
                                <td class="px-4">2.</td>
                                <td class="py-2">Peserta wajib mengikuti seluruh rangkaian perlombaan sesuai jadwal dan ketentuan yang telah ditetapkan oleh panitia.</td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4">3.</td>
                                <td class="py-2">Peserta wajib menjaga adab, akhlak, dan sportivitas selama kegiatan perlombaan berlangsung.</td>
                            </tr>
                            <tr class="border-b bg-stone-200">
                                <td class="px-4">4.</td>
                                <td class="py-2">Orang tua/wali bersedia memastikan anak hadir tepat waktu dan mematuhi aturan teknis lomba sesuai cabang yang diikuti.</td>
                            </tr>
                            <tr class="border-b">
                                <td class="px-4">5.</td>
                                <td class="py-2">Keputusan dewan juri bersifat mutlak dan tidak dapat diganggu gugat.</td>
                            </tr>
                            <tr class="border-b bg-stone-200">
                                <td class="px-4">6.</td>
                                <td class="py-2">Peserta bersedia mengikuti aturan tambahan yang ditetapkan panitia demi kelancaran dan ketertiban acara.</td>
                            </tr>
                            <tr>
                                <td class="px-4">7.</td>
                                <td class="py-2">Apabila peserta mengundurkan diri setelah pendaftaran, maka biaya pendaftaran tidak dapat dikembalikan.</td>
                            </tr>
                            <tr class="border-b bg-stone-200">
                                <td class="px-4">8.</td>
                                <td class="py-2">Usia peserta lomba ditentukan per-tanggal 20 Januari 2026.</td>
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
                    <x-splade-submit type="submit" class="bg-primary-700 text-medium text-white py-2.5 px-5 rounded-lg flex items-center justify-between">
                        Daftar & Lanjutkan Pembayaran <x-carbon-chevron-right class="h-8 w-8 pl-2" />
                    </x-splade-submit>
                </div>
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

