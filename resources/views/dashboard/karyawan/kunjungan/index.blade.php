<x-layouts.main>
    <div class="p-4">
        <h2 class="text-2xl font-bold uppercase">
            Kunjungan
        </h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <x-layouts.card>
            <h4 class="text-xl font-bold px-4">Tambah Data Kunjungan</h4>
            <x-splade-form action="{{ route('karyawan.kunjungan.store') }}"
                preserve-scroll
            >
                @csrf
                <div class="relative p-4">
                    <div class="grid grid-cols-2 gap-2">
                        <x-splade-input name="tujuan" :label="__('Tujuan')" required/>
                        <x-splade-input name="lokasi" :label="__('Lokasi')" required/>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <x-splade-input name="waktu" :label="__('Waktu')" date time/>
                        <x-splade-input name="durasi" :label="__('Durasi')" required/>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <x-splade-textarea name="keterangan" :label="__('Keterangan')" autosize/>
                    </div>
                </div>
                <div class="p-4">
                    <x-splade-submit label="Tambah"/>
                </div>
            </x-splade-form>
        </x-layouts.card>
    </div>

    <x-layouts.card>
        <h4 class="text-xl font-bold px-4">Daftar Kunjungan</h4>
        <div class="p-4 relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                    <tr>
                        <th scope="col" class="px-2 py-3">Tujuan</th>
                        <th scope="col" class="px-2 py-3">Lokasi</th>
                        <th scope="col" class="px-2 py-3">Waktu</th>
                        <th scope="col" class="px-2 py-3">Durasi</th>
                        <th scope="col" class="px-2 py-3">Keterangan</th>
                        <th scope="col" class="px-2 py-3"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kunjungan as $item)
                        <tr class="bg-white border-b border-gray-200">
                            <th scope="row" class="px-2 py-4 font-medium text-gray-900 whitespace-nowrap uppercase">
                                {{ $item->tujuan }}
                            </th>
                            <td class="px-2 py-4">
                                {{ $item->lokasi }}
                            </td>
                            <td class="px-2 py-4">
                                {{ $item->waktu }}
                            </td>
                            <td class="px-2 py-4">
                                {{ $item->durasi }}
                            </td>
                            <td class="px-2 py-4">
                                {{ $item->keterangan }}
                            </td>
                            <td class="px-2 py-4">
                                <x-splade-form action="{{ route('karyawan.kunjungan.destroy', $item->id) }}" method="DELETE"
                                    confirm="Konfirmasi Hapus Data"
                                    confirm-text="Apakah yakin data kunjungan ini dihapus ?"
                                    confirm-button="Ya"
                                    cancel-button="Tidak"
                                    preserve-scroll
                                >
                                    @csrf
                                    <button type="submit" class="text-red-500 underline">Hapus</button>
                                </x-splade-form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $kunjungan->links() }}
        </div>
    </x-layouts.card>
</x-layouts.main>
