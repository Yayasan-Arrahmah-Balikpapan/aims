<ul class="pb-2 space-y-2">
    <li>
        <Link href="/dashboard" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group hover:border hover:border-gray-500 border border-transparent">
            @svg('carbon-arrow-left', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Kembali</span>
        </Link>
    </li>
    <li class="pt-4 border-gray-200 border-t space-y-2"></li>
    <li>
        <x-link-item :href="route('pengajar.index', ['unit' => $unit])" :active="request()->routeIs('pengajar.index', ['unit' => $unit])">
            @svg('carbon-dashboard', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Dashboard</span>
        </x-link-item>
    </li>
    <li>
        <x-link-item :href="route('pengajar.absensi.index', ['unit' => $unit])" :active="request()->routeIs('pengajar.absensi.index', ['unit' => $unit])">
            @svg('carbon-chart-custom', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Absensi</span>
        </x-link-item>
    </li>
    <li>
        <x-link-item :href="route('pengajar.jadwal.index', ['unit' => $unit])" :active="request()->routeIs('pengajar.jadwal.index', ['unit' => $unit])">
            @svg('carbon-table-alias', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Jadwal</span>
        </x-link-item>
    </li>
    {{-- <li>
        <x-link-item :href="route('pengajar.peserta.index', ['unit' => $unit])" :active="request()->routeIs('pengajar.peserta.index', ['unit' => $unit])">
            @svg('carbon-user-multiple', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Peserta</span>
        </x-link-item>
    </li> --}}
    <li>
        <x-link-item :href="route('pengajar.pengaturan.index', ['unit' => $unit])" :active="request()->routeIs('superadmin.roles.index')">
            @svg('carbon-settings-services', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Pengaturan</span>
        </x-link-item>
    </li>
</ul>
