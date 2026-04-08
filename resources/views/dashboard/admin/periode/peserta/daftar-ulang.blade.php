<x-layouts.main :unit="$unit">

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            Periode {{ $unit }}  Angkatan {{ $dataperiode->angkatan }}, Tahun {{ $dataperiode->tahun_ajaran }}
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        @include('dashboard.admin.periode.menu')
        <div class="px-3 w-full">
            <div class="items-center justify-end flex gap-2">
                <h1 class="text-2xl font-bold uppercase">
                    Daftar Ulang Peserta
                </h1>
            </div>
            <div class="flex">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                    <div class="bg-white rounded-lg p-4">
                        <div class="text-center">
                            <h1 class="text-lg uppercase font-bold">Pilih Peserta</h1>
                            <h1 class="text-lg uppercase">Form Daftar Ulang Tahsin</h1>
                            <h1 class="text-md uppercase font-bold">{{ $data_periode->nama }}</h1>
                        </div>
                    </div>
                    <div class="flow-root pt-4">
                        <ul role="list" class="space-y-2">
                            @foreach ($data_peserta as $item)
                                <li class="p-4 border rounded-md bg-white">
                                    <div class="flex items-center">
                                        <div class="flex-1 min-w-0 ms-4">
                                            <p class="text-md text-gray-600 uppercase">
                                                {{ $item->nis_peserta }}
                                            </p>
                                            <p class="text-md font-medium text-gray-900 uppercase">
                                                {{ $item->peserta->nama }}
                                            </p>
                                            <p class="text-sm text-gray-500 uppercase">
                                                Hasil Ujian :

                                                @if ($item->status_ujian == 'selesai ujian')
                                                    <span class="font-semibold">
                                                        {{ $data_level[$item->data_nilai['ujian']] ?? '-' }}
                                                    </span>
                                                @else
                                                    <span class="font-semibold">-</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                            @if ($item->status_ujian == 'selesai ujian')
                                                <Link href="{{ route('dashboard.peserta.lttq.tahsin.daftar-ulang.form', ['peserta' => $item->uuid ]) }}"
                                                    class="text-sm flex font-semibold border rounded-lg py-2.5 px-5 border-primary-700 text-primary-700 hover:text-white bg-white  hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
                                                    Pilih
                                                </Link>
                                            @else

                                            @endif

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
        </div>
    </div>
</x-layouts.main>
