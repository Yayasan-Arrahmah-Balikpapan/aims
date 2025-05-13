<div class="min-[640px]:hidden">
    <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200">
        <div class="grid h-full max-w-lg grid-cols-3 mx-auto font-medium">
            <Link href="/dashboard" type="button" class="inline-flex flex-col items-center justify-center mb-2 border-gray-200 border-r">
                <x-carbon-send-alt class="w-8 h-8 my-1 {{ request()->url() === route('dashboard') ? 'text-primary-700' : 'text-gray-700' }}" />
                <span class="text-sm text-gray-600">
                    Informasi
                </span>
            </Link>
            <Link href="/dashboard/karyawan/absensi" type="button" class="inline-flex flex-col items-center justify-center mb-2 border-r border-gray-200">
                <x-carbon-fingerprint-recognition class="w-8 h-8 my-1 {{ request()->url() === route('karyawan.absensi.index') ? 'text-primary-700' : 'text-gray-700' }}" />
                <span class="text-sm text-gray-600">
                    Absensi
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
