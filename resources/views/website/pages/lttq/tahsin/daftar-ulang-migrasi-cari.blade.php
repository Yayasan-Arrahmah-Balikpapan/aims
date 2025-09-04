<div class="min-h-screen bg-gray-100">

    <div class="text-center py-4 bg-gray-100">
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
            <h1 class="text-2xl font-bold text-center">Daftar Ulang Tahsin</h1>
            <p class="text-center font-normal text-md pb-2">Angkatan {{ $periode->angkatan }}</p>
            <hr class="my-2">
            <p class="text-center font-semibold text-md pb-2">Konfirmasi Data Peserta</p>
            <x-splade-form action="{{ route('website.lttq.tahsin.daftar-ulang.store') }}"
                confirm-text="Apakah data yang anda masukkan sudah benar ?"
                confirm="Konfirmasi"
                confirm-button="Benar"
                cancel-button="Belum"
                method="POST"
                :default="[
                                'phone_number' => auth()->user()->phone_number ?? '',
                                'jenis_peserta' => 'ikhwan',
                                'name' => '',
                                'kota_domisili' => 'Kota Balikpapan',
                                'tanggal' => 01,
                                'bulan' => 01,
                                'tahun' => 1970,
                                'pekerjaan' => 'Lainnya',
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
                <div class="flex items-center justify-end ">
                    <div class="text-sm text-gray-500">
                        *Pastikan Nomor Whatsapp Aktif
                    </div>
                </div>

                <x-splade-input id="name" type="text" name="name" :label="__('Nama Peserta')" required autofocus  />
                <x-splade-select name="jenis_peserta" :label="__('Jenis Peserta')" required  readonly>
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
                    <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                    <option value="Lainnya">Lainnya</option>
                </x-splade-select>

                <div class="flex items-center justify-center mt-6">
                    <x-splade-submit class="bg-primary-700 text-medium text-white py-2.5 px-5 rounded-lg flex items-center justify-between">
                        Konfirmasi & Lanjutkan <x-carbon-chevron-right class="h-8 w-8 pl-2" />
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

