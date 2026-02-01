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
            <div class="relative overflow-x-auto border border-gray-200 rounded-lg mb-4 bg-white shadow-sm">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-center w-[50px]">#</th>
                            <th scope="col" class="px-4 py-3 min-w-[200px]">Nama & Domisili</th>
                            <th scope="col" class="px-4 py-3 min-w-[150px]">Umur / JK</th>
                            <th scope="col" class="px-4 py-3 min-w-[180px]">Kontak & Instansi</th>
                            <th scope="col" class="px-4 py-3 min-w-[160px]">Pendidikan</th>
                            <th scope="col" class="px-4 py-3 min-w-[150px]">Divisi</th>
                            <th scope="col" class="px-4 py-3 text-center min-w-[120px]">Status</th>
                            <th scope="col" class="px-4 py-3 text-center min-w-[140px]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($pendaftars as $item)
                            <tr class="bg-white hover:bg-gray-50 {{ $item->status == 'ditolak' ? 'opacity-60' : '' }}">
                                <td class="px-4 py-4 text-center font-medium">
                                    {{ $loop->iteration + ($pendaftars->currentPage() - 1) * $pendaftars->perPage() }}
                                </td>
                                <td class="px-4 py-4">
                                    <div class="font-bold text-gray-900">{{ $item->nama }}</div>
                                    <div class="text-xs text-gray-500 mt-1 flex items-center">
                                        @svg('carbon-location', 'w-3 h-3 mr-1') 
                                        {{ Str::limit($item->alamat ?? 'N/A', 100) }}
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="text-gray-900 text-xs mb-1">{{ $item->umur ?? 'N/A' }} thn</div>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium border 
                                        {{ $item->gender == 'Ikhwan' ? 'bg-blue-50 text-blue-700 border-blue-200' : 'bg-red-50 text-red-700 border-red-200' }}">
                                        {{ $item->gender == 'Ikhwan' ? 'Ikhwan' : 'Akhwat' }}
                                    </span>
                                </td>
                                <!-- KOLOM BARU: Kontak & Instansi -->
                                <td class="px-4 py-4">
                                    <div class="text-xs text-gray-900 mb-1 font-medium">
                                        {{ Str::limit($item->telepon ?? 'N/A', 14) }}
                                    </div>
                                    <div class="text-xs text-gray-600">
                                        {{ Str::limit($item->instansi ?? 'N/A', 25) }}
                                    </div>
                                </td>
                                <!-- KOLOM PENDIDIKAN -->
                                <td class="px-4 py-4">
                                    <div class="text-xs text-gray-900 mb-1 font-medium">
                                        <span>Kelas/Semester:</span>
                                        {{ Str::limit($item->kelas_semester ?? 'N/A', 20) }}
                                    </div>
                                    <div class="text-xs text-gray-600">
                                        <span>Jurusan:</span>
                                        {{ Str::limit($item->jurusan ?? '-', 25) }}
                                    </div>
                                </td>

                                <!-- KOLOM DIVISI & KEAHLIAN -->
                                <td class="px-4 py-4">
                                    <div class="text-xs text-gray-900 mb-1 font-medium">
                                        {{ ucfirst($item->divisi ?? '-') }}
                                    </div>
                                    <div class="text-xs text-gray-600">
                                        <span>Keahlian:</span>
                                        {{ Str::limit($item->keahlian ?? '-', 25) }}
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    @php
                                        $statusConfig = [
                                            'menunggu verifikasi' => ['bg-yellow-50 text-yellow-700 border-yellow-200', 'bg-yellow-400', 'Menunggu Verifikasi'],
                                            'diterima' => ['bg-green-50 text-green-700 border-green-200', 'bg-green-500', 'Diterima'],
                                            'ditolak' => ['bg-red-50 text-red-700 border-red-200', 'bg-red-500', 'Tidak Diterima']
                                        ];
                                        $status = $statusConfig[$item->status] ?? ['bg-gray-50 text-gray-700 border-gray-200', 'bg-gray-400', 'Unknown'];
                                    @endphp
                                    <span class="inline-flex items-center {{ $status[0] }} text-xs font-medium px-2.5 py-1 rounded-full border">
                                        <span class="w-2 h-2 me-2 {{ $status[1] }} rounded-full"></span>
                                        {{ $status[2] }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-center">
                                    <div class="flex justify-center items-center gap-3">
                                        <button class="text-gray-500 hover:text-blue-600 transition-colors" title="Detail">
                                            @svg('carbon-view', 'w-5 h-5')
                                        </button>
                                        @if($item->status != 'diterima')
                                            <button class="text-green-600 hover:text-green-800 transition-colors" title="Terima">
                                                @svg('carbon-checkmark-filled', 'w-5 h-5')
                                            </button>
                                            <button class="text-red-600 hover:text-red-800 transition-colors" title="Tolak">
                                                @svg('carbon-close-filled', 'w-5 h-5')
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-12 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z"/>
                                    </svg>
                                    <p class="text-lg font-medium text-gray-900">Belum ada pendaftaran</p>
                                    <p class="text-sm text-gray-500">Silakan tunggu pendaftaran anggota baru</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <!-- PAGINATION -->
                @if($pendaftars->hasPages())
                <div class="px-4 py-3 border-t border-gray-200 bg-white">
                    {{ $pendaftars->appends(request()->query())->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
            

</x-layouts.main>