<x-layouts.card-a>
    @if(!$data_peserta)
        <div class="text-center py-6">
            <h3 class="text-2xl font-bold text-gray-900">Belum memiliki peserta</h3>
        </div>
    @else
        <x-splade-form class="relative overflow-x-auto rounded-md mb-4 bg-white"
            action="{{ route('pengajar.absensi.data.kelas.store', ['unit' => $unit, 'periode' => $periode, 'kelas' => $kelas]) }}"
            method="POST"
            :default="$data_absensi_default"
            >
            @csrf
            <div class="max-w-md mx-auto my-2 p-4 border rounded-md">
                <div class="flex items-center space-x-2">
                    <label for="tanggal_absen" class="text-sm font-medium text-gray-700 w-1/3">Tanggal Absen</label>
                    <x-splade-input name="tanggal" date class="block w-full"/>
                </div>
                <div class="flex items-center space-x-2">
                    <label for="surah" class="text-sm font-medium text-gray-700 w-1/3">Tilawah</label>
                    <x-splade-input name="tilawah" class="block w-full"/>
                </div>
                <div class="flex items-center space-x-2">
                    <label for="surah" class="text-sm font-medium text-gray-700 w-1/3">Pertemuan</label>
                    <x-splade-input name="ke" class="block w-full" readonly/>
                </div>
            </div>
            <div class="text-center">
                <h2 class="text-xl font-bold text-gray-500">PESERTA :</h2>
            </div>

            <div class="w-full space-y-2 mt-2">
                @foreach ($data_peserta as $item)
                    <div class="p-4 border border-gray-200 rounded-md mb-2">
                        <div class="uppercase pb-2">
                            <h3 class="text-md font-bold text-gray-700">{{ $item->peserta->nama }}</h3>
                            <p class="text-sm text-gray-500">{{ $item->nis_peserta }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="inline-flex items-center border rounded-md p-2">
                                <input type="radio" v-model="form.peserta{{ $item->id }}" value="2" class="text-primary-600 focus:ring-primary-600" {{ $item->absensi == 2 ? 'checked' : '' }}>
                                <span class="ml-2 text-xs font-semibold text-gray-700">TIDAK HADIR</span>
                            </label>
                            <label class="inline-flex items-center border rounded-md p-2">
                                <input type="radio" v-model="form.peserta{{ $item->id }}" value="1" class="text-primary-600 focus:ring-primary-600" {{ $item->absensi == 1 ? 'checked' : '' }}>
                                <span class="ml-2 text-xs font-semibold text-gray-700">HADIR</span>
                            </label>
                            <label class="inline-flex items-center border rounded-md p-2">
                                <input type="radio" v-model="form.peserta{{ $item->id }}" value="3" class="text-primary-600 focus:ring-primary-600" {{ $item->absensi == 3 ? 'checked' : '' }}>
                                <span class="ml-2 text-xs font-semibold text-gray-700">SAKIT</span>
                            </label>
                            <label class="inline-flex items-center border rounded-md p-2">
                                <input type="radio" v-model="form.peserta{{ $item->id }}" value="4" class="text-primary-600 focus:ring-primary-600" {{ $item->absensi == 4 ? 'checked' : '' }}>
                                <span class="ml-2 text-xs font-semibold text-gray-700">IZIN</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center justify-between mt-2 text-md">
                <a href="{{ url()->previous() }}" class="flex justify-between items-center px-3 py-1.5 font-medium rounded-md text-primary-700 border border-primary-700 bg-white ">
                    <x-carbon-chevron-left class="w-4 h-4 ml-2" />
                    Kembali
                </a>
                <button type="submit" class="flex justify-between items-center px-3 py-1.5 font-medium rounded-md text-white bg-primary-600">
                    Simpan
                    <x-carbon-save class="w-4 h-4 ml-2" />
                </button>
            </div>
        </x-splade-form>
    @endif
</x-layouts.card>
