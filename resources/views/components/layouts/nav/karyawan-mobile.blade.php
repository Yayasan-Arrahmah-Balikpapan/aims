<div class="md:hidden">
    <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200">
        <div class="grid h-full grid-cols-4 mx-auto divide-x font-medium">
            <x-layouts.nav.link-mobile-nav :href="route('karyawan.index')" :active="request()->routeIs('karyawan.index')">
                <x-carbon-dashboard class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Dashboard
                </span>
            </x-layouts.nav.link-mobile-nav>
            <x-layouts.nav.link-mobile-nav :href="route('karyawan.absensi.index')" :active="request()->routeIs('karyawan.absensi.index')">
                <x-carbon-fingerprint-recognition class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Absensi
                </span>
            </x-layouts.nav.link-mobile-nav>
            <x-layouts.nav.link-mobile-nav :href="route('karyawan.notifikasi.index')" :active="request()->routeIs('karyawan.notifikasi.index')">
                <x-carbon-notification-new class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Notifikasi
                </span>
            </x-layouts.nav.link-mobile-nav>
            <x-layouts.nav.link-mobile-nav :href="route('karyawan.akun.index')" :active="request()->routeIs('karyawan.akun.index')">
                <x-carbon-user-avatar class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Akun
                </span>
            </x-layouts.nav.link-mobile-nav>
        </div>
    </div>
</div>
