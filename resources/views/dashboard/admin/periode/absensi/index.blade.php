<x-layouts.main :unit="$unit">

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            Periode {{ $unit }}  Angkatan {{ $dataperiode->angkatan }}, Tahun {{ $dataperiode->tahun_ajaran }}
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        @include('dashboard.admin.periode.menu')
        <div class="px-3 w-full">
            <div class="items-center justify-end flex">
                <Link modal max-width="lg" href="{{ route('admin.jadwal.create', ['unit' => $unit, 'periode' => $periode]) }}" class="text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                    Tambah Data
                    @svg('carbon-add-filled', 'ml-2 text-white h-4 w-4')
                </Link>
            </div>
            <x-splade-form method="GET" class="sm:flex items-center sm:space-x-2 border border-gray-300 rounded-lg p-2 mb-2"
            :default="[
                    'cari' => request()->query('cari') ?? '',
                    'jenis_peserta' => request()->query('jenis_peserta') ?? '',
                    'level' => request()->query('level') ?? '',
                    'hari' => request()->query('hari') ?? '',
                    'pengajar' => request()->query('pengajar') ?? '',
                ],
            ">
            <x-splade-input value="{{ request()->query('cari') }}" name="cari" placeholder="Nama Jadwal" class="flex-grow"/>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-1">
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
            </div>
            <x-splade-submit :label="__('Cari')"/>
        </x-splade-form>
            <div class="relative overflow-x-auto border rounded-md mb-4 bg-white">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead>
                        <tr class="border-b border-gray-200 ">
                            <th scope="col" class="px-3 py-3 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                Jadwal
                            </th>
                            @for ($i = 1; $i <= 16; $i++)
                                <th scope="col"
                                    class="px-3 py-3 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                    {{ $i }}
                                </th>
                            @endfor
                            <th scope="col" class="px-3 py-3 text-center font-bold text-gray-900 whitespace-nowrap bg-gray-50">
                                Jumlah
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_jadwal as $item)
                            <tr class="text-gray-700 border-b border-gray-200 py-4">
                                <td class="p-2 uppercase font-semibold">
                                    {{ $item->nama_jadwal }}
                                </td>
                                @for($i = 1; $i <= 16; $i++)
                                    <td class="text-center py-4 px-2 uppercase">
                                        @if(isset($data_absen[$item->id.'-'.$i]))
                                            {{ \Carbon\Carbon::parse($data_absen[$item->id.'-'.$i])->format('d-m-Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endfor
                                <td class="text-center py-4 px-2 uppercase">
                                    -
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-2 text-gray-500">
                {{ $data_jadwal->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-layouts.main>
