<div class="md:hidden">
    <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200">
        <div class="grid h-full grid-cols-4 mx-auto divide-x font-extrabold">
            <x-layouts.nav.link-mobile-nav :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <x-carbon-dashboard class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Dashboard
                </span>
            </x-layouts.nav.link-mobile-nav>
            <x-layouts.nav.link-mobile-nav :href="route('dashboard.peserta.data')" :active="request()->routeIs('dashboard.peserta.data')">
                <x-carbon-user-multiple class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Peserta
                </span>
            </x-layouts.nav.link-mobile-nav>
            <x-layouts.nav.link-mobile-nav :href="route('dashboard.peserta.riwayatpembayaran')" :active="request()->routeIs('dashboard.peserta.riwayatpembayaran')">
                <x-carbon-list-dropdown class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Aktivitas
                </span>
            </x-layouts.nav.link-mobile-nav>
            <x-layouts.nav.link-mobile-nav :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                <x-carbon-user-avatar class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Akun
                </span>
            </x-layouts.nav.link-mobile-nav>
            {{-- <x-layouts.nav.link-mobile-nav :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                <x-carbon-calendar class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Agenda
                </span>
            </x-layouts.nav.link-mobile-nav> --}}
        </div>
    </div>
</div>
