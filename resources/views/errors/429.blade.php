<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/js/app.js'])
        @spladeHead
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center p-4 bg-gray-100">
            <div>
                <Link href="/">
                    <x-application-logo class="w-32 h-32 fill-current text-gray-500" />
                </Link>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 text-center py-4 bg-white shadow-md overflow-hidden rounded-lg">
                <h2 class="mb-4 text-4xl font-medium text-gray-900 md:text-5xl lg:text-6xl">
                    Error 429
                </h2>
                <p class="mb-6 text-lg font-normal text-gray-500">
                    Kami Batasi Proses / Terlalu Banyak Percobaan.
                </p>
                <p class="mb-6 text-lg font-normal text-gray-500">
                    Mohon Coba Lagi 2 Menit Lagi.
                </p>
                <div>
                    <a href="{{ route('akses') }}" class="font-semibold text-sm">Kembali</a>
                </div>
            </div>
        </div>
    </body>
</html>
