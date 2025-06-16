<x-splade-modal max-width="5xl">
    <div class="relative overflow-x-auto p-4">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3"></th>
                    <th scope="col" class="px-6 py-3">Waktu</th>
                    <th scope="col" class="px-6 py-3">Foto</th>
                    <th scope="col" class="px-6 py-3">Keterangan</th>
                    <th scope="col" class="px-6 py-3">Lokasi</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b border-gray-200">
                    <td  scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Datang
                    </td>
                    <td class="px-6 py-4">{{ $absensi->waktu_datang ? $absensi->waktu_datang->timezone('Asia/Makassar')->format('H:i').' WITA' : '-' }}</td>
                    <td class="px-6 py-4">
                        <img src="{{ isset($absensi->foto['datang']) ? Storage::url('public/'.$absensi->foto['datang']) : '' }}" class="w-64 rounded-lg shadow-lg">
                    </td>
                    <td class="px-6 py-4">
                        {{ isset($absensi->keterangan['datang']) ? $absensi->keterangan['datang'] : '-' }}
                    </td>
                    <td class="px-6 py-4">
                        <MapMini
                            :latitude="{{ isset($absensi->koordinat['latitude_datang']) ? $absensi->koordinat['latitude_datang'] : null }}"
                            :longitude="{{ isset($absensi->koordinat['longitude_datang']) ? $absensi->koordinat['longitude_datang'] : null }}"
                            :marker-label="'Datang'"
                        ></MapMini>
                    </td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td  scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Istirahat
                    </td>
                    <td class="px-6 py-4">{{ isset($absensi->keterangan['istirahat_mulai']) ? \Carbon\Carbon::parse($absensi->keterangan['istirahat_mulai'])->timezone('Asia/Makassar')->format('H:i').' WITA' : '-' }}</td>
                    <td class="px-6 py-4">
                        <img src="{{ isset($absensi->foto['istirahat_mulai']) ? Storage::url('public/'.$absensi->foto['istirahat_mulai']) : '' }}" class="w-64 rounded-lg shadow-lg">
                    </td>
                    <td class="px-6 py-4">
                        -
                    </td>
                    <td class="px-6 py-4">
                        @if (isset($absensi->koordinat['latitude_istirahat_mulai']))
                            <MapMini
                                :latitude="{{ isset($absensi->koordinat['latitude_istirahat_mulai']) ? $absensi->koordinat['latitude_istirahat_mulai'] : null }}"
                                :longitude="{{ isset($absensi->koordinat['longitude_istirahat_mulai']) ? $absensi->koordinat['longitude_istirahat_mulai'] : null }}"
                                :marker-label="'Istirahat'"
                            ></MapMini>
                        @endif
                    </td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td  scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Selesai Istirahat
                    </td>
                    <td class="px-6 py-4">{{ isset($absensi->keterangan['istirahat_selesai']) ? \Carbon\Carbon::parse($absensi->keterangan['istirahat_selesai'])->timezone('Asia/Makassar')->format('H:i').' WITA' : '-' }}</td>
                    <td class="px-6 py-4">
                        <img src="{{ isset($absensi->foto['istirahat_selesai']) ? Storage::url('public/'.$absensi->foto['istirahat_selesai']) : '' }}" class="w-64 rounded-lg shadow-lg">
                    </td>
                    <td class="px-6 py-4">
                        -
                    </td>
                    <td class="px-6 py-4">
                        @if (isset($absensi->koordinat['latitude_istirahat_selesai']))
                            <MapMini
                                :latitude="{{ isset($absensi->koordinat['latitude_istirahat_selesai']) ? $absensi->koordinat['latitude_istirahat_selesai'] : null }}"
                                :longitude="{{ isset($absensi->koordinat['longitude_istirahat_selesai']) ? $absensi->koordinat['longitude_istirahat_selesai'] : null }}"
                                :marker-label="'Selesai Istirahat'"
                            ></MapMini>
                        @endif
                    </td>
                </tr>
                <tr class="bg-white border-b border-gray-200">
                    <td  scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        Pulang
                    </td>
                    <td class="px-6 py-4">{{ $absensi->waktu_pulang ? $absensi->waktu_pulang->timezone('Asia/Makassar')->format('H:i').' WITA' : '-' }}</td>
                    <td class="px-6 py-4">
                        <img src="{{ isset($absensi->foto['pulang']) ? Storage::url('public/'.$absensi->foto['pulang']) : '' }}" class="w-64 rounded-lg shadow-lg">
                    </td>
                    <td class="px-6 py-4">
                        {{ isset($absensi->keterangan['pulang']) ? $absensi->keterangan['pulang'] : '-' }}
                    </td>
                    <td class="px-6 py-4">
                        @if (isset($absensi->koordinat['latitude_pulang']))
                            <MapMini
                                :latitude="{{ isset($absensi->koordinat['latitude_pulang']) ? $absensi->koordinat['latitude_pulang'] : null }}"
                                :longitude="{{ isset($absensi->koordinat['longitude_pulang']) ? $absensi->koordinat['longitude_pulang'] : null }}"
                                :marker-label="'Pulang'"
                            ></MapMini>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{-- @php
            $lokasi = [
                        [
                            'name' => 'Datang',
                            'latitude' => isset($absensi->koordinat['latitude_datang']) ? $absensi->koordinat['latitude_datang'] : null,
                            'longitude' => isset($absensi->koordinat['longitude_datang']) ? $absensi->koordinat['longitude_datang'] : null,
                        ],
                        [
                            'name' => 'Istirahat',
                            'latitude' => isset($absensi->koordinat['latitude_istirahat_mulai']) ? $absensi->koordinat['latitude_istirahat_mulai'] : null,
                            'longitude' => isset($absensi->koordinat['longitude_istirahat_mulai']) ? $absensi->koordinat['longitude_istirahat_mulai'] : null,
                        ],
                        [
                            'name' => 'Selesai Istirahat',
                            'latitude' => isset($absensi->koordinat['latitude_istirahat_selesai']) ? $absensi->koordinat['latitude_istirahat_selesai'] : null,
                            'longitude' => isset($absensi->koordinat['longitude_istirahat_selesai']) ? $absensi->koordinat['longitude_istirahat_selesai'] : null,
                        ],
                        [
                            'name' => 'Pulang',
                            'latitude' => isset($absensi->koordinat['latitude_pulang']) ? $absensi->koordinat['latitude_pulang'] : null,
                            'longitude' => isset($absensi->koordinat['longitude_pulang']) ? $absensi->koordinat['longitude_pulang'] : null,
                        ],
                    ];
        @endphp
        <MapMiniMultiMarker
            :locations="{{ json_encode($lokasi) }}"
            :label-offset="0"
            >
        </MapMiniMultiMarker> --}}
    </div>
</x-splade-modal>

