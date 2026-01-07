<x-layouts.main :unit="$unit">

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            Transaksi, Periode {{ $unit }}  Angkatan {{ $dataperiode->angkatan }}, Tahun {{ $dataperiode->tahun_ajaran }}
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        @include('dashboard.admin.periode.menu')
        <div class="w-full flex space-x-2 ml-2">
            <div class="px-3 lg:w-3/6 bg-white border border-gray-200 text-medium dark:text-gray-400 rounded-lg">
                <div class="p-4">
                    <div class=" rounded-lg space-y-4">
                        <h3 class="text-xl font-semibold text-gray-500">Transaksi Pembayaran {{ \Carbon\Carbon::parse($data_transaksi->created_at)->format('Ymd') }}-{{ $data_transaksi->id}}</h3>
                        <div class="uppercase space-y-2">
                            <div class="flex item-center justify-between">
                                <p class="text-sm font-medium text-gray-700">NIS</p>
                                <p class="text-md font-bold text-gray-800">{{ $data_transaksi->peserta->nis_peserta ?? '-' }}</p>
                            </div>
                            <div class="flex item-center justify-between">
                                <p class="text-sm font-medium text-gray-700">Nama</p>
                                <p class="text-md font-bold text-gray-800 underline">
                                    <Link href="{{ route('admin.peserta.show', ['unit' => $unit, 'periode' => $periode, 'peserta' => $data_transaksi->kelas->id]) }}">
                                        {{ $data_transaksi->kelas->peserta->nama }}
                                    </Link>
                                </p>
                            </div>
                            <div class="flex item-center justify-between">
                                <p class="text-sm font-medium text-gray-700">No Telepon</p>
                                <p class="text-md font-bold text-gray-800">{{ $data_transaksi->peserta->phone_number ?? '-' }}</p>
                            </div>
                            <div class="flex item-center justify-between">
                                <p class="text-sm font-medium text-gray-700">Kelas</p>
                                <p class="text-md font-bold text-gray-800">{{ $data_transaksi->kelas->jadwal ? $data_transaksi->kelas->jadwal->nama_jadwal : '-' }}</p>
                            </div>
                            <div class="flex item-center justify-between">
                                <p class="text-sm font-medium text-gray-700">Pendaftaran</p>
                                <p class="text-md font-bold text-gray-800">{{ $data_transaksi->kelas->status_daftar == 'melanjutkan' ? 'DAFTAR ULANG' : 'BARU' }}</p>
                            </div>
                        </div>
                        <div class="mt-5">
                            <ul class="mt-3 flex flex-col uppercase">
                                @foreach ( $data_pembayaran  as $item)
                                    <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                                        <div class="flex items-center justify-between w-full">
                                            <span>{{ $item->biaya->nama }}</span>
                                            <span>RP {{ number_format($item->biaya->nominal, 0, ',', '.') }}</span>
                                        </div>
                                    </li>
                                @endforeach
                                <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                                    <div class="flex items-center justify-between w-full">
                                        <span>Infaq</span>
                                        <span>Rp {{  number_format($data_transaksi->donasi, 0, ',', '.') }}</span>
                                    </div>
                                </li>
                                <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                                    <div class="flex items-center justify-between w-full">
                                        <span>Potongan</span>
                                        <span>Rp {{  number_format($data_transaksi->potongan, 0, ',', '.') }}</span>
                                    </div>
                                </li>
                                <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                                    <div class="flex items-center justify-between w-full">
                                        <span>Kode Unik</span>
                                        <span>Rp {{  number_format($data_transaksi->kode_unik, 0, ',', '.') }}</span>
                                    </div>
                                </li>
                                <li class="inline-flex items-center gap-x-2 py-3 px-4 text-lg font-semibold bg-gray-50 border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg">
                                    <div class="flex items-center justify-between w-full">
                                        <span>Total</span>
                                        <span>Rp {{  number_format($data_transaksi->nominal_total_pembayaran, 0, ',', '.') }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-5 flex-col items-center justify-center text-center">
                            <span class="w-full">Bukti Transfer</span>
                            <div class=" text-gray-400">
                                @if (isset($item->data_pembayaran['bukti_transfer']))
                                    <img src="{{ Storage::url($item->data_pembayaran['bukti_transfer']) }}" alt="bukti transfer" class="w-52" />
                                @else
                                    Data Bukti kosong
                                @endif
                            </div>
                        </div>
                        <div class="mt-5 flex justify-between">
                            <a href="{{ route('website.lttq.invoice', ['uuid' => $data_transaksi->uuid]) }}" target="_blank" class="flex items-center justify-between text-primary-700 border border-primary-700 rounded-md p-2">
                                Lihat Invoice <x-carbon-view class="w-4 h-4 ml-2 text-primary-700"/>
                            </a>
<<<<<<< HEAD
                            <x-splade-form action="{{ route('admin.transaksi.destroy', ['unit' => $unit, 'periode' => $periode, 'transaksi' => $data_transaksi->id]) }}"
=======
                            <x-splade-form action="{{ route('admin.transaksi.destroy', ['unit' => $unit, 'periode' => $periode, 'transaksi' => $item->id]) }}"
>>>>>>> 0eb3c6a (chore: save local changes before sync)
                                method="DELETE"
                                confirm="Konfirmasi Hapus Data"
                                confirm-text="Data dihapus ?"
                                confirm-button="Ya"
                                cancel-button="Tidak"
                                >
                                @csrf
<<<<<<< HEAD
                                <button type="submit" class="text-red-700 border border-red-700 rounded-md p-2">
=======
                                <button type="submit" class="text-red-700 border border-red-700 rounded-md px-2 py-1">
>>>>>>> 0eb3c6a (chore: save local changes before sync)
                                    <x-carbon-trash-can class="w-5 h-5 text-red-700"/>
                                </button>
                            </x-splade-form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-3 lg:w-3/6 bg-white border border-gray-200 text-medium text-gray-500 dark:text-gray-400 rounded-lg">
                <h3 class="p-4 text-center text-xl font-semibold text-gray-500">Perbaruhi Data Transaksi Pembayaran</h3>
                <x-splade-form
                    action="{{ route('admin.transaksi.update', ['unit' => $unit, 'periode' => $periode, 'transaksi' => $data_transaksi->id]) }}"
                    method="PUT" onkeydown="return event.key != 'Enter';"
                    :default="$biaya_pembayaran"
                >
                    @csrf

                    <div class="relative">
                        <x-forms.body >
                            <div>
                                <h5 class="text-md font-bold text-gray-800">Diskon / Potongan Pembayaran</h5>
                                <span class="text-xs text-gray-500">Nominal Rupiah Hanya Angka</span>
                                <div class="flex w-full">
                                    <span class="border rounded-md border-gray-300 my-2 p-2 inline-flex items-center text-sm text-gray-900">
                                        Rp
                                    </span>
                                    <x-splade-input class="flex-grow" name="potongan" type="number" required />
                                </div>
                            </div>
                            <hr class="my-4">
                            <div>
                                <h5 class="text-md font-bold text-gray-800">Donasi / Infaq</h5>
                                <span class="text-xs text-gray-500">Nominal Rupiah Hanya Angka</span>
                                <div class="flex w-full">
                                    <span class="border rounded-md border-gray-300 my-2 p-2 inline-flex items-center text-sm text-gray-900">
                                        Rp
                                    </span>
                                    <x-splade-input class="flex-grow" name="donasi" type="number" required />
                                </div>
                            </div>
                            <hr class="my-4">

                            <table class=" w-full text-sm text-left rtl:text-right text-gray-500 ">
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
                                                {{-- @if ($item_biaya->wajib_dibayar_awal == true)
                                                    <div class="flex items-center justify-center">
                                                        <div class="bg-primary-600 p-1 rounded-md">
                                                            <x-carbon-checkmark class="h-4 w-4 text-white" />
                                                        </div>
                                                    </div>
                                                @else --}}
                                                    <input type="checkbox" v-model="form.pembayaran{{ $item_biaya->id }}" name="pembayaran{{ $item_biaya->id }}"
                                                        class="w-6 h-6 rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                                    >

                                                {{-- @endif --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <x-splade-submit label="Update" class="mt-4" />
                        </x-forms.body>
                    </div>
                </x-splade-form>
            </div>
        </div>
    </div>
</x-layouts.main>

