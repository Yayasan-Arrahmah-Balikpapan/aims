<x-layouts.main>
    <div class="p-4">
        <h2 class="text-2xl font-bold uppercase">
            Data Kunjungan Karyawan
        </h2>
    </div>
    <x-layouts.card>
        <x-splade-table :for="$kunjungans">
            <x-splade-cell actions as="$data">
                    <div class="flex items-center gap-1">
                        <x-splade-form action="{{ route('hrd.karyawan.kunjungan.destroy', $data->id) }}" method="DELETE"
                            confirm="Konfirmasi Hapus Data"
                            confirm-text="Apakah yakin data kunjungan ini dihapus ?"
                            confirm-button="Ya"
                            cancel-button="Tidak"
                            preserve-scroll
                        >
                            @csrf
                            <button type="submit" class="text-red-500 underline">Hapus</button>
                        </x-splade-form>
                    </div>
                </x-splade-cell>
        </x-splade-table>
    </x-layouts.card>
</x-layouts.main>
