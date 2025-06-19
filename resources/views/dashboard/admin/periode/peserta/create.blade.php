<x-splade-modal :unit="$unit">
    <x-splade-form action="{{ route('admin.peserta.store', ['unit' => $unit, 'periode' => $periode]) }}" method="POST" onkeydown="return event.key != 'Enter';"
        :default="[
            'jenis_peserta' => 'IKHWAN',
        ]"
    >
        @csrf

        <div class="relative">
            <x-forms.header>
                Tambah Data Peserta
            </x-forms.header>

            <x-forms.body >
                <label class="flex text-gray-700">
                    Masukkan Nomor HP Whatsapp Aktif :
                </label>
                <div class="flex items-center">
                    @include('auth.phone.phone-code')
                </div>
                <div class="flex items-center">
                    <div class="relative w-full">
                        <x-splade-input type="tel" name="phone_number" minlength="9" maxlength="14" placeholder="Masukkan Nomor Disini " required />
                    </div>
                </div>
                <div class="flex items-center justify-end ">
                    <div class="text-sm text-gray-500">
                        Contoh : 08123456789
                    </div>
                </div>
                <x-splade-input name="nama_peserta" :label="__('Nama peserta')" required/>
                <x-splade-select name="jenis_peserta" :label="__('Jenis')" :options="$jenis" option-label="nama" option-value="nama" choices />
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
                <x-splade-select name="jadwal" :label="__('Jadwal')" :options="$jadwals" option-label="nama_jadwal" option-value="id" required choices />
            </x-forms.body>

            <x-forms.footer />
        </div>
    </x-splade-form>
</x-splade-modal>

