<x-app-layout>
    <div class="pt-10 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="col-span-2 mb-4">
                <div class="p-4 mb-4 bg-white border border-gray-200 rouded-lg  2xl:col-span-2 ">
                    <h3 class="text-lg font-semibold text-center">Peserta {{ $data_peserta->periode->unit->nama }}</h3>
                    <h3 class="mb-4 text-lg font-semibold text-center">{{ $data_peserta->periode->nama }}</h3>
                    <ul class="grid grid-cols-6 gap-2  dark:divide-gray-700">
                        <li class="col-span-3 py-2">
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-normal text-gray-500 truncate ">
                                        Akun
                                    </p>
                                    <p class="text-base font-semibold text-gray-900 truncate uppercase">
                                        {{ auth()->user()->phone_number }}
                                    </p>
                                </div>
                            </div>
                        </li>
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
                                    <p class="text-base font-semibold text-gray-900 truncate uppercase">
                                        {{ $data_peserta->peserta->jenis_peserta }}
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="col-span-3 py-2">
                            <div class="flex items-center space-x-4">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-normal text-gray-500 truncate ">
                                        Jadwal
                                    </p>
                                    <p class="text-base font-semibold text-gray-900 truncate uppercase">
                                        {{ $data_peserta->jadwal->nama_jadwal }}
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-span-2 mb-4">
                <div class="p-4 mb-4 bg-white border border-gray-200 rouded-lg  2xl:col-span-2 ">
                    <h3 class="mb-4 text-lg font-semibold text-center">Pilih Pembayaran</h3>
                    {{-- <div class="my-8 grow sm:mt-8 lg:mt-0 space-y-4 bg-stone-100 p-4 rounded-lg">
                        @php
                            $total = 0;
                        @endphp
                        @foreach ([
                            ['name' => 'pendaftaran', 'label' => 'PENDAFTARAN', 'value' => 100000, 'disabled' => false, 'checked' => true, 'required' => true],
                            ['name' => 'spp1', 'label' => 'SPP BULAN I', 'value' => 120000, 'disabled' => false, 'checked' => true, 'required' => true],
                            ['name' => 'spp2', 'label' => 'SPP BULAN II', 'value' => 120000, 'disabled' => false, 'checked' => false, 'required' => false],
                            ['name' => 'spp3', 'label' => 'SPP BULAN III', 'value' => 120000, 'disabled' => false, 'checked' => false, 'required' => false],
                            ['name' => 'spp4', 'label' => 'SPP BULAN IV', 'value' => 120000, 'disabled' => false, 'checked' => false, 'required' => false],
                        ] as $data)
                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                                        <input type="checkbox" data="checkbox" class="w-5 h-5 {{ $data['disabled'] ? 'text-blue-300' : 'text-blue-600' }}  bg-gray-100 border-gray-300 rounded focus:ring-blue-500 " name="pembayaran_{{ $data['name'] }}"
                                            v-model="form.pembayaran{{ $data['name'] }}"
                                            value="{{ $data['name'] }}"
                                            id="{{ strtolower($data['name']) }}"
                                            {{ $data['checked'] ? 'checked' : '' }}
                                            {{ $data['disabled'] ? 'disabled' : '' }}
                                            {{ $data['required'] ? 'required' : '' }}
                                            />
                                        <label for="{{ strtolower($data['name']) }}" class="ms-2 text-sm font-medium text-gray-900 ">{{ $data['label'] }} {!! $data['required'] ? '<span aria-hidden="true" class="text-red-600" title="This field is required">*</span>' : '' !!}</label>
                                    </dt>
                                    <dd class="text-base font-semibold text-gray-900 flex justify-between">
                                        <div class="mr-2">
                                            Rp
                                        </div>
                                        <div>
                                            {{ number_format($data['value']) }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        @endforeach
                    </div> --}}
                    <x-splade-form action="{{ route('dashboard.peserta.pembayaran.form.store', ['uuid' => $data_peserta->uuid]) }}"
                        confirm-text="Apakah pilihan sudah benar ?"
                        confirm="Konfirmasi"
                        confirm-button="Benar"
                        cancel-button="Belum"
                        method="POST"
                        >
                        @csrf
                        <div class="relative overflow-x-auto border rounded-md mb-4">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th scope="col"
                                            class="px-3 py-3 font-bold text-gray-600 whitespace-nowrap bg-gray-50 ">
                                            Jenis Pembayaran
                                        </th>
                                        <th scope="col"
                                            class="px-3 py-3 font-bold text-gray-600 whitespace-nowrap bg-gray-50 text-center">
                                            Pilihan
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_biaya as $item_biaya)
                                        <tr class="border-b text-sm border-gray-200 0">
                                            <td class="px-3 py-3 font-semibold uppercase text-gray-900">
                                                {{ $item_biaya->nama }}
                                                <div class="font-base text-gray-600">
                                                    Rp. {{ number_format($item_biaya->nominal, 0, ',', '.') }}
                                                </div>
                                            </td>
                                            <td class="px-3 py-3 font-semibold uppercase text-gray-900 text-center">
                                                @php
                                                    $item_status_pembayaran = $data_pembayaran_peserta->where('biaya_id', $item_biaya->id)->first();
                                                @endphp
                                                @if(isset($item_status_pembayaran))
                                                    {{ $item_status_pembayaran->transaksi->statusKeterangan($item_status_pembayaran->transaksi->status) }}
                                                @else
                                                    <input type="checkbox" v-model="form.pembayaran{{ $item_biaya->id }}" name="pembayaran{{ $item_biaya->id }}" class="w-6 h-6 rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- <tr class="border-b text-sm border-gray-200 0">
                                        <td class="px-3 py-3 font-semibold uppercase text-gray-900">
                                            Kode Unik
                                            <div class="font-base text-gray-600">
                                                123
                                            </div>
                                        </td>
                                        <td class="px-3 py-3 font-semibold uppercase text-gray-900 text-center">

                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 border p-4 rounded-md">
                            <label for="donasi" class="block text-sm font-medium text-gray-700">Yuk salurkan infaq terbaikmu :)</label>
                            <div class="grid grid-cols-2 gap-2 mt-2">
                                <div class="space-y-1.5">
                                    <label class="flex items-center">
                                        <input type="radio" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded" name="pembayaran_donasi" v-model="form.pembayarandonasi" value="0" checked>
                                        <span class="ml-2 block text-sm text-gray-700">0</span>
                                    </label>
                                    <hr>
                                    @foreach ([
                                        5000 => 'Rp 5.000',
                                        10000 => 'Rp 10.000',
                                        25000 => 'Rp 25.000',
                                        50000 => 'Rp 50.000',
                                    ] as $value => $label)
                                        <label class="flex items-center">
                                            <input type="radio" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded" name="pembayaran_donasi" v-model="form.pembayarandonasi" value="{{ $value }}">
                                            <span class="ml-2 block text-sm text-gray-700">{{ $label }}</span>
                                        </label>
                                        <hr>
                                    @endforeach
                                </div>
                                <div class="space-y-1.5">
                                    @foreach ([
                                        100000 => 'Rp 100.000',
                                        200000 => 'Rp 200.000',
                                        500000 => 'Rp 500.000',
                                        1000000 => 'Rp 1.000.000',
                                    ] as $value => $label)
                                        <label class="flex items-center">
                                            <input type="radio" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded" name="pembayaran_donasi" v-model="form.pembayarandonasi" value="{{ $value }}">
                                            <span class="ml-2 block text-sm text-gray-700">{{ $label }}</span>
                                        </label>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                            <label class="flex items-center pt-2">
                                <input type="radio" class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded" name="pembayaran_donasi" v-model="form.pembayarandonasi" value="custom">
                                <input type="number" class="ml-2 block w-full border-gray-300 rounded" name="pembayaran_custom_donasi" v-model="form.pembayarandonasicustom" placeholder="Atau Masukkan nominal" min="0" step="1000" disabled>
                            </label>
                            <x-splade-script>
                                document.querySelectorAll('input[name="pembayaran_donasi"]').forEach(radio => {
                                    radio.addEventListener('change', function() {
                                        const customInput = document.querySelector('input[name="pembayaran_custom_donasi"]');
                                        if (this.value === 'custom') {
                                            customInput.disabled = false;
                                            customInput.focus();
                                        } else {
                                            customInput.disabled = true;
                                        }
                                    });
                                });
                            </x-splade-script>
                        </div>

                        <div class="flex items-center justify-center mt-6">
                            <button type="submit" class="bg-primary-700 text-medium text-white py-2.5 px-5 rounded-lg flex items-center justify-between">
                                Lanjutkan Pembayaran <x-carbon-chevron-right class="h-8 w-8 pl-2" />
                            </button>
                        </div>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
