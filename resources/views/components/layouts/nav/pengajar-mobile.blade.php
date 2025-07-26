<div class="min-[640px]:hidden">
    <div class="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t border-gray-200">
        <div class="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
            <Link href="{{ route('pengajar.index', ['unit' => $unit]) }}" type="button" class="inline-flex flex-col items-center justify-center mb-2 border-gray-200 border-r">
                <x-carbon-dashboard class="w-6 h-6 my-2 {{ request()->url() === route('pengajar.index', ['unit' => $unit]) ? 'text-primary-700' : 'text-gray-700' }}" />
                <span class="text-sm text-gray-600">
                    Dashboard
                </span>
            </Link>
            <Link href="{{ route('pengajar.absensi.index', ['unit' => $unit]) }}" type="button" class="inline-flex flex-col items-center justify-center mb-2 border-r border-gray-200">
                <x-carbon-chart-custom class="w-6 h-6 my-2 {{ request()->url() === route('pengajar.absensi.index', ['unit' => $unit]) ? 'text-primary-700' : 'text-gray-700' }}" />
                <span class="text-sm text-gray-600">
                    Absensi
                </span>
            </Link>
            <Link href="{{ route('pengajar.jadwal.index', ['unit' => $unit]) }}" type="button" class="inline-flex flex-col items-center justify-center mb-2 border-r border-gray-200">
                <x-carbon-table-alias class="w-6 h-6 my-2 {{ request()->url() === route('pengajar.jadwal.index', ['unit' => $unit]) ? 'text-primary-700' : 'text-gray-700' }}" />
                <span class="text-sm text-gray-600">
                    Jadwal
                </span>
            </Link>
            <Link href="{{ route('pengajar.akun.index', ['unit' => $unit]) }}" type="button" class="inline-flex flex-col items-center justify-center mb-2 border-gray-200">
                <x-carbon-user-avatar class="w-6 h-6 my-2 {{ request()->url() === route('pengajar.akun.index', ['unit' => $unit]) ? 'text-primary-700' : 'text-gray-700' }}" />
                <span class="text-sm text-gray-600">
                    Akun
                </span>
            </Link>
        </div>
    </div>
</div>
