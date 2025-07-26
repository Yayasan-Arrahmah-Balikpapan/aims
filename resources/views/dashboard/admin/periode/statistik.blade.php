<x-layouts.main :unit="$unit">

    <x-layouts.card>
        <h2 class="text-xl font-bold uppercase">
            Periode {{ $unit }}  Angkatan {{ $dataperiode->angkatan }}, Tahun {{ $dataperiode->tahun_ajaran }}
        </h2>
    </x-layouts.card>

    <div class="md:flex p-3">
        @include('dashboard.admin.periode.menu')

        <div class="w-full ml-4 space-y-4">
            <dl class="grid mx-auto text-gray-900 sm:grid-cols-4 gap-4">
                <div class="text-center items-center justify-center bg-white p-4 border rounded-lg">
                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold text-gray-600">{{ $data_statistik['jumlah_peserta'] }}</dt>
                    <dd class="font-light text-gray-500">Jumlah Peserta</dd>
                    <div class="grid grid-cols-2 border-t mt-3 pt-3">
                        <div class="flex flex-col items-center justify-center">
                            <dt class="text-xl text-blue-500 font-extrabold">{{ $data_statistik['jumlah_peserta_ikhwan'] }}</dt>
                            <dd class="font-light text-gray-500">Ikhwan</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <dt class="text-xl text-pink-500 font-extrabold">{{ $data_statistik['jumlah_peserta_akhwat'] }}</dt>
                            <dd class="font-light text-gray-500">Akhwat</dd>
                        </div>
                    </div>
                </div>
                <div class="text-center items-center justify-center bg-white p-4 border rounded-lg">
                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold text-gray-600">{{ $data_statistik['jumlah_peserta_daftar_baru'] }}</dt>
                    <dd class="font-light text-gray-500">Daftar Baru</dd>
                    <div class="grid grid-cols-2 border-t mt-3 pt-3">
                        <div class="flex flex-col items-center justify-center">
                            <dt class="text-xl text-blue-500 font-extrabold">{{ $data_statistik['jumlah_peserta_daftar_baru_ikhwan'] }}</dt>
                            <dd class="font-light text-gray-500">Ikhwan</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <dt class="text-xl text-pink-500 font-extrabold">{{ $data_statistik['jumlah_peserta_daftar_baru_akhwat'] }}</dt>
                            <dd class="font-light text-gray-500">Akhwat</dd>
                        </div>
                    </div>
                </div>
                <div class="text-center items-center justify-center bg-white p-4 border rounded-lg">
                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold text-gray-600">{{ $data_statistik['jumlah_peserta_daftar_ulang'] }}</dt>
                    <dd class="font-light text-gray-500">Daftar Ulang</dd>
                    <div class="grid grid-cols-2 border-t mt-3 pt-3">
                        <div class="flex flex-col items-center justify-center">
                            <dt class="text-xl text-blue-500 font-extrabold">{{ $data_statistik['jumlah_peserta_daftar_ulang_ikhwan'] }}</dt>
                            <dd class="font-light text-gray-500">Ikhwan</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <dt class="text-xl text-pink-500 font-extrabold">{{ $data_statistik['jumlah_peserta_daftar_ulang_akhwat'] }}</dt>
                            <dd class="font-light text-gray-500">Akhwat</dd>
                        </div>
                    </div>
                </div>
                <div class="text-center items-center justify-center bg-white p-4 border rounded-lg">
                    <dt class="mb-2 text-3xl md:text-4xl font-extrabold text-gray-600">{{ $data_statistik['jumlah_peserta_ujian'] }}</dt>
                    <dd class="font-light text-gray-500">Ujian</dd>
                    <div class="grid grid-cols-2 border-t mt-3 pt-3">
                        <div class="flex flex-col items-center justify-center">
                            <dt class="text-xl text-blue-500 font-extrabold">{{ $data_statistik['jumlah_peserta_ujian_ikhwan'] }}</dt>
                            <dd class="font-light text-gray-500">Ikhwan</dd>
                        </div>
                        <div class="flex flex-col items-center justify-center">
                            <dt class="text-xl text-pink-500 font-extrabold">{{ $data_statistik['jumlah_peserta_ujian_akhwat'] }}</dt>
                            <dd class="font-light text-gray-500">Akhwat</dd>
                        </div>
                    </div>
                </div>
            </dl>
            {{-- <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2 p-6 bg-white border border-gray-200 rounded-lg">
                    <TahsinDashboardPeriode1>
                    </TahsinDashboardPeriode1>
                </div>
                <div class="col-span-1 p-6 bg-white border border-gray-200 rounded-lg">
                    <TahsinDashboardPeriode2>
                    </TahsinDashboardPeriode2>
                </div>
            </div> --}}
        </div>
    </div>

</x-layouts.main>
