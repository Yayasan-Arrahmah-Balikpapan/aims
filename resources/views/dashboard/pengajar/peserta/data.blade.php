<x-layouts.main :unit="$unit">
    <x-layouts.card>
       <label class="text-xl font-semibold uppercase">Periode {{ $data_periode->nama }}</label>
    </x-layouts.card>
    <div class="p-4">
        <div class="w-full">
            <div class="container mx-auto">
                <x-splade-form method="GET" class="sm:flex items-center sm:space-x-2 border border-gray-300 rounded-lg p-2 mb-2"
                    :default="[
                            'cari' => request()->query('cari') ?? '',
                            'jenis_peserta' => request()->query('jenis_peserta') ?? '',
                            'status' => request()->query('status') ?? '',
                            'peserta' => request()->query('peserta') ?? '',
                            'level' => request()->query('level') ?? '',
                        ],
                    ">
                    <x-splade-input value="{{ request()->query('cari') }}" name="cari" placeholder="Nama Peserta" class="flex-grow"/>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-1">
                        <x-splade-select name="jenis_peserta">
                            <option value="" disabled selected>-- Jenis</option>
                            <option value="ikhwan">Ikhwan</option>
                            <option value="akhwat">Akhwat</option>
                            <option value="">Semua</option>
                        </x-splade-select>
                        <x-splade-select name="peserta">
                            <option value="" disabled selected>-- Peserta</option>
                            <option value="baru">Baru</option>
                            <option value="melanjutkan">Daftar Ulang</option>
                            <option value="">Semua</option>
                        </x-splade-select>
                        <x-splade-select name="level">
                            <option value="" disabled selected>-- Level</option>
                            @foreach ( $data_level as $level )
                                <option value="{{ $level->id }}">{{ $level->nama }}</option>
                            @endforeach
                            <option value="">Semua</option>
                        </x-splade-select>
                        <x-splade-select name="status">
                            <option value="" disabled selected>-- Status</option>
                            <option value="belum diberikan level">Belum Diberikan Level</option>
                            <option value="belum pilih jadwal">Belum Pilih Jadwal</option>
                            <option value="selesai pilih jadwal">Selesai Pilih Jadwal</option>
                            <option value="">Semua</option>
                        </x-splade-select>
                    </div>
                    <x-splade-submit :label="__('Cari')"/>
                </x-splade-form>
            </div>
            <div class="flow-root">
                <ul role="list" class="space-y-2">
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
                        @forelse ($data_peserta  as $index => $item)
                            {{-- <p class="text-3xl sm:p-1 font-black text-gray-200 absolute">{{ $index + 1 }}</p> --}}
                            <li class="sm:p-4 p-2 border rounded-md bg-white">
                                {{-- <div class="flex items-center justify-between border-b pb-2">
                                    <div class="flex-1 min-w-0 sm:ms-4">
                                        <p class="ml-3 sm:ml-0 text-sm font-bold text-gray-900 uppercase">
                                            Level : {{ $item->data_nilai['penempatan-level'] ?? $item->jadwal ? $item->jadwal->level->nama : '--' }}
                                        </p>
                                    </div>
                                    <span class="inline-block px-2 py-1 {{ $item->status_pendaftaran == 'belum diberikan level' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800'  }} rounded-full text-xs font-semibold">
                                        {{ $item->status_pendaftaran == 'belum diberikan level' ? 'Belum Diperiksa' : 'Selesai Diperiksa'  }}
                                    </span>
                                </div> --}}
                                <div class="flex items-center pt-2">
                                    <div class="flex-1 min-w-0 sm:ms-4">
                                        <Link href="{{ route('penguji.peserta-baru.show', ['unit' => $unit, 'periode' => $periode, 'peserta' => $item->id]) }}">
                                            <p class="text-md font-medium text-gray-900 uppercase">
                                                {{ $item->nis_peserta }} - {{ $item->peserta->nama }}
                                            </p>
                                            <p class="text-sm text-gray-500 uppercase">
                                                {{ $item->jadwal->nama_jadwal ?? '-Belum Pilih Jadwal-' }}
                                            </p>
                                        </Link>
                                    </div>
                                </div>
                                <div class="flex justify-between items-center pt-1">
                                    <p class="text-sm sm:text-base font-semibold sm:pt-4 pt-0 text-gray-700 uppercase">
                                        {{ $item->peserta->jenis_peserta }}
                                    </p>
                                    <div class="inline-flex items-center ">
                                        <Link href="{{ route('pengajar.peserta.show', ['unit' => $unit, 'periode' => $periode, 'peserta' => $item->id]) }}"
                                            class="text-white bg-primary-700 hover:bg-primary-900 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm sm:px-3 sm:py-2 py-1 px-2 text-center inline-flex items-center">
                                            Lihat <x-carbon-edit class="w-5 h-5 ml-2"/>
                                        </Link>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="p-4">
                                Belum Ada Data
                            </li>
                        @endforelse
                    </x-splade-lazy>
                </ul>
            </div>

            <div class="p-2 text-xs text-gray-500">
                {{ $data_peserta->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-layouts.main>
