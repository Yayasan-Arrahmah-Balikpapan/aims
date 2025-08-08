@props(['unit'])

<div class="sticky top-0 z-50">
    <x-layouts.nav />
</div>
<div class="flex overflow-hidden bg-gray-50">
    <x-layouts.sidebar :unit="$unit ?? null" />

    <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-[200px]">
        <main>
            {{-- <x-layouts.breadcrumbs /> --}}
            {{ $slot }}
        </main>

        <x-layouts.footer />
    </div>
</div>
@if (Request::is('dashboard/karyawan*'))
    @include('components.layouts.nav.karyawan-mobile')
@elseif (Request::is('dashboard/pengajar*'))
    @include('components.layouts.nav.pengajar-mobile')
@endif
