<div class="md:hidden">
    <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200">
        <div class="grid h-full grid-cols-4 mx-auto divide-x font-medium">
            <x-layouts.nav.link-mobile-nav :href="route('pengajar.index', ['unit' => $unit])" :active="request()->routeIs('pengajar.index', ['unit' => $unit])">
                <x-carbon-dashboard class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Dashboard
                </span>
            </x-layouts.nav.link-mobile-nav>
            <x-layouts.nav.link-mobile-nav :href="route('pengajar.absensi.index', ['unit' => $unit])" :active="request()->routeIs('pengajar.absensi.index', ['unit' => $unit])">
                <x-carbon-chart-custom class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Absensi
                </span>
            </x-layouts.nav.link-mobile-nav>
            <x-layouts.nav.link-mobile-nav :href="route('pengajar.jadwal.index', ['unit' => $unit])" :active="request()->routeIs('pengajar.jadwal.index', ['unit' => $unit])">
                <x-carbon-table-alias class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Jadwal
                </span>
            </x-layouts.nav.link-mobile-nav>
            <x-layouts.nav.link-mobile-nav :href="route('pengajar.peserta.index', ['unit' => $unit])" :active="request()->routeIs('pengajar.peserta.index', ['unit' => $unit])">
                <x-carbon-user-multiple class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Peserta
                </span>
            </x-layouts.nav.link-mobile-nav>
            {{-- <x-layouts.nav.link-mobile-nav :href="route('pengajar.akun.index', ['unit' => $unit])" :active="request()->routeIs('pengajar.akun.index', ['unit' => $unit])">
                <x-carbon-user-avatar class="w-6 h-6 my-1" />
                <span class="text-xs">
                    Akun
                </span>
            </x-layouts.nav.link-mobile-nav> --}}
        </div>
    </div>
</div>

