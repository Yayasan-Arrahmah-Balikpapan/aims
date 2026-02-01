<x-layouts.card-a>
    @if(!$data_peserta)
        <div class="text-center py-6">
            <h3 class="text-2xl font-bold text-gray-900">Belum memiliki peserta</h3>
        </div>
    @else
        <x-splade-form class="relative overflow-x-auto rounded-md mb-4 bg-white"
            action="{{ route('pengajar.absensi.data.kelas.store', ['unit' => $unit, 'periode' => $periode, 'kelas' => $kelas]) }}?ke=ujian"
            method="POST"
            :default="$data_absensi_default"
            >
            @csrf
            <div class="max-w-md mx-auto my-2 p-4 border rounded-md text-center">
                    <h2 class="text-lg font-bold text-gray-700">Penilaian Hasil Ujian</h2>
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
                        <div class="grid grid-cols-1 gap-2">
                            <x-splade-select name="ujian{{ $item->id }}">
                                <option value="">-- Pilih Level --</option>
                                @foreach ($data_level as $level)
                                    <option value="{{ $level->id }}">{{ $level->nama }}</option>
                                @endforeach
                            </x-splade-select>
                            <span class="pt-2">Catatan Hasil Ujian</span>
                            <input name="keteranganhasilujian{{ $item->id }}" value="{{ isset($ket_['keteranganhasilujian']) ? $ket_['keteranganhasilujian'] : '-' }}" placeholder="Catatan Hasil Ujian"
                                    class="block w-full border focus:border-sky-300 focus:ring focus:ring-sky-200 focus:ring-opacity-50 disabled:opacity-50 border-gray-300 disabled:bg-gray-50 disabled:cursor-not-allowed rounded-md"/>
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
