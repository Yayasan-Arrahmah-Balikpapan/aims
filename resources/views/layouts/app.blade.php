<div class="min-h-screen bg-gray-100">
    <header class="
        {{-- max-[640px]:hidden --}}
        sticky top-0 z-50
    ">
        @include('layouts.navigation')
    </header>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    <x-layouts.footer />
    @unless(request()->is('dashboard'))
        @include('layouts.navigation-mobile')
    @endunless
</div>
