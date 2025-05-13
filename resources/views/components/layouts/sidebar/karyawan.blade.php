<ul class="pb-2 space-y-2">
    <li>
        <Link href="/dashboard" class="flex items-center p-2 text-base text-gray-900 rounded-lg hover:bg-gray-100 group hover:border hover:border-gray-500 border border-transparent">
            @svg('carbon-dashboard', 'text-gray-600 h-6 w-6')
            <span class="ml-3" sidebar-toggle-item="">
                Dashboard
            </span>
        </Link>
    </li>
    <li class="pt-4 space-y-2"></li>
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
</ul>
