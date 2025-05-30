<x-layouts.main :unit="$unit ?? null">
    <x-layouts.card>
        <h4 class="text-2xl font-bold border-b border-gray-200 mb-4 leading-loose">Manajemen Level {{ $unit }}</h4>
        <div class="items-center justify-end flex">
            <Link modal max-width="lg" href="{{ route('admin.pengajar.create', ['unit' => $unit]) }}" class="text-white bg-sky-500 hover:bg-sky-600 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-4 py-2 mb-2 flex items-center focus:outline-none">
                Tambah Data
                @svg('carbon-add-filled', 'ml-2 text-white h-4 w-4')
            </Link>
        </div>
        {{-- <x-splade-table :for="$pengajar">
        </x-splade-table> --}}
    </x-layouts.card>
</x-layouts.main>
