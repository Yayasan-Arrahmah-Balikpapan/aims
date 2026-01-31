<x-layouts.main>

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            List Pendaftaran Anggota Irma
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        <div class="px-3 w-full">
            <div class="items-center justify-end flex space-x-2">
                <a href="{{ route('admin-ramadhan.peserta-lomba.export')}}" class="text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                    Export
                    @svg('carbon-download', 'ml-2 text-white h-4 w-4')
                </a>
                {{-- <Link modal max-width="lg" href="{{ route('admin.jadwal.create', ['unit' => $unit, 'periode' => $periode]) }}" class="text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                    Tambah Data
                    @svg('carbon-add-filled', 'ml-2 text-white h-4 w-4')
                </Link> --}}
            </div>
            <div class="container mx-auto">
                <x-splade-form method="GET" class="sm:flex items-center sm:space-x-2 border border-gray-300 rounded-lg p-2 mb-2"
                    :default="[
                            'cari' => request()->query('cari') ?? '',
                            'jenis_kelamin' => request()->query('jenis_kelamin') ?? '',
                            'divisi' => request()->query('divisi') ?? '',
                            'status' => request()->query('status') ?? '',
                        ]"
                    >
                    
                    {{-- Pencarian Umum (Nama, Sekolah, No HP) --}}
                    <x-splade-input value="{{ request()->query('cari') }}" name="cari" placeholder="Cari nama, sekolah..." class="flex-grow"/>

                    {{-- Filter Jenis Kelamin --}}
                    <x-splade-select name="jenis_kelamin">
                        <option value="" disabled selected>-- Jenis Kelamin --</option>
                        <option value="L">Ikhwan</option>
                        <option value="P">Akhwat</option>
                        <option value="">Semua</option>
                    </x-splade-select>

                    {{-- Filter Divisi (Sesuai Pilihan di Form Pendaftaran) --}}
                    <x-splade-select name="divisi">
                        <option value="" disabled selected>-- Divisi --</option>
                        <option value="dakwah">Dakwah</option>
                        <option value="media">Media</option>
                        <option value="sosial">Sosial</option>
                        <option value="">Semua</option>
                    </x-splade-select>

                    {{-- Filter Status Penerimaan --}}
                    <x-splade-select name="status">
                        <option value="" disabled selected>-- Status --</option>
                        <option value="pending">Baru Mendaftar</option>
                        <option value="diterima">Diterima</option>
                        <option value="ditolak">Tidak Diterima</option>
                        <option value="">Semua</option>
                    </x-splade-select>

                    <x-splade-submit :label="__('Filter')" class="bg-blue-600 hover:bg-blue-700 text-white"/>
                    
                    {{-- Tombol Reset (Optional tapi berguna) --}}
                    <a href="{{ url()->current() }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Reset
                    </a>
                </x-splade-form>
            </div>
        <div class="relative overflow-x-auto border border-gray-200 rounded-lg mb-4 bg-white shadow-sm">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-4 py-3 text-center w-[50px]">#</th>
                        <th scope="col" class="px-4 py-3 min-w-[200px]">Nama & Domisili</th>
                        <th scope="col" class="px-4 py-3 min-w-[150px]">TTL / JK</th>
                        <th scope="col" class="px-4 py-3 min-w-[150px]">Divisi</th>
                        <th scope="col" class="px-4 py-3 text-center min-w-[120px]">Status</th>
                        <th scope="col" class="px-4 py-3 text-center min-w-[140px]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    {{-- DATA 1: IKHWAN - MENUNGGU --}}
                    <tr class="bg-white hover:bg-gray-50">
                        <td class="px-4 py-4 text-center font-medium">1</td>
                        <td class="px-4 py-4">
                            <div class="font-bold text-gray-900">Ahmad Fulan</div>
                            <div class="text-xs text-gray-500 mt-1 flex items-center">
                                @svg('carbon-location', 'w-3 h-3 mr-1') Balikpapan Baru
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="text-gray-900 text-xs mb-1">12-05-2005</div>
                            {{-- Badge Info (Blue) --}}
                            <span class="inline-flex items-center bg-blue-50 text-blue-700 text-xs font-medium px-2 py-0.5 rounded border border-blue-200">
                                Ikhwan
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            {{-- Badge Default/Gray --}}
                            <span class="inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded border border-gray-300">
                                Dakwah
                            </span>
                        </td>
                        
                        <td class="px-4 py-4 text-center">
                            {{-- Badge Warning (Yellow) --}}
                            <span class="inline-flex items-center bg-yellow-50 text-yellow-700 text-xs font-medium px-2.5 py-1 rounded-full border border-yellow-200">
                                <span class="w-2 h-2 me-2 bg-yellow-400 rounded-full"></span>
                                Menunggu
                            </span>
                        </td>

                        <td class="px-4 py-4 text-center">
                            <div class="flex justify-center items-center gap-3">
                                <button class="text-gray-500 hover:text-blue-600 transition-colors" title="Detail">
                                    @svg('carbon-view', 'w-5 h-5')
                                </button>
                                <button class="text-green-600 hover:text-green-800 transition-colors" title="Terima">
                                    @svg('carbon-checkmark-filled', 'w-5 h-5')
                                </button>
                                <button class="text-red-600 hover:text-red-800 transition-colors" title="Tolak">
                                    @svg('carbon-close-filled', 'w-5 h-5')
                                </button>
                            </div>
                        </td>
                    </tr>

                    {{-- DATA 2: AKHWAT - DITERIMA --}}
                    <tr class="bg-white hover:bg-gray-50">
                        <td class="px-4 py-4 text-center font-medium">2</td>
                        <td class="px-4 py-4">
                            <div class="font-bold text-gray-900">Siti Fulana</div>
                            <div class="text-xs text-gray-500 mt-1 flex items-center">
                                @svg('carbon-location', 'w-3 h-3 mr-1') Kampung Baru
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="text-gray-900 text-xs mb-1">20-10-2004</div>
                            {{-- Badge Pink/Red (Danger/Custom) --}}
                            <span class="inline-flex items-center bg-red-50 text-red-700 text-xs font-medium px-2 py-0.5 rounded border border-pink-200">
                                Akhwat
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <span class="inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded border border-gray-300">
                                Media
                            </span>
                        </td>
                        
                        <td class="px-4 py-4 text-center">
                            {{-- Badge Success (Green) --}}
                            <span class="inline-flex items-center bg-green-50 text-green-700 text-xs font-medium px-2.5 py-1 rounded-full border border-green-200">
                                <span class="w-2 h-2 me-2 bg-green-500 rounded-full"></span>
                                Diterima
                            </span>
                        </td>

                        <td class="px-4 py-4 text-center">
                            <div class="flex justify-center items-center gap-3">
                                <button class="text-gray-500 hover:text-blue-600 transition-colors" title="Detail">
                                    @svg('carbon-view', 'w-5 h-5')
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    {{-- DATA 3: DITOLAK --}}
                    <tr class="bg-white hover:bg-gray-50 opacity-60">
                        <td class="px-4 py-4 text-center font-medium">3</td>
                        <td class="px-4 py-4">
                            <div class="font-bold text-gray-900">Budi Santoso</div>
                            <div class="text-xs text-gray-500 mt-1 flex items-center">
                                @svg('carbon-location', 'w-3 h-3 mr-1') Manggar
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <div class="text-gray-900 text-xs mb-1">01-01-2005</div>
                            <span class="inline-flex items-center bg-blue-50 text-blue-700 text-xs font-medium px-2 py-0.5 rounded border border-blue-200">
                                Ikhwan
                            </span>
                        </td>
                        <td class="px-4 py-4">
                            <span class="inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2 py-0.5 rounded border border-gray-300">
                                Sosial
                            </span>
                        </td>
                        
                        <td class="px-4 py-4 text-center">
                            {{-- Badge Danger (Red) --}}
                            <span class="inline-flex items-center bg-red-50 text-red-700 text-xs font-medium px-2.5 py-1 rounded-full border border-red-200">
                                <span class="w-2 h-2 me-2 bg-red-500 rounded-full   "></span>
                                Ditolak
                            </span>
                        </td>

                        <td class="px-4 py-4 text-center">
                            <div class="flex justify-center items-center gap-3">
                                <button class="text-gray-500 hover:text-blue-600 transition-colors" title="Detail">
                                    @svg('carbon-view', 'w-5 h-5')
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        </div>
    </div>
            

</x-layouts.main>