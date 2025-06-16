<x-layouts.main>
    <div class="p-4">
        <h2 class="text-2xl font-bold uppercase">
            Data Absensi Karyawan
        </h2>
    </div>

    <div class="mx-auto max-w-lg">
        <div class="my-4 bg-white border rounded-lg p-4">
            <h3 class="text-lg font-semibold relative float-none text-center underline">Hari ini</h3>
            <HariTanggalJamKecil />
        </div>
    </div>
    <div class="m-4">
        <div class="my-8">
            <div class="mb-4">
                <div class="space-y-4 bg-white border p-4 rounded-lg">
                    <div class="flex items-end justify-end">
                        <a href="#" class="inline-flex items-center px-4 py-2 bg-green-400 rounded-md font-semibold text-xs text-white">
                            Export Data
                        </a>
                    </div>
                    {{-- Filter Bulan & Tahun --}}
                    <form method="GET" class="flex flex-wrap items-center gap-2 sm:gap-4">
                        <label for="bulan" class="text-sm text-gray-700">Bulan</label>
                        <select id="bulan" name="bulan" class="w-28 border rounded-md text-sm px-2 py-1">
                            <option value="">Semua</option>
                            @php
                                $bulanSekarang = request('bulan') ?? date('n');
                                $namaBulan = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                            @endphp
                            @foreach ($namaBulan as $key => $nama)
                                <option value="{{ $key }}" {{ $bulanSekarang == $key ? 'selected' : '' }}>{{ $nama }}</option>
                            @endforeach
                        </select>

                        <label for="tahun" class="text-sm text-gray-700">Tahun</label>
                        <select id="tahun" name="tahun" class="w-28 border rounded-md text-sm px-2 py-1">
                            <option value="">Semua</option>
                            @php
                                $tahunSekarang = request('tahun') ?? date('Y');
                            @endphp
                            @for ($i = date('Y'); $i >= 2024; $i--)
                                <option value="{{ $i }}" {{ $tahunSekarang == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>

                        <button type="submit" class="text-sm bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded-md">
                            Tampilkan
                        </button>
                    </form>

                    {{-- Tanggalan --}}
                    <div class="flex overflow-x-auto gap-2 pb-2 scrollbar-hide">
                        @php
                            \Carbon\Carbon::setLocale('id');
                            $bulan = str_pad($bulanSekarang, 2, '0', STR_PAD_LEFT);
                            $tahun = $tahunSekarang;
                            $hariIni = date('Y-m-d');

                            $mulai = new DateTime("$tahun-$bulan-01");
                            $akhir = (clone $mulai)->modify('last day of this month');
                        @endphp

                        @for ($tgl = clone $mulai; $tgl <= $akhir; $tgl->modify('+1 day'))
                            @php
                                $carbonDate = \Carbon\Carbon::parse($tgl);
                                $tanggalParam = request('tanggal');
                                $isHariIni = $carbonDate->isToday();
                                $isTanggalDipilih = $tanggalParam === $carbonDate->toDateString();
                                $isSabtuMinggu = in_array($carbonDate->dayOfWeek, [\Carbon\Carbon::SUNDAY, \Carbon\Carbon::SATURDAY]);

                                // Tentukan URL tanggal saat diklik
                                $url = request()->fullUrlWithQuery([
                                    'tanggal' => $carbonDate->toDateString(),
                                    'bulan' => $bulanSekarang,
                                    'tahun' => $tahunSekarang,
                                ]);
                            @endphp

                            <a href="{{ $url }}"
                            id="{{ $isTanggalDipilih || (!$tanggalParam && $isHariIni) ? 'tanggal-terpilih' : '' }}"
                            class="relative min-w-[110px] px-3 py-2 my-4 border rounded-md text-center
                                {{ $isTanggalDipilih ? 'bg-blue-300 border-blue-600' : ($isHariIni ? 'bg-blue-100 border-blue-600' : ($isSabtuMinggu ? 'bg-gray-100 border-gray-400' : 'bg-white border-gray-200')) }}">

                                {{-- Segitiga indikator jika dipilih --}}
                                @if ($isTanggalDipilih || (!$tanggalParam && $isHariIni))
                                    <span class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-0 h-0 border-l-8 border-r-8 border-b-8 border-transparent border-b-blue-500"></span>
                                @endif

                                <p class="text-xs text-gray-600">{{ $carbonDate->translatedFormat('l') == 'Minggu' ? 'Ahad' : $carbonDate->translatedFormat('l') }}</p>
                                <p class="text-sm {{ $isSabtuMinggu ? 'text-gray-600 font-light' : 'text-gray-800 font-medium' }}">
                                    {{ $carbonDate->translatedFormat('d F Y') }}
                                </p>
                            </a>
                        @endfor

                        <x-splade-script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const target = document.getElementById('tanggal-terpilih');
                                if (target) {
                                    target.scrollIntoView({
                                        behavior: 'smooth',
                                        inline: 'center',
                                        block: 'nearest'
                                    });
                                }
                            });
                        </x-splade-script>
                    </div>

                </div>


            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-2">
                <div class="col-span-2 space-y-2">
                    <div class="overflow-x-auto bg-white border rounded-lg py-4">
                        <h4 class="text-md font-medium text-gray-800 px-4 uppercase pb-2">
                            Daftar Absensi -
                            <label class="font-bold underline">
                                {{ \Carbon\Carbon::parse(request('tanggal') ?? $hariIni)->translatedFormat('d F Y') }}
                            </label>
                        </h4>
                        <hr>
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase">
                                <tr>
                                    <th class="px-6 py-3">Nama</th>
                                    <th class="px-6 py-3">Jam Masuk</th>
                                    <th class="px-6 py-3">Jam Pulang</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawan_hadir_hari_ini as $item)
                                    <tr class="text-gray-900 text-base">
                                        <td class="px-6 py-4">{{ $item->user->name }} - {{ $item->user->phone_number }}</td>
                                        <td class="px-6 py-4">{{ $item->waktu_datang ? $item->waktu_datang->format('H:i') . ' WITA' : '-' }}</td>
                                        <td class="px-6 py-4">{{ $item->waktu_pulang ? $item->waktu_pulang->format('H:i') . ' WITA' : '-'}}</td>
                                        <td class="px-6 py-4">
                                            <span class="me-2 inline-flex items-center rounded bg-primary-200 px-2.5 py-0.5 text-xs font-medium text-gray-00">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <Link modal href="{{ route('hrd.karyawan.absensi.detail', ['absensi' => $item->id]) }}"
                                                class="text-xs font-semibold uppercase text-primary-700 hover:text-white bg-white  hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
                                                Detail
                                            </Link>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="overflow-x-auto bg-white border rounded-lg py-4">
                        <h4 class="text-md font-medium text-gray-800 px-4 uppercase pb-2">
                            Belum Absen -
                            <label class="font-bold underline">
                                {{ \Carbon\Carbon::parse(request('tanggal') ?? $hariIni)->translatedFormat('d F Y') }}
                            </label>
                        </h4>
                        <hr>
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase">
                                <tr>
                                    <th class="px-6 py-3">Nama</th>
                                    <th class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_karyawan_tidak_hadir_hari_ini as $item)
                                    <tr class="text-gray-900 text-base">
                                        <td class="px-6 py-4">{{ $item->name }}</td>
                                        <td class="px-6 py-4">
                                            <span class="me-2 inline-flex items-center rounded bg-red-200 px-2.5 py-0.5 text-xs font-medium text-gray-00">
                                                Belum Absen
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="bg-white py-8 dark:bg-gray-900 md:py-16">
        <div class=" px-4 mx-auto">

        </div>
    </section>



</x-layouts.main>
