
{{-- <x-splade-script>
    document.addEventListener("DOMContentLoaded", function() {
        setInterval(function() {
            location.reload();
        }, 120000); // 120000 milliseconds = 2 minutes
    });
</x-splade-script>
 --}}


<div class="bg-gray-100">
    <div class="text-center py-8 bg-gray-100">
        <p class="text-sm text-gray-600">
            <Link href="{{ url('/dashboard') }}" class="text-md text-gray-600 hover:text-gray-900">
            &larr; Kembali
            </Link>
        </p>
    </div>

    <!-- Invoice -->
    <div class="max-w-7xl px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10">
        <div class="sm:w-11/12 lg:w-3/4 mx-auto">
            <!-- Card -->
            <div class="flex flex-col p-4 sm:p-10 bg-white shadow-md rounded-xl dark:bg-neutral-800">
                <!-- Grid -->
                <div class="flex justify-between">
                    <div>
                        <img src="{{ url('/') }}/assets/img/logo-arrahmah.png" alt="yayasan arrahmah" class="h-12">

                        <h1 class="mt-2 text-lg md:text-xl font-semibold text-gray-800 dark:text-white">
                            Yayasan Ar Rahmah Balikpapan
                        </h1>
                        <h4 class="text-sm md:text-xl font-medium text-gray-500 dark:text-white">
                            Lembaga Tahsin Tahfizhil Quran
                        </h4>
                    </div>
                    <!-- Col -->

                    <div class="text-end">
                        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-neutral-200">Invoice #
                        </h2>
                        <span class="mt-1 block text-gray-500 dark:text-neutral-500 uppercase">
                            {{ \Carbon\Carbon::parse($data->created_at)->format('Ymd') }}-{{ $data->id}}
                        </span>

                        {{-- <address class="mt-4 not-italic text-gray-800 dark:text-neutral-200">
                            45 Roker Terrace<br>
                            Latheronwheel<br>
                            KW5 8NW, London<br>
                            United Kingdom<br>
                        </address> --}}
                    </div>
                    <!-- Col -->
                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="mt-8 grid sm:grid-cols-2 gap-3">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">Kepada:</h3>
                        <h3 class="text-sm font-medium text-gray-800 dark:text-neutral-200 uppercase">PESERTA TAHSIN {{ $data->peserta->jenis_peserta }}</h3>
                        <address class="mb-2 not-italic text-gray-500 dark:text-neutral-500">
                            {{ $data->peserta->nama }} <br>
                            {{ $data->peserta->phone_number }}<br>
                        </address>
                    </div>
                    <!-- Col -->

                    <div class="sm:text-end space-y-2">
                        <!-- Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Tanggal Invoice:
                                </dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ date('d/m/Y H:i') }}</dd>
                            </dl>
                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Status Pembayaran:</dt>
                                <dd class="col-span-2 text-gray-500 font-semibold dark:text-neutral-500 sm:flex sm:justify-center sm:text-center">
                                    @if ($data->status == 1)
                                        <span class="bg-yellow-300 text-gray-900 px-2 py-1 rounded text-sm flex">Menunggu Pembayaran</span>
                                    @elseif ($data->status == 2)
                                        <span class="bg-blue-500 text-white px-2 py-1 rounded text-sm flex">Menunggu Konfirmasi</span>
                                    @elseif ($data->status == 3)
                                        <span class="bg-green-500 text-white px-2 py-1 rounded text-sm flex">LUNAS</span>
                                    @elseif ($data->status == 4)
                                        <span class="bg-red-500 text-white px-2 py-1 rounded text-sm flex">Kadaluarsa</span>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <!-- End Grid -->
                    </div>
                    <!-- Col -->
                </div>
                <!-- End Grid -->
                <div class="flex items-center justify-center mt-6">
                    <div class="w-full md:w-2/5">
                        <div class="flex flex-col border justify-center bg-white rounded-xl items-center mb-4">
                            <div class="rounded-lg bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
                                <div class="space-y-2 flex items-center justify-between gap-6 md:space-y-0">
                                    <a href="#" class="shrink-0 m-4">
                                        <img class="w-32" src="{{ url('/') }}/assets/img/lttq/tahsin.png">
                                    </a>
                                </div>
                                <p class="text-center font-semibold text-lg pt-2">TAHSIN</p>
                                <p class="text-center font-semibold text-lg pb-2">Angkatan {{ $data->periode->angkatan }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="mt-0">
                    <div class=" rounded-lg space-y-4 dark:border-neutral-700">
                        <div class="rounded-lg bg-white p-2 md:p-4">

                        </div>
                        <div class="mt-5">
                            <ul class="mt-3 flex flex-col">
                                @php
                                    $list_pembayaran = json_decode($data->data_pembayaran, true);
                                @endphp
                                @foreach ($list_pembayaran['list'] as $item)
                                        <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                                            <div class="flex items-center justify-between w-full">
                                                <span>{{ $item['name'] }}</span>
                                                <span>RP {{ number_format($item['nominal'], 0, ',', '.') }}</span>
                                            </div>
                                        </li>


                                @endforeach
                                <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-semibold border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200">
                                    <div class="flex items-center justify-between w-full">
                                        <span>{{ $list_pembayaran['kode_unik']['name'] }}</span>
                                        <span>Rp {{  number_format($list_pembayaran['kode_unik']['nominal'], 0, ',', '.') }}</span>
                                    </div>
                                </li>
                                <li class="inline-flex items-center gap-x-2 py-3 px-4 text-lg font-semibold bg-gray-50 border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200">
                                    <div class="flex items-center justify-between w-full">
                                        <span>Total</span>
                                        <span>Rp {{  number_format($data->nominal_total_pembayaran, 0, ',', '.') }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Table -->
                <div class="flex items-center justify-center">
                    <div class="mt-6 w-full md:w-2/5">
                        <div class="space-y-4 ">
                            <div class="bg-white p-2 md:p-4">
                                <div class="space-y-2 flex items-center justify-between gap-6 md:space-y-0">
                                    <div class="w-full min-w-0 flex-1 md:max-w-md">
                                        <h5 class="text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Metode Pembayaran
                                        </h5>
                                        <div class="flex items-center justify-between mb-4">
                                            <h1 class="text-xl mt-0 font-semibold text-gray-900 hover:underline dark:text-white">
                                                Bank BSI
                                            </h1>
                                            <img src="{{ url('/') }}/assets/pembayaran/bsi.png" alt="bsi" class="h-6 mr-2">
                                        </div>
                                        <h5 class="text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Atas Nama
                                        </h5>
                                        <div class="flex items-center justify-between mb-4">
                                            <h1 class="text-xl mt-0 font-semibold text-gray-900 hover:underline dark:text-white">
                                                Yayasan Ar Rahmah
                                            </h1>
                                        </div>
                                        <h5 class="text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Nomor Rekening
                                        </h5>
                                        <div class="flex items-center justify-between mb-4">
                                            <h1 class="text-xl mt-0 font-semibold text-gray-900 hover:underline dark:text-white">
                                                @php
                                                    $rekening = '';
                                                    if ($data->peserta->jenis_peserta == 'ikhwan') {
                                                        $rekening = '4550000015';
                                                    } elseif ($data->peserta->jenis_peserta == 'akhwat') {
                                                        $rekening = '7009999705';
                                                    }
                                                @endphp
                                                {{ $rekening }}
                                            </h1>
                                            <button id="copyButton" class="ml-2 border border-gray-200 px-2 py-1 rounded text-sm">Copy</button>
                                            <x-splade-script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    document.getElementById('copyButton').addEventListener('click', function() {
                                                        var tempInput = document.createElement('input');
                                                        tempInput.value = '{!! $rekening !!}';
                                                        document.body.appendChild(tempInput);
                                                        tempInput.select();
                                                        document.execCommand('copy');
                                                        document.body.removeChild(tempInput);
                                                        alert('Nomor Virtual Akun berhasil disalin');
                                                    });
                                                });
                                            </x-splade-script>
                                        </div>
                                        <h5 class="text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Total Pembayaran
                                        </h5>
                                        <div class="flex items-center justify-between">
                                            <h1 class="text-xl mt-0 font-semibold text-gray-900 hover:underline dark:text-white">
                                                Rp {{  number_format($data->nominal_total_pembayaran, 0, ',', '.') }}
                                            </h1>
                                            <button id="copyButtonTotal" class="ml-2 border border-gray-200 px-2 py-1 rounded text-sm">Copy</button>
                                            <x-splade-script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    document.getElementById('copyButtonTotal').addEventListener('click', function() {
                                                        var tempInput = document.createElement('input');
                                                        tempInput.value = '{!! $data->nominal_total_pembayaran !!}';
                                                        document.body.appendChild(tempInput);
                                                        tempInput.select();
                                                        document.execCommand('copy');
                                                        document.body.removeChild(tempInput);
                                                        alert('Total Nominal berhasil disalin');
                                                    });
                                                });
                                            </x-splade-script>
                                        </div>
                                        <div class="text-gray-700 text-xs p-2">*Wajib mencantumkan kode unik diakhir nominal</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($data->status == 1)
                            <x-splade-form action="{{ route('website.lttq.invoice.store', ['uuid' => $uuid]) }}"
                                    confirm-text="Apakah file bukti transfer sudah benar ?"
                                    confirm="Konfirmasi"
                                    confirm-button="Benar"
                                    cancel-button="Belum"
                                    method="POST">
                                    @csrf
                                <div class="my-4">
                                    <span class="block mb-1 text-gray-700 font-sans"> Upload Bukti Transfer<span aria-hidden="true" class="text-red-600" title="This field is required">*</span></span>
                                    <BuktiTransferUpload upload-url="{{ route('website.lttq.invoice.store.buktitransfer', ['uuid' => $uuid]) }}"></BuktiTransferUpload>
                                </div>
                                <div class="flex items-center justify-center">
                                    <button type="submit" class="bg-primary-700 text-white py-2.5 px-5 rounded-lg">Konfirmasi Pembayaran </button>
                                </div>
                            </x-splade-form>
                        @elseif ($data->status == 2)
                            <div class="text-center">
                                <p>
                                    Terima kasih telah mendaftar.
                                </p>
                                <p>
                                    Mohon tunggu konfirmasi pembayaran dari kami.
                                </p>
                                <p>
                                    Syukron. Jazakumullah Khoiran.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- End Card -->

        </div>
    </div>
    <!-- End Invoice -->

    <div class="text-center py-8 bg-gray-100">
        <div class="flex items-center justify-center">
            <img src="{{ url('/') }}/assets/pembayaran/SSL-Secured.svg" alt="ssl" class="h-16 pt-3">
            <img class="h-12 mt-5 rounded-md" src="https://ipaymu.com/wp-content/themes/ipaymu_v2/assets/new-assets/image/iPaymu-PCIDSS.jpeg" alt="ipaymu">
        </div>
        <p class="text-sm pt-4 text-gray-600">
            &copy; {{ date('Y') }} arrahmahbalikpapan.or.id
        </p>
    </div>
</div>

