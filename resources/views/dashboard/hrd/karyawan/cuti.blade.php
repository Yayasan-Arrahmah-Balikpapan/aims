<x-layouts.main>
    <div class="p-4">
        <h2 class="text-2xl font-bold uppercase">
            Data Cuti Karyawan
        </h2>
    </div>
    <div class="m-4">
        <div class="space-y-4 bg-white border p-4 rounded-lg">
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
        </div>
    </div>

    <div class="m-4">
        <div class="space-y-2">
            @foreach ($data_cuti as $cuti)
                <div class="bg-white p-4 rounded-lg border">
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4">
                            <dl class="col-span-1">
                                <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Nama:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                    {{ $cuti->user->name ?? '-' }}, {{ $cuti->user->phone_number }}
                                </dd>
                            </dl>
                            <dl class="col-span-1">
                                <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Divisi:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                    -
                                </dd>
                            </dl>
                            <dl class="col-span-1">
                                <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>
                                    @if ($cuti->status == 'MENUNGGU PERSETUJUAN')
                                        <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-yellow-200 px-2.5 py-0.5 text-xs font-medium text-gray-00">
                                            {{ $cuti->status }}
                                        </dd>
                                    @elseif ($cuti->status == 'DISETUJUI')
                                        <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-green-200 px-2.5 py-0.5 text-xs font-medium text-gray-00">
                                            {{ $cuti->status }}
                                        </dd>
                                    @elseif ($cuti->status == 'DITOLAK')
                                        <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-red-200 px-2.5 py-0.5 text-xs font-medium text-gray-00">
                                            {{ $cuti->status }}
                                        </dd>
                                    @else
                                        -
                                    @endif
                                </dt>
                            </dl>
                        </div>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                <dl class="col-span-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Tanggal Pengajuan:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $cuti->created_at->translatedFormat('d F Y') }}
                                    </dd>
                                </dl>
                                <dl class="col-span-2">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Keperluan:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                        {{ $cuti->alasan }}
                                    </dd>
                                </dl>
                            </div>

                            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                                <dl class="col-auto">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Tanggal Mulai:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->translatedFormat('d F Y') }}</dd>
                                </dl>

                                <dl class="col-auto">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Tanggal Selesai:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->translatedFormat('d F Y') }}</dd>
                                </dl>

                                <div class="col-span-2 flex justify-end text-right items-end gap-2">
                                    @if ($cuti->status == 'MENUNGGU PERSETUJUAN')
                                        <x-splade-form
                                                action="{{ route('hrd.karyawan.cuti.tolak', $cuti->id) }}"
                                                confirm="Konfirmasi Tolak Cuti"
                                                confirm-text="{{ $cuti->user->name ?? '-' }}, {{ $cuti->user->phone_number }}"
                                                confirm-button="Ya"
                                                cancel-button="Tidak"
                                            >
                                            @csrf
                                            <button type="submit" class="inline-flex justify-between items-center px-4 py-2 bg-red-500 rounded-md font-semibold text-white">
                                                Tolak @svg('carbon-misuse-outline', 'h-5 w-5 ml-2')
                                            </button>
                                        </x-splade-form>
                                        <x-splade-form
                                                action="{{ route('hrd.karyawan.cuti.setujui', $cuti->id) }}"
                                                confirm="Konfirmasi Setujui Cuti"
                                                confirm-text="{{ $cuti->user->name ?? '-' }}, {{ $cuti->user->phone_number }}"
                                                confirm-button="Ya"
                                                cancel-button="Tidak"
                                            >
                                            @csrf
                                            <button type="submit" class="inline-flex justify-between items-center px-4 py-2 bg-primary-600 rounded-md font-semibold text-white">
                                                Setujui @svg('carbon-checkmark-outline', 'h-5 w-5 ml-2')
                                            </button>
                                        </x-splade-form>
                                    @elseif ($cuti->status == 'DISETUJUI')
                                        @svg('carbon-checkmark-outline', 'h-10 w-10 mr-2 text-primary-600')
                                    @elseif ($cuti->status == 'DITOLAK')
                                        @svg('carbon-misuse-outline', 'h-10 w-10 mr-2 text-red-600')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="p-2 text-xs text-gray-500">
            {{ $data_cuti->appends(request()->query())->links() }}
        </div>
    </div>

    <section class="bg-white py-8 dark:bg-gray-900 md:py-16">
        <div class=" px-4 mx-auto">

        </div>
    </section>



</x-layouts.main>
