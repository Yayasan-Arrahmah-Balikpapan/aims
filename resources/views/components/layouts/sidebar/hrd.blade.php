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
        <x-link-item :href="route('hrd.index')" :active="request()->routeIs('hrd.index')">
            @svg('carbon-dashboard', 'text-gray-600 h-6 w-6')
            <span class="ml-3" sidebar-toggle-item="">
                Dashboard
            </span>
        </x-link-item>
    </li>
    <li>
        <Link href="divisi" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group hover:border hover:border-gray-500 border border-transparent">
            @svg('carbon-send-alt', 'text-gray-600 h-6 w-6')
            <span class="ml-3" sidebar-toggle-item="">
                Informasi
            </span>
        </Link>
    </li>
    <li>
        <x-link-item :href="route('hrd.agenda.index')" :active="request()->routeIs('hrd.agenda.index')">
            @svg('carbon-calendar', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Agenda</span>
        </x-link-item>
    </li>
    <li>
        <x-link-item :href="route('hrd.karyawan.data.index')" :active="request()->routeIs('hrd.karyawan.data.index')">
            @svg('carbon-user-multiple', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Data Karyawan</span>
        </x-link-item>
    </li>
    <li>
        <x-link-item-a :href="route('hrd.karyawan.absensi.index')" :active="request()->routeIs('hrd.karyawan.absensi.index')">
            @svg('carbon-event-schedule', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Data Absensi</span>
        </x-link-item-a>
    </li>
    <li>
        <x-link-item :href="route('hrd.karyawan.kunjungan.index')" :active="request()->routeIs('hrd.karyawan.kunjungan.index')">
            @svg('carbon-taxi', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Data Kunjungan</span>
        </x-link-item>
    </li>
    <li>
        <x-link-item :href="route('hrd.karyawan.cuti.index')" :active="request()->routeIs('hrd.karyawan.cuti.index')">
            @svg('carbon-result-old', 'text-gray-600 h-6 w-6')
            <span class="ml-3" sidebar-toggle-item="">
                Cuti Karyawan
            </span>
        </x-link-item>
    </li>
    {{-- <li>
        <Link href="divisi" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group hover:border hover:border-gray-500 border border-transparent">
            @svg('carbon-user-identification', 'text-gray-600 h-6 w-6')
            <span class="ml-3" sidebar-toggle-item="">
                Data Pengajar
            </span>
        </Link>
    </li>
    <li>
        <Link href="divisi" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group hover:border hover:border-gray-500 border border-transparent">
            @svg('carbon-education', 'text-gray-600 h-6 w-6')
            <span class="ml-3" sidebar-toggle-item="">
                Data Santri
            </span>
        </Link>
    </li> --}}
</ul>
