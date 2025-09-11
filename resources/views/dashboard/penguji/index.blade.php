<x-layouts.main :unit="$unit ?? null">
    <x-layouts.card>
        Selamat datang, di Dashboard Penguji
    </x-layouts.card>
    <div class="max-w-lg">
        <x-layouts.card>
            <div class="space-y-2 flex items-center justify-between gap-6 md:space-y-0">
                <div class="w-full min-w-0 flex-1 md:max-w-md">
                    <h5 class="text-xs font-medium text-gray-500 uppercase ">
                        Link Pendaftaran {{ $unit }}
                    </h5>
                    <div class="flex items-center justify-between mb-4">
                        <h1 class="text-xl mt-0 font-semibold text-gray-900 hover:underline dark:text-white">
                            Daftar Baru
                        </h1>
                        <div>
                            <Link away href="{{ route('pengajar.peserta.index', ['unit' => $unit]) }}" class=" border-primary-700 ml-2 border px-2 py-1 rounded text-sm text-primary-700">
                                FORM
                            </Link>
                            <button id="copyButton1" class="ml-2 border border-gray-400 px-2 py-1 rounded text-sm">Copy Link</button>
                        </div>
                        <x-splade-script>
                            document.addEventListener("DOMContentLoaded", function() {
                                document.getElementById('copyButton1').addEventListener('click', function() {
                                    var tempInput = document.createElement('input');
                                    tempInput.value = '{!! route('pengajar.peserta.index', ['unit' => $unit]) !!}';
                                    document.body.appendChild(tempInput);
                                    tempInput.select();
                                    document.execCommand('copy');
                                    document.body.removeChild(tempInput);
                                    alert('Link Pendaftaran {{ $unit }} berhasil disalin');
                                });
                            });
                        </x-splade-script>
                    </div>
                    <hr class="my-8">
                    <h5 class="text-xs font-medium text-gray-500 uppercase ">
                        Link Daftar Ulang {{ $unit }}
                    </h5>
                    <div class="flex items-center justify-between">
                        <h1 class="text-xl mt-0 font-semibold text-gray-900 hover:underline dark:text-white">
                            Daftar Ulang
                        </h1>
                        <div>
                            <Link away href="https://atthala.arrahmahbalikpapan.or.id/tahsin/daftar-ulang-peserta/cari" class=" border-primary-700 ml-2 border px-2 py-1 rounded text-sm text-primary-700">
                                FORM
                            </Link>
                            <button id="copyButton2" class="ml-2 border border-gray-400 px-2 py-1 rounded text-sm">Copy Link</button>
                        </div>
                        <x-splade-script>
                            document.addEventListener("DOMContentLoaded", function() {
                                document.getElementById('copyButton2').addEventListener('click', function() {
                                    var tempInput = document.createElement('input');
                                    tempInput.value = 'https://atthala.arrahmahbalikpapan.or.id/tahsin/daftar-ulang-peserta/cari';
                                    document.body.appendChild(tempInput);
                                    tempInput.select();
                                    document.execCommand('copy');
                                    document.body.removeChild(tempInput);
                                    alert('Link Daftar Ulang {{ $unit }} berhasil disalin');
                                });
                            });
                        </x-splade-script>
                    </div>
                </div>
            </div>
        </x-layouts.card>
    </div>
</x-layouts.main>
