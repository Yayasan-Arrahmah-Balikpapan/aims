@props(['unit'])

<ul class="pb-2 space-y-2">
    <li>
        <Link href="/dashboard" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group hover:border hover:border-gray-500 border border-transparent">
            @svg('carbon-arrow-left', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Kembali</span>
        </Link>
    </li>
    <li class="pt-4 border-gray-200 border-t space-y-2"></li>
    <li>
        <Link href="/dashboard/penguji/{{ $unit }}" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group hover:border hover:border-gray-500 border border-transparent">
            @svg('carbon-dashboard', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Dashboard</span>
        </Link>
    </li>
    <li>
        <x-link-item :href="route('penguji.peserta-baru.index', ['unit' => $unit])" :active="request()->routeIs('penguji.peserta-baru.index', ['unit' => $unit])">
            @svg('carbon-user-certification', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Peserta Baru</span>
        </x-link-item>
    </li>
    {{-- <li>
        <x-link-item :href="route('penguji.peserta.index', ['unit' => $unit])" :active="request()->routeIs('penguji.peserta.index', ['unit' => $unit])">
            @svg('carbon-user-multiple', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Peserta</span>
        </x-link-item>
    </li>
    <li>
        <x-link-item :href="route('penguji.peserta.index', ['unit' => $unit])" :active="request()->routeIs('penguji.peserta.index', ['unit' => $unit])">
            @svg('carbon-settings-services', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Pengaturan</span>
        </x-link-item>
    </li> --}}
</ul>
