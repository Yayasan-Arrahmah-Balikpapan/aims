<x-app-layout>

    <div class=" flex justify-center items-center p-4 bg-gray-100">
        <div class="w-full sm:max-w-lg px-6 py-4 bg-white shadow-md rounded-lg">
            <div class="space-y-2 flex items-center justify-center gap-6 md:space-y-0">
                <a href="#" class="shrink-0 m-4">
                    <img class="w-32" src="{{ url('/') }}/assets/img/lttq/tahsin.png">
                </a>
            </div>
            <h1 class="text-2xl font-bold text-center">Daftar Ulang Tahsin</h1>
            <hr class="my-4">
            <div class="p-4">
                <p class="text-center font-semibold text-md pb-2">Daftar Ulang Gagal.</p>
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
</x-app-layout>
