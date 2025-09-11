<x-layouts.main :unit="$unit">
    <x-layouts.card>
       <label class="text-xl font-semibold uppercase">Periode {{ $data_periode->nama }}</label>
    </x-layouts.card>
    <div class="p-4">
        <x-splade-form method="GET" class="sm:flex items-center sm:space-x-2 border border-gray-300 rounded-lg p-2 mb-2"
            :default="[
                    'cari' => request()->query('cari') ?? '',
                    'jenis_peserta' => request()->query('jenis_peserta') ?? '',
                    'level' => request()->query('level') ?? '',
                    'hari' => request()->query('hari') ?? '',
                    'pengajar' => request()->query('pengajar') ?? '',
                ],
            ">
            <x-splade-input value="{{ request()->query('cari') }}" name="cari" placeholder="Nama Peserta" class="flex-grow"/>
            <x-splade-select name="jenis_peserta">
                <option value="" disabled selected>-- Jenis</option>
                <option value="ikhwan">Ikhwan</option>
                <option value="akhwat">Akhwat</option>
                <option value="">Semua</option>
            </x-splade-select>
            <x-splade-select name="level">
                <option value="" disabled selected>-- Level</option>
                @foreach ( $data_level as $level )
                    <option value="{{ $level->id }}">{{ $level->nama }}</option>
                @endforeach
                <option value="">Semua</option>
            </x-splade-select>
            <x-splade-select name="pengajar">
                <option value="" disabled selected>-- Pengajar</option>
                @foreach ( $data_pengajar as $pengajar )
                    <option value="{{ $pengajar->id }}">{{ $pengajar->kode_nama_pengajar }}</option>
                @endforeach
                <option value="">Semua</option>
            </x-splade-select>
            <x-splade-select name="hari">
                <option value="" disabled selected>-- Hari</option>
                <option value="SENIN">SENIN</option>
                <option value="SELASA">SELASA</option>
                <option value="RABU">RABU</option>
                <option value="KAMIS">KAMIS</option>
                <option value="JUMAT">JUMAT</option>
                <option value="SABTU">SABTU</option>
                <option value="AHAD">AHAD</option>
                <option value="">Semua</option>
            </x-splade-select>
            <x-splade-submit :label="__('Cari')"/>
        </x-splade-form>
    </div>
    <div class="p-4">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-2 lg:gap-6">
            <x-splade-lazy>
                <x-slot:placeholder>
                    <div class="rounded-lg border border-gray-300 p-4">
                        <div class="flex animate-pulse space-x-4">
                            <div class="size-10 rounded-full bg-gray-200"></div>
                            <div class="flex-1 space-y-6 py-1">
                                <div class="h-2 rounded bg-gray-200"></div>
                                <div class="space-y-3">
                                    <div class="grid grid-cols-3 gap-4">
                                        <div class="col-span-2 h-2 rounded bg-gray-200"></div>
                                        <div class="col-span-1 h-2 rounded bg-gray-200"></div>
                                    </div>
                                    <div class="h-2 rounded bg-gray-200"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-slot:placeholder>
                @forelse ($data_jadwal as $item)
                <div class="space-y-4">
                    <div class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm  sm:p-6">
                        <p class="text-xl font-semibold text-gray-900 flex justify-end ">Kelas {{ $item->nama_jadwal }}</p>
                        <div class="p-4 border rounded-md">
                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500">Jenis Peserta</dt>
                                    <dd class="text-base font-medium text-gray-900">{{ $item->jenis_peserta }}</dd>
                                </dl>
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500">Level</dt>
                                    <dd class="text-base font-medium text-gray-900">{{ $item->level->nama ?? '-' }}</dd>
                                </dl>
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500">Batasan Peserta</dt>
                                    <dd class="text-base font-medium text-gray-900">{{ $item->batasan_peserta }}</dd>
                                </dl>
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500">Status Belajar</dt>
                                    <dd class="text-base font-medium text-gray-900">{{ $item->status_belajar }}</dd>
                                </dl>
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500">Hari</dt>
                                    <dd class="text-base font-medium text-gray-900">{{ $item->hari_belajar }}</dd>
                                </dl>
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500">Jam Mulai</dt>
                                    <dd class="text-base font-medium text-gray-900">{{ $item->jam_mulai }}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="flex w-full items-center justify-start space-x-2">
                            <Link href="{{ route('pengajar.jadwal.data.kelas', ['unit' => $unit, 'periode' => $periode, 'kelas' => $item->id]) }}" class="flex items-center justify-center rounded-lg border border-primary-700 px-5 py-2.5 text-sm font-medium text-primary-700">
                                Lihat Data  @svg('carbon-arrow-right', 'ml-2 h-5 w-5 text-primary-700')
                            </Link>
                        </div>
                    </div>
                </div>
                @empty
                    Belum Ada Data
                @endforelse
            </x-splade-lazy>
        </div>
        <div class="p-2 text-xs text-gray-500">
            {{ $data_jadwal->appends(request()->query())->links() }}
        </div>
    </div>
</x-layouts.main>
