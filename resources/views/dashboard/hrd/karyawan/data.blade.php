<x-layouts.main>
    <div class="p-4">
        <h2 class="text-2xl font-bold uppercase">
            Data Karyawan
        </h2>
    </div>
    <x-layouts.card>
        <div class="items-center justify-end flex">
            <Link modal max-width="lg" href="{{ route('hrd.karyawan.data.create') }}" class="text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                Tambah Data
                @svg('carbon-add-filled', 'ml-2 text-white h-4 w-4')
            </Link>
        </div>
        <x-splade-table :for="$karyawans">
        </x-splade-table>
    </x-layouts.card>
</x-layouts.main>
