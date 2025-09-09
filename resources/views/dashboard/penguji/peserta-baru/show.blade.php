<x-layouts.main :unit="$unit ?? null">
    <x-layouts.card>
        <x-layouts.title>Data Peserta Baru</x-layouts.title>
        <div class="mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 md:gap-4 dark:bg-gray-900">
                <div class="col-span-full sm:col-auto">
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg  2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <div class="items-center flex space-x-4">
                            <x-carbon-user-avatar-filled-alt class="w-20 h-20 text-primary-700"/>
                            <Link away href="https://wa.me/{{ $data_peserta->peserta->phone_number }}">
                                <h3 class="mb-1 text-xl font-bold text-gray-900 ">Peserta</h3>
                                <div class="mb-1 text-sm text-gray-500 uppercase">
                                    {{ $data_peserta->peserta->nama }}
                                </div>
                                <div class="mb-4 text-sm text-gray-500 ">
                                    {{ $data_peserta->peserta->phone_number }}
                                </div>
                            </Link>
                        </div>
                    </div>
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg  2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <div class="items-center flex space-x-4">
                            <div>
                                <h3 class="mb-1 text-xl font-bold text-gray-900 ">Penempatan Level</h3>
                                @php
                                    $levelhasilpenguji = null;
                                    $penempatan_level = $data_peserta->data_nilai['penempatan-level'] ?? null;
                                @endphp
                                @if ($penempatan_level)
                                    <div class="text-lg font-bold border rounded-md text-gray-800 border-gray-800 px-4 py-1 text-center">
                                        {{ $penempatan_level }}
                                    </div>
                                @else
                                    <div class="text-lg font-bold border rounded-md text-stone-500 border-stone-500 px-4 py-1 text-center">
                                        BELUM DINILAI
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg  2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <h3 class="mb-4 text-xl font-semibold ">Biodata</h3>
                        <ul class="grid grid-cols-6 gap-2  dark:divide-gray-700">
                            <li class="col-span-3 py-2">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-normal text-gray-500 truncate ">
                                            Nama
                                        </p>
                                        <p class="text-base font-semibold text-gray-900 truncate uppercase">
                                            {{ $data_peserta->peserta->nama }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="col-span-3 py-2">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-normal text-gray-500 truncate ">
                                            Tanggal Lahir
                                        </p>
                                        <p class="text-base font-semibold text-gray-900 truncate ">
                                            {{ $data_peserta->peserta->tanggal_lahir }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="col-span-3 py-2">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-normal text-gray-500 truncate ">
                                            Jenis Peserta
                                        </p>
                                        <p class="text-base font-semibold text-gray-900 truncate uppercase ">
                                            {{ $data_peserta->peserta->jenis_peserta }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="col-span-3 py-2">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-normal text-gray-500 truncate ">
                                            Kota
                                        </p>
                                        <p class="text-base font-semibold text-gray-900 truncate ">
                                            {{ $data_peserta->peserta->biodata['kota_domisili'] }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="col-span-3 py-2">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-normal text-gray-500 truncate ">
                                            Pekerjaan
                                        </p>
                                        <p class="text-base font-semibold text-gray-900 truncate ">
                                            {{ $data_peserta->peserta->biodata['pekerjaan'] }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="col-span-3 py-2">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-normal text-gray-500 truncate ">
                                            Alamat
                                        </p>
                                        <p class="text-base font-semibold text-gray-900 truncate ">
                                            {{ $data_peserta->peserta->biodata['alamat'] }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-auto">
            <div class="grid grid-cols-1 dark:bg-gray-900">
                <div class="col-auto">
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg  2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <div class="items-center flex space-x-4">
                            <ul class="sm:flex gap-4">
                                <li class="py-2">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0 gap-4">
                                            <p class="text-lg font-normal text-gray-500 truncate ">
                                                KTP
                                            </p>
                                            <p class="text-base font-semibold text-gray-900 truncate ">
                                                <a href="{{ asset('storage/') }}/{{  $data_peserta->peserta->biodata['ktp'] }}" target="_blank">
                                                    <img src="{{ asset('storage/') }}/{{  $data_peserta->peserta->biodata['ktp'] }}" alt="" width="150px">
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-2">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-lg font-normal text-gray-500 truncate ">
                                                Rekaman
                                            </p>
                                            <p class="text-base font-semibold text-gray-900 truncate ">
                                                <audio class="" controls>
                                                    <source src="{{ asset('storage/') }}/{{ $data_peserta->data_nilai['rekaman-daftar-baru'] ?? $data_peserta->peserta->biodata['rekaman'] }}" type="audio/{{ explode('.', $data_peserta->peserta->biodata['rekaman'])[1] ?? '' }}">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg  2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                        <div class="items-center flex space-x-4">
                            <x-splade-form action="{{ route('penguji.peserta-baru.update', ['unit' => $unit, 'periode' => $data_periode->id , 'peserta' => $data_peserta->id]) }}"
                                method="PUT"
                                :default="[
                                    'level' => $penempatan_level
                                ]"
                                >
                                @csrf
                                @method('PUT')
                                <label for="" class="pb-4">Penilaian Level</label>

                                <div class="flex space-x-4 mt-4">
                                    <x-splade-select name="level">
                                        <option value="">Pilih Hasil Penilaian..</option>
                                        @foreach ($datalevel as $level)
                                            <option value="{{ $level->nama }}">{{ $level->nama }}</option>
                                        @endforeach
                                    </x-splade-select>
                                    <button type="submit" class="text-white bg-primary-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                                        Simpan
                                    </button>
                                </div>
                            </x-splade-form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.card>
    <div class="p-4 mb-4">
        <div class="items-center">
            <Link href="{{ route('penguji.peserta-baru.data', ['unit' => $unit, 'periode' => $data_periode->id]) }}"
                class="border border-gray-400 bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center">
                <x-carbon-arrow-left class="w-5 h-5 mr-2"/>
                Kembali Ke Data
            </Link>
        </div>
    </div>

</x-layouts.main>

