
<table>
    <thead>
        <tr>
            <th>
                NIS
            </th>
            <th>
                Peserta
            </th>
            <th>
                No Telp
            </th>
            <th>
                Jadwal
            </th>
            @foreach($data_biaya as $item_biaya)
                <th>
                    {{ $item_biaya->nama }}
                </th>
            @endforeach
            {{-- <th>
                Total Pembayaran
            </th> --}}
            <th>
                Kode Unik
            </th>
            <th>
                Potongan
            </th>
            <th>
                Donasi
            </th>
            <th>
                Piutang
            </th>
            <th>
                Total Pembayaran
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_peserta as $item)
            @php
                $total_pembayaran = 0;
            @endphp
            <tr>
                <td>
                    {{ $item->nis_peserta }}
                </td>
                <td>
                    {{ $item->peserta->nama }}
                </td>
                <td>
                    {{ $item->peserta->phone_number }}
                </td>
                <td>
                    {{ $item->jadwal->nama_jadwal ?? '' }}
                </td>
                @foreach($data_biaya as $item_biaya_)
                    <td>
                        @if(isset($data_pembayaran_peserta[$item->id][$item_biaya_->id]))
                            @php
                                $total_pembayaran += $data_pembayaran_peserta[$item->id][$item_biaya_->id];
                            @endphp
                            Rp. {{ number_format($data_pembayaran_peserta[$item->id][$item_biaya_->id], 0, ',', '.') }}
                        @else
                            Rp. 0
                        @endif
                    </td>
                @endforeach
                {{-- <td>
                    Rp. {{ number_format($total_pembayaran, 0, ',', '.') }}
                </td> --}}
                <td>
                    Rp. {{ number_format($data_transaksi_peserta[$item->id]['kode_unik'] ?? 0, 0, ',', '.') }}
                </td>
                <td>
                    Rp. {{ number_format($data_transaksi_peserta[$item->id]['potongan'] ?? 0, 0, ',', '.') }}
                </td>
                <td>
                    Rp. {{ number_format($data_transaksi_peserta[$item->id]['donasi'] ?? 0, 0, ',', '.') }}
                </td>
                <td>
                    @php
                        $piutang = $total_biaya_periode - $total_pembayaran;
                    @endphp
                    Rp. {{ number_format($piutang ?? 0, 0, ',', '.') }}
                </td>
                <td>
                    Rp. {{ number_format($data_transaksi_peserta[$item->id]['nominal_total_pembayaran'] ?? 0, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </tbody>
    <thead>
        <tr>
            <th>-</th>
        </tr>
        <tr>
            <th>-</th>
        </tr>
        <tr>
            <th>
                Total
            </th>
            <th>
            </th>
            <th>
            </th>
            <th>
            </th>
            @foreach($data_biaya as $item_biaya)
                <th>
                    Rp. {{ $sum_data_biaya[$item_biaya->id] ? number_format($sum_data_biaya[$item_biaya->id], 0, ',', '.') : '0' }}
                </th>
            @endforeach
            {{-- <th>
                Rp. {{ $data_nominal['jumlah_nominal_biaya'] ? number_format($data_nominal['jumlah_nominal_biaya'], 0, ',', '.') : '0' }}
            </th> --}}
            <th>
                Rp. {{ $data_nominal['jumlah_nominal_kodeunik'] ? number_format($data_nominal['jumlah_nominal_kodeunik'], 0, ',', '.') : '0' }}
            </th>
            <th>
                Rp. {{ $data_nominal['jumlah_nominal_potongan'] ? number_format($data_nominal['jumlah_nominal_potongan'], 0, ',', '.') : '0' }}
            </th>
            <th>
                Rp. {{ $data_nominal['jumlah_nominal_donasi'] ? number_format($data_nominal['jumlah_nominal_donasi'], 0, ',', '.') : '0' }}
            </th>
            <th>
                Rp. {{ number_format($jumlah_nominal_piutang ?? 0, 0, ',', '.') }}
            </th>
            <th>
                Rp. {{ $data_nominal['jumlah_nominal_transfer'] ? number_format($data_nominal['jumlah_nominal_transfer'], 0, ',', '.') : '0' }}
            </th>
        </tr>
    </thead>
</table>