<x-layouts.main>
    <div class="p-4">
        <h2 class="text-2xl font-bold uppercase">
            Cuti Karyawan
        </h2>
    </div>

    <div class="m-4">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
            <div class="bg-white p-4 rounded-lg border">
                <div class="">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Syarat :</h3>
                    <ul class="list-disc list-inside text-gray-700 dark:text-gray-400 pl-4">
                        <li class="flex items-start"><span class="mr-2 font-bold">1.</span> Cuti diajukan paling lambat 1 pekan sebelumnya.</li>
                        <li class="flex items-start"><span class="mr-2 font-bold">2.</span> Jumlah cuti yang diambil tidak boleh lebih dari 12 hari kerja dalam setahun.</li>
                        <li class="flex items-start"><span class="mr-2 font-bold">3.</span> Persetujuan dari atasan diperlukan dalam prosesnya.</li>
                    </ul>
                </div>
                <hr class="my-4">
                <div class="flex justify-end">
                    <Link modal href="{{ route('karyawan.cuti.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-700 rounded-md font-semibold text-white ">
                        Ajukan Cuti
                    </Link>

                </div>
            </div>
        </div>
        <div class="my-8">
            <div class="bg-white p-4 rounded-lg border mb-4">
                <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Riwayat Cuti</h2>
                    <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                        <span class="inline-block text-gray-500 dark:text-gray-400"> Tahun </span>

                        <form action="">
                            <label for="duration" class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select duration</label>
                            <select name="tahun" id="duration" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" onchange="this.form.submit()">
                                <option selected>---</option>
                                @for ($year = date('Y'); $year >= 2024; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="space-y-2">
                @foreach ($data_cuti as $cuti)
                    <div class="bg-white p-4 rounded-lg border">
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                    <dl class="col-span-1">
                                        <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Tanggal Pengajuan:</dt>
                                        <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $cuti->created_at->translatedFormat('d F Y') }}
                                        </dd>
                                    </dl>
                                    <dl class="col-span-2">
                                        <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Keperluan:</dt>
                                        <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                            {{ $cuti->alasan }}
                                        </dd>
                                    </dl>
                                </div>

                                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                                    <dl class="col-auto">
                                        <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Tanggal Mulai:</dt>
                                        <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($cuti->tanggal_mulai)->translatedFormat('d F Y') }}</dd>
                                    </dl>

                                    <dl class="col-auto">
                                        <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Tanggal Selesai:</dt>
                                        <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($cuti->tanggal_selesai)->translatedFormat('d F Y') }}</dd>
                                    </dl>

                                    <dl class="col-auto">
                                        <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>
                                        @if ($cuti->status == 'MENUNGGU PERSETUJUAN')
                                            <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-yellow-200 px-2.5 py-0.5 text-xs font-medium text-gray-00">
                                                {{ $cuti->status }}
                                            </dd>
                                        @elseif ($cuti->status == 'DISETUJUI')
                                            <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-green-200 px-2.5 py-0.5 text-xs font-medium text-gray-00">
                                                {{ $cuti->status }}
                                            </dd>
                                        @elseif ($cuti->status == 'DITOLAK')
                                            <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-red-200 px-2.5 py-0.5 text-xs font-medium text-gray-00">
                                                {{ $cuti->status }}
                                            </dd>
                                        @else
                                            -
                                        @endif
                                    </dl>

                                    <div class="col-auto flex justify-end text-right items-end">

                                        @if ($cuti->status == 'MENUNGGU PERSETUJUAN')
                                            <x-splade-form
                                                    action="{{ route('karyawan.cuti.destroy', $cuti->id) }}"
                                                    method="DELETE"
                                                    confirm="Konfirmasi Hapus Data"
                                                    confirm-text="Hapus pengajuan cuti?"
                                                    confirm-button="Ya"
                                                    cancel-button="Tidak"
                                                >
                                                @csrf
                                                <button type="submit" class="inline-flex justify-between items-center px-4 py-2 bg-red-600 rounded-md font-semibold text-white">
                                                    Hapus
                                                </button>
                                            </x-splade-form>
                                        @elseif ($cuti->status == 'DISETUJUI')
                                            @svg('carbon-checkmark-outline', 'h-10 w-10 mr-2 text-primary-600')
                                        @elseif ($cuti->status == 'DITOLAK')
                                            @svg('carbon-misuse-outline', 'h-10 w-10 mr-2 text-red-600')
                                        @endif

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
            <div class="p-2 text-xs text-gray-500">
                {{ $data_cuti->links() }}
            </div>
        </div>
    </div>

    <section class="bg-white py-8 dark:bg-gray-900 md:py-16">
        <div class=" px-4 mx-auto">

        </div>
    </section>



</x-layouts.main>
