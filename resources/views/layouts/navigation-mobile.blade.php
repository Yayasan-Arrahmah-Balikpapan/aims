<div class="min-[640px]:hidden">
    <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200">
        <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
            <Link href="/dashboard" type="button" class="inline-flex flex-col items-center justify-center mb-2 border-gray-200 border-r">
                <x-carbon-dashboard class="w-8 h-8 my-1 {{ request()->url() === route('dashboard') ? 'text-primary-700' : 'text-gray-700' }}" />
                <span class="text-sm text-gray-600">
                    Dashboard
                </span>
            </Link>
            <Link href="/dashboard/data" type="button" class="inline-flex flex-col items-center justify-center mb-2 border-r border-gray-200">
                <x-carbon-user-multiple class="w-8 h-8 my-1 {{ request()->url() === route('dashboard.peserta.data') ? 'text-primary-700' : 'text-gray-700' }}" />
                <span class="text-sm text-gray-600">
                    Peserta
                </span>
            </Link>
            <Link href="/dashboard/riwayat-pembayaran" type="button" class="inline-flex flex-col items-center justify-center mb-2 border-r border-gray-200">
                <x-carbon-money class="w-8 h-8 my-1 {{ request()->url() === route('dashboard.peserta.riwayatpembayaran') ? 'text-primary-700' : 'text-gray-700' }}" />
                <span class="text-sm text-gray-600">
                    Pembayaran
                </span>
            </Link>
            <Link href="/profile" type="button" class="inline-flex flex-col items-center justify-center mb-2 border-gray-200">
                <x-carbon-user-avatar class="w-8 h-8 my-1 {{ request()->url() === route('profile.edit') ? 'text-primary-700' : 'text-gray-700' }}" />
                <span class="text-sm text-gray-600">
                    Akun
                </span>
            </Link>
        </div>
    </div>
</div>
