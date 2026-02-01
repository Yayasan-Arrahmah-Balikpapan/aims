@include('website.partials.header')
@yield('content')
<div class="fixed bottom-4 right-4 p-0 z-50">
    <a href="{{ route('website.ramadhan') }}" class="group inline-flex flex-col items-center bg-transparent rounded-lg p-1 transition-all duration-300 hover:scale-110">
        <img src="{{ asset('assets/logo/logo-ramadhan-1447h.png') }}" class="h-16 sm:h-24 drop-shadow-lg group-hover:drop-shadow-2xl transition-all duration-300" alt="icon-ramadhan" style="animation: ramadhanFloat 3s ease-in-out infinite;">
    </a>
</div>

<style>
@keyframes ramadhanFloat {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-8px);
    }
}
</style>
@include('website.partials.footer')
