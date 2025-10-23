<div>
    <div class="w-[170px] h-fit text-sm font-medium text-gray-900 bg-white space-y-1 border border-gray-200 rounded-lg p-2">
    {{-- <div class=" bg-white border border-gray-200 text-medium text-gray-500 rounded-lg w-full"> --}}

    {{-- <ul class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 md:me-4 mb-4 md:mb-0"> --}}
{{-- <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200"> --}}
    {{-- <li class="px-4"> --}}
        <x-periode-link-item :href="route('admin.periode.statistik', ['unit' => $unit, 'periode' => $periode])" :active="request()->routeIs('admin.periode.statistik', ['unit' => $unit, 'periode' => $periode])">
            Statistik
            <x-carbon-chevron-right class="h-4 w-4" />
        </x-periode-link-item>
    {{-- </li> --}}
    {{-- <li class="px-4"> --}}
        <x-periode-link-item :href="route('admin.jadwal.index', ['unit' => $unit, 'periode' => $periode])" :active="request()->routeIs('admin.jadwal.index', ['unit' => $unit, 'periode' => $periode])">
            Jadwal
            <x-carbon-chevron-right class="h-4 w-4" />
        </x-periode-link-item>
    {{-- </li> --}}
    {{-- <li class="px-4"> --}}
        <x-periode-link-item :href="route('admin.peserta.index', ['unit' => $unit, 'periode' => $periode])" :active="request()->routeIs('admin.peserta.index', ['unit' => $unit, 'periode' => $periode])">
            Peserta
            <x-carbon-chevron-right class="h-4 w-4" />
        </x-periode-link-item>
    {{-- </li> --}}
    {{-- <li class="px-4"> --}}
        <x-periode-link-item :href="route('admin.absensi.index', ['unit' => $unit, 'periode' => $periode])" :active="request()->routeIs('admin.absensi.index', ['unit' => $unit, 'periode' => $periode])">
            Absensi
            <x-carbon-chevron-right class="h-4 w-4" />
        </x-periode-link-item>
    {{-- </li> --}}
    {{-- <li class="px-4"> --}}
        <x-periode-link-item :href="route('admin.kehadiran.index', ['unit' => $unit, 'periode' => $periode])" :active="request()->routeIs('admin.kehadiran.index', ['unit' => $unit, 'periode' => $periode])">
            Kehadiran
            <x-carbon-chevron-right class="h-4 w-4" />
        </x-periode-link-item>
    {{-- </li> --}}
    {{-- <li class="px-4"> --}}
        <x-periode-link-item :href="route('admin.transaksi.index', ['unit' => $unit, 'periode' => $periode])" :active="request()->routeIs('admin.transaksi.index', ['unit' => $unit, 'periode' => $periode])">
            Transaksi
            <x-carbon-chevron-right class="h-4 w-4" />
        </x-periode-link-item>
    {{-- </li> --}}
    {{-- <li class="px-4"> --}}
        <x-periode-link-item :href="route('admin.pembayaran.index', ['unit' => $unit, 'periode' => $periode])" :active="request()->routeIs('admin.pembayaran.index', ['unit' => $unit, 'periode' => $periode])">
            Pembayaran
            <x-carbon-chevron-right class="h-4 w-4" />
        </x-periode-link-item>
    {{-- </li> --}}
{{-- </ul> --}}

    </div>
    <div class="w-[170px] h-fit text-sm font-medium text-gray-900 bg-white space-y-2 border border-gray-200 rounded-lg p-3 mt-2">
        <Link href="{{ route('admin.periode.index', ['unit' => $unit ]) }}"
            class="flex items-center text-gray-500 rounded-lg hover:bg-gray-100 border border-transparent">
            @svg('carbon-arrow-left', 'text-gray-500 h-5 w-5')
            <span class="ml-3">Kembali</span>
        </Link>
    </div>
</div>
