@include('website.partials.header')
@yield('content')
<div class="fixed bottom-4 right-4 p-0 z-50">
    <Link href="{{ route('website.ramadhan') }}" class="inline-flex flex-col items-center bg-[#fff3e0] rounded-lg p-1">
        <img src="{{ asset('assets/logo/logo-ramadhan-1447h.png') }}" class="h-16 sm:h-24" alt="icon-ramadhan">
    </Link>
</div>
@include('website.partials.footer')
