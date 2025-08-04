<div class="min-h-screen flex flex-col justify-center p-4 items-center bg-gray-100">
    <div>
        @isset($logo)
            {{ $logo }}
        @else
            <Link href="/">
                <img src="{{ asset('assets/img/logo-arrahmah.png') }}" class="h-16" alt="Atthala Logo">
            </Link>
        @endisset
    </div>

    <div class="w-full sm:max-w-md my-4 p-2 sm:p-4 bg-white shadow-md rounded-lg">
        {{ $slot }}
    </div>

    <PwaInstallButton />

    <footer>
        <p class="py-8 text-sm text-center text-gray-500">
            arrahmahbalikpapan.or.id
            <Link
                confirm="#"
                confirm-text="rimbaborne"
                cancel-button="Oke"
                confirm-button="?"
                href="#"
                class="hover:underline">
                © 2013-{{ date('Y') }}
            </Link>
        </p>
    </footer>
</div>

