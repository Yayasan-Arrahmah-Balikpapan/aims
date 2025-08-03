<x-app-layout>
    <div class="pt-4 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white rounded-lg p-4 mb-4">
                <div class="block sm:flex items-center sm:justify-between">
                    <h1 class="text-2xl font-bold mb-4">Riwayat Pembayaran</h1>
                    <Link href="{{ route('dashboard.peserta.pembayaran.pilih-peserta') }}" class="py-2 px-5 flex justify-between text-primary-800 text-sm uppercase font-semibold border border-primary-800 rounded-lg">
                        Buat Pembayaran
                        <x-carbon-document-export class="w-5 h-5 ml-2 text-primary-800"/>
                    </Link>
                </div>
            </div>
            <div class="flow-root">
                <ul role="list" class="space-y-2">
                    @foreach ($data_transaksi as $item)
                        <li class="p-4 border rounded-md bg-white">
                            <div class="flex items-center justify-between border-b pb-2">
                                <div class="flex-1 min-w-0 ms-4">
                                    <p class="text-md font-bold text-gray-900 uppercase">
                                        INVOICE : {{ \Carbon\Carbon::parse($item->created_at)->format('Ymd') }}-{{ $item->id}}
                                    </p>
                                    {{-- <p class="text-sm text-gray-500 uppercase">
                                        {{ $item->created_at->format('d F Y') }}
                                    </p> --}}
                                </div>

                                @if ($item->status == 1)
                                    <span class="bg-yellow-300 text-gray-900 px-2 py-1 rounded text-sm flex">Menunggu Pembayaran</span>
                                @elseif ($item->status == 2)
                                    <span class="bg-blue-500 text-white px-2 py-1 rounded text-sm flex">Menunggu Konfirmasi</span>
                                @elseif ($item->status == 3)
                                    <span class="bg-green-500 text-white px-2 py-1 rounded text-sm flex">LUNAS</span>
                                @elseif ($item->status == 4)
                                    <span class="bg-red-500 text-white px-2 py-1 rounded text-sm flex">Kadaluarsa</span>
                                @endif
                            </div>
                            <div class="flex items-center pt-2">
                                <div class="flex-1 min-w-0 ms-4">
                                    <Link href="{{ route('dashboard.peserta', ['uuid' => $item->kelas->uuid ]) }}">
                                        <p class="text-md font-medium text-gray-900 uppercase">
                                            {{ $item->kelas->nis_peserta }} - {{ $item->kelas->peserta->nama }}
                                        </p>
                                        <p class="text-sm text-gray-500 uppercase">
                                            {{ $item->periode->unit->nama }} {{ $item->periode->nama }}
                                        </p>
                                    </Link>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                    <Link href="{{ route('website.lttq.invoice', ['uuid' => $item->uuid, 'program' => $item->program_slug]) }}"
                                        class="text-sm flex font-semibold  border-primary-700 text-primary-700 hover:text-white bg-white  hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300">
                                        Lihat Invoice
                                    </Link>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flow-root py-4">
                {{ $data_transaksi->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
