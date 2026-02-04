<div class="min-h-screen bg-gray-100">

    <div class="text-center py-4 bg-gray-100">
        <p class="text-md space-x-10">
            <Link href="{{ url('/') }}" class=" text-gray-600 hover:text-gray-900">
                &larr; Kembali
            </Link>

            @auth
                <Link href="{{ url('/') }}/dashboard" class="p-2 border rounded-md border-gray-600 text-800 hover:text-primary-900">
                    Ke Dashboard &#x02192;
                </Link>
            @endauth
        </p>
    </div>

    <div class=" flex justify-center items-center p-4 bg-gray-100">
        <div class="w-full sm:max-w-lg px-6 py-4 bg-white shadow-md rounded-lg">
            <div class="space-y-2 flex items-center justify-center gap-6 md:space-y-0">
                <a href="#" class="shrink-0 m-4">
                    <img class="w-48" src="{{ asset('assets/logo/logo-ramadhan-1447h.png') }}" alt="Logo Lomba Ramadhan">
                </a>
            </div>
            <h1 class="text-2xl font-bold text-center">Pendaftaran Lomba</h1>
            <p class="text-center font-normal text-md pb-2">Semarak Ramadhan 1447 H</p>
            <div class="border border-gray-800 rounded-md p-4 my-4">
                <p class="text-center font-bold text-md pb-2 uppercase">Pendaftaran Lomba telah ditutup</p>
            </div>
        </div>
    </div>

    <div class="text-center py-8 bg-gray-100">
        <div class="flex items-center justify-center">
            <img src="{{ url('/') }}/assets/pembayaran/SSL-Secured.svg" alt="ssl" class="h-16 pt-3">
            <img class="h-12 mt-5 rounded-md" src="https://ipaymu.com/wp-content/themes/ipaymu_v2/assets/new-assets/image/iPaymu-PCIDSS.jpeg" alt="ipaymu">
        </div>
        <p class="text-sm pt-4 text-gray-600">
            &copy; {{ date('Y') }} arrahmahbalikpapan.or.id
        </p>
    </div>
</div>

