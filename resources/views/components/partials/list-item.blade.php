<div class="relative overflow-hidden bg-white rounded-lg border">
    <div class="flex items-center justify-between p-4">
        <div class="text-center sm:text-left">
            <h5 class="font-semibold uppercase">{{ str_replace('-', ' ', $title)}}</h5>
        </div>
        <Link href="{{ $link }}" aria-busy=""class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300">
            <x-carbon-identification class="w-6 h-6 mr-2" />
            Dashboard
        </Link>
    </div>
</div>
