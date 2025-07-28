<x-app-layout>
    <x-splade-script>
        var start = new Date().getTime();
        document.addEventListener("DOMContentLoaded", function() {
            setInterval(function() {
                var now = new Date().getTime();
                var timeleft = 180000 - (now - start);
                var minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeleft % (1000 * 60)) / 1000);
                document.getElementById('timer').innerText = minutes + "m " + seconds + "s";
                if (timeleft <= 0) {
                    location.reload();
                }
            }, 1000);
        });
    </x-splade-script>

    <div class="pt-10 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white rounded-lg p-4">
                <div class="text-center">
                    <h1 class="text-2xl font-bold pb-2">Pilih Jadwal {{ $peserta->periode->unit->nama }}</h1>
                    <h1 class="text-xl font-bold">{{ $peserta->periode->nama }}</h1>
                </div>
            </div>
            <div class="flex justify-end py-4">
                {{-- <input type="text" placeholder="Cari Peserta..."
                    class="w-full max-w-xs border border-gray-300 rounded-lg py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    oninput="filterList(this.value)"> --}}
                <p class="text-sm text-gray-700">Data akan otomatis di perbaruhi pada : <span id="timer"></span></p>
            </div>
            <div class="flow-root">
                <ul role="list" class="space-y-2">
                    @foreach ($data_jadwal as $item)
                        <li class="p-4 border rounded-md bg-white">
                            <div class="flex items-center justify-between uppercase space-x-2">
                                <div class="text-xs font-semibold">
                                    JUMLAH PESERTA : {{ $data_jumlah_jadwal[$item->id]}}
                                </div>
                                <div class="text-xs font-semibold">
                                    JUMLAH KUOTA : {{ $item->batasan_peserta }}
                                </div>
                            </div>
                            <hr class="my-2" />
                            <div class="flex items-center">
                                <div class="flex-1 min-w-0">
                                    <p class="text-md font-medium text-gray-900 uppercase">
                                        {{ $item->nama_jadwal }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                    @if ($data_jumlah_jadwal[$item->id] < $item->batasan_peserta)
                                        <Link
                                            confirm="Konfirmasi Pilihan Jadwal"
                                            confirm-text="{{ $item->nama_jadwal }}"
                                            confirm-button="Ya"
                                            cancel-button="Batalkan"
                                            href="{{ route('dashboard.peserta.daftar-jadwal.update', ['peserta' => $peserta->uuid, 'jadwal' => $item->id]) }}"
                                            class="text-sm flex font-semibold border rounded-lg py-2.5 px-5 border-primary-700 bg-primary-700 text-white">
                                            Pilih Jadwal Ini
                                        </Link>
                                    @else
                                        <div class="text-sm flex font-semibold border rounded-lg py-2.5 px-5 border-red-700 text-red-700">
                                            Kuota Terpenuhi
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <hr class="my-2" />
                            <div class="flex items-center justify-between uppercase space-x-2">
                                <div class="flex flex-col">
                                    <p class="text-sm font-medium text-gray-700">Hari</p>
                                    <p class="text-md font-bold text-gray-800">{{ $item->hari_belajar ?? '-' }}</p>
                                </div>
                                <div class="flex flex-col">
                                    <p class="text-sm font-medium text-gray-700">Waktu </p>
                                    <p class="text-md font-bold text-gray-800">{{ $item->jam_mulai ?? '.' }} WITA</p>
                                </div>
                                <div class="flex flex-col">
                                    <p class="text-sm font-medium text-gray-700">Level</p>
                                    <p class="text-md font-bold text-gray-800">{{ $item->level ? $item->level->nama : '-' }}</p>
                                </div>
                                <div class="flex flex-col">
                                    <p class="text-sm font-medium text-gray-700">Belajar</p>
                                    <p class="text-md font-bold text-gray-800">{{ $item->status_belajar ?? '-' }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
