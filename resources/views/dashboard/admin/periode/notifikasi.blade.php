<x-splade-modal :unit="$unit">
    <x-splade-form action="{{ route('admin.periode.notifikasi.update', ['unit' => $unit, 'periode' => $periode, 'notifikasi' => $notifikasi->slug]) }}" method="POST"
            :default="[
                'pesan' => $notifikasi->pesan_whatsapp,
            ]"
        >
        @csrf

        <div class="relative">
            <x-forms.header>
                {{ $notifikasi->nama }}
            </x-forms.header>

            <x-forms.body>
                <div class="p-2 border rounded-md mb-4">
                    <div class="flex items-center justify-center p-2 text-md ">
                        Penggunaan Tag Mailing List
                    </div>
                    @php
                        $tag = [
                                '{Nama}' => 'Nama Santri / Peserta',
                                '{No Telp}' => 'No Telp Akun',
                                '{Email}' => 'Email Akun',
                                '{Gender}' => 'Ikhwan / Akhwat',
                                '{Alamat}' => 'Alamat Peserta',
                                '{Kota}' => 'Kota Peserta',
                                '{Unit}' => 'Tahsin, TLA, RTQ, RQ',
                                '{Periode}' => 'Periode',
                                '{Angkatan}' => 'Angkatan',
                                '{Jadwal}' => 'Nama Jadwal',
                                '{Pengajar}' => 'Nama Pengajar',
                                '{Level}' => 'Level',
                                '{Hari}' => 'Hari',
                                '{Jam}' => 'Jam',
                                '{Jenis Pembelajaran}' => 'Online / Offline',
                                '{Invoice}' => 'Nomor Invoice',
                                '{Total Biaya Pembayaran}' => 'Total Biaya Semua Yang Dibayar',
                                '{Total Selesai Pembayaran}' => 'Total Pembayaran Dari Invoice',
                                '{Total Biaya Belum Dibayar}' => 'Total Biaya Belum Dilunasi',
                                '{Bulan Terlunasi}' => 'Banyak Bulan Terlunasi',
                                '{Bulan Tunggakan}' => 'Banyak Bulan Yang Belum Lunas',
                            ];
                    @endphp
                    <div class="relative overflow-x-auto" style="height: 200px; overflow-y: scroll;">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                                <tr>
                                    <th scope="col" class="px-2 py-3">Item</th>
                                    <th scope="col" class="px-2 py-3">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tag as $key_tag => $item_tag)
                                    <tr class="bg-white border-b border-gray-200">
                                        <th scope="row" class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $key_tag }}
                                        </th>
                                        <td class="px-2 py-2">
                                            {{ $item_tag }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <x-splade-textarea name="pesan" :label="__('Isi Pesan Notifikasi')" autosize/>
            </x-forms.body>

            <x-forms.footer />
        </div>
    </x-splade-form>
</x-splade-modal>
