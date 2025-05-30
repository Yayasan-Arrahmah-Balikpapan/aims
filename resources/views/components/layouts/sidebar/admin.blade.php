@props(['unit'])

<ul class="pb-2 space-y-2">
    <li>
        <Link href="/dashboard"
            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group hover:border hover:border-gray-500 border border-transparent">
        @svg('carbon-arrow-left', 'text-gray-600 h-6 w-6')
        <span class="ml-3">Kembali</span>
        </Link>
    </li>
    <li class="pt-4 border-gray-200 border-t space-y-2"></li>
    <li>
        <x-link-item :href="route('admin.index', ['unit' => $unit])" :active="request()->routeIs('admin.index', ['unit' => $unit])">
            @svg('carbon-dashboard', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Dashboard</span>
        </x-link-item>
    </li>
    {{-- <li>
        <Link href="divisi"
            class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group hover:border hover:border-gray-500 border border-transparent">
        @svg('carbon-send-alt', 'text-gray-600 h-6 w-6')
        <span class="ml-3">Pemberitahuan</span>
        </Link>
    </li> --}}
    <li>
        <x-link-item :href="route('admin.periode.index', ['unit' => $unit])" :active="request()->is('dashboard/admin/tahsin/periode*')">
            @svg('carbon-data-unstructured', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Data</span>
        </x-link-item>
        {{-- <ul>
            <li class="pl-8">
                <x-link-item >
                    <span class="ml-3"> - Jadwal</span>
                </x-link-item>
            </li>
            <li class="pl-8">
                <x-link-item >
                    <span class="ml-3"> - Jadwal</span>
                </x-link-item>
            </li>
            <li class="pl-8">
                <x-link-item >
                    <span class="ml-3"> - Jadwal</span>
                </x-link-item>
            </li>
            <li class="pl-8">
                <x-link-item >
                    <span class="ml-3"> - Jadwal</span>
                </x-link-item>
            </li>
        </ul> --}}
    </li>
    <li>
        <x-link-item :href="route('admin.pengajar.index', ['unit' => $unit])" :active="request()->routeIs('admin.pengajar.index', ['unit' => $unit])">
            @svg('carbon-user-identification', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Pengajar</span>
        </x-link-item>
    </li>
    <li>
        <x-link-item :href="route('admin.level.index', ['unit' => $unit])" :active="request()->routeIs('admin.level.index', ['unit' => $unit])">
            @svg('carbon-distribute-horizontal-center', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Level</span>
        </x-link-item>
    </li>
    {{-- <li>
        <x-link-item :href="route('admin.pengajar.index', ['unit' => $unit])" :active="request()->routeIs('admin.pengajar.index', ['unit' => $unit])">
            @svg('carbon-table-alias', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Kaldik</span>
        </x-link-item>
    </li> --}}
    {{--<li>
        <x-link-item :href="route('admin.peserta.index', ['unit' => $unit])" :active="request()->routeIs('admin.peserta.index', ['unit' => $unit])">
            @svg('carbon-user-multiple', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Peserta</span>
        </x-link-item>
    </li> --}}
    {{-- <li>
        <x-link-item :href="route('admin.peserta.index', ['unit' => $unit])" :active="request()->routeIs('admin.peserta.index', ['unit' => $unit])">
            @svg('carbon-chart-custom', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Absensi</span>
        </x-link-item>
    </li> --}}
    {{-- <li>
        <x-link-item :href="route('admin.pembayaran.index', ['unit' => $unit])" :active="request()->routeIs('admin.pembayaran.index', ['unit' => $unit])">
            @svg('carbon-list-dropdown', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Pembayaran</span>
        </x-link-item>
    </li> --}}
    <li>
        <x-link-item :href="route('admin.pengaturan.index', ['unit' => $unit])" :active="request()->routeIs('admin.pengaturan.index', ['unit' => $unit])">
            @svg('carbon-settings-services', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Pengaturan</span>
        </x-link-item>
    </li>
    <li>
        <x-link-item :href="route('admin.user.index', ['unit' => $unit])" :active="request()->routeIs('admin.user.index', ['unit' => $unit])">
            @svg('carbon-user-profile-alt', 'text-gray-600 h-6 w-6')
            <span class="ml-3">User Akun</span>
        </x-link-item>
    </li>
</ul>
