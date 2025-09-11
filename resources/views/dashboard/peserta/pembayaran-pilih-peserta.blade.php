<x-app-layout>
    <div class="pt-10 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white rounded-lg p-4">
                <div class="text-center">
                    <h1 class="text-lg uppercase font-bold">Pilih Peserta</h1>
                    <h1 class="text-lg uppercase">Form Pembayaran</h1>
                </div>
            </div>
            <div class="flow-root pt-4">
                <ul role="list" class="space-y-2">
                    @foreach ($data_peserta as $item)
                        <li class="p-4 border rounded-md bg-white">
                            <div class="flex items-center">
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-md font-medium text-gray-900 uppercase">
                                        {{ $item->nis_peserta }} - {{ $item->peserta->nama }}
                                    </p>
                                    <p class="text-sm text-gray-500 uppercase">
                                        {{ $item->periode->unit->nama }} {{ $item->periode->nama }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                    <Link href="{{ route('dashboard.peserta.pembayaran.form', ['uuid' => $item->uuid ]) }}"
                                        class="text-sm flex font-semibold border rounded-lg py-2.5 px-5 border-primary-700 text-primary-700 hover:text-white bg-white  hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
                                        Pilih
                                    </Link>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flow-root py-4">
                {{ $data_peserta->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
