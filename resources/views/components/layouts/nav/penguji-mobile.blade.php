<div class="md:hidden">
    <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200">
        <div class="grid h-full grid-cols-4 mx-auto divide-x font-medium">
            <x-layouts.nav.link-mobile-nav :href="route('penguji.dashboard.index', ['unit' => $unit])" :active="request()->routeIs('penguji.dashboard.index', ['unit' => $unit])">
                <x-carbon-dashboard class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Dashboard
                </span>
            </x-layouts.nav.link-mobile-nav>
            <x-layouts.nav.link-mobile-nav :href="route('penguji.periksa.index', ['unit' => $unit])" :active="request()->routeIs('penguji.periksa.index', ['unit' => $unit])">
                <x-carbon-white-paper class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Periksa
                </span>
            </x-layouts.nav.link-mobile-nav>
            <x-layouts.nav.link-mobile-nav :href="route('penguji.peserta-baru.index', ['unit' => $unit])" :active="request()->routeIs('penguji.peserta-baru.index', ['unit' => $unit])">
                <x-carbon-chart-custom class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Daftar Baru
                </span>
            </x-layouts.nav.link-mobile-nav>
            <x-layouts.nav.link-mobile-nav :href="route('penguji.peserta.index', ['unit' => $unit])" :active="request()->routeIs('penguji.peserta.index', ['unit' => $unit])">
                <x-carbon-user-multiple class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Peserta
                </span>
            </x-layouts.nav.link-mobile-nav>
        </div>
    </div>
</div>

