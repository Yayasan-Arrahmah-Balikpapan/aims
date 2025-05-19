<div class="min-h-screen bg-gray-100">
    <div class="
        {{-- max-[640px]:hidden --}}
    ">
        @include('layouts.navigation')
    </div>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    <x-layouts.footer />
    @include('layouts.navigation-mobile')
</div>
