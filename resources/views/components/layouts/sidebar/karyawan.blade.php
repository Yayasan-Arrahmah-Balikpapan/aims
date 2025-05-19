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
        <Link href="/dashboard/karyawan" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group hover:border hover:border-gray-500 border border-transparent">
            @svg('carbon-dashboard', 'text-gray-600 h-6 w-6')
            <span class="ml-3" sidebar-toggle-item="">
                Dashboard
            </span>
        </Link>
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
        <x-link-item :href="route('karyawan.absensi.index')" :active="request()->routeIs('karyawan.absensi.index')">
            @svg('carbon-fingerprint-recognition', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Absensi</span>
        </x-link-item>
    </li>
    <li>
        <x-link-item :href="route('karyawan.cuti.index')" :active="request()->routeIs('karyawan.cuti.index')">
            @svg('carbon-flight-schedule', 'text-gray-600 h-6 w-6')
            <span class="ml-3">Cuti</span>
        </x-link-item>
    </li>

</ul>
