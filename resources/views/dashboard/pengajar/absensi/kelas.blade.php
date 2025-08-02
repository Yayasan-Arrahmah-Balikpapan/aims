<x-layouts.main :unit="$unit">
    <div class="p-4 space-y-2">
        <x-layouts.card-a>
            <x-layouts.title>Kelas <text class="uppercase">{{ $unit }}</text></x-layouts.title>
            <div class="py-4">
                <div class="mb-4 grid gap-3 grid-cols-2 md:gap-6">
                    <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">Pengajar</p>
                        <p class="text-lg font-bold text-gray-800">{{  $data_kelas->pengajar ? $data_kelas->pengajar->kode_nama_pengajar : '-' }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">Jenis</p>
                        <p class="text-lg font-bold text-gray-800">{{ $data_kelas->jenis_peserta ?? '-' }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">Hari</p>
                        <p class="text-lg font-bold text-gray-800">{{ $data_kelas->hari_belajar ?? '-' }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">Waktu </p>
                        <p class="text-lg font-bold text-gray-800">{{ $data_kelas->jam_mulai ?? '.' }} - {{ $data_kelas->jam_selesai ?? '.' }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">Level</p>
                        <p class="text-lg font-bold text-gray-800">{{ $data_kelas->level ? $data_kelas->level->nama : '-' }}</p>
                    </div>
                    <div class="flex flex-col">
                        <p class="text-sm font-medium text-gray-700">Status Belajar</p>
                        <p class="text-lg font-bold text-gray-800">{{ $data_kelas->status_belajar ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </x-layouts.card>
        <div class="max-w-md mx-auto mb-2">
            <x-splade-form action="" method="GET" class="bg-white p-4 border rounded-md space-x-2 space-y-2"
                :default="[
                    'ke' => request('ke') ?? '',
                ]"
            >
                @csrf
                <div class="text-sm">
                    Pilih Pertemuan Absensi :
                </div>
                <div class="flex items-center justify-between space-x-2">
                    <select v-model="form.ke" id="pertemuan" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                        @for ($i = 1; $i <= 16; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                        <option value="ujian">Ujian</option>
                    </select>
                    <x-splade-submit label="Pilih" class="px-4 py-2" />
                </div>
            </x-splade-form>
        </div>
        @if ($unit == 'tahsin')
            @if(request()->has('ke'))
                @if (request('ke') == 'ujian')
                    @include('dashboard.pengajar.absensi.tahsin-ujian')
                @else
                    @include('dashboard.pengajar.absensi.tahsin-pertemuan')
                @endif
            @else
                @include('dashboard.pengajar.absensi.tahsin-data')
            @endif
        @endif
    </div>
</x-layouts.main>
