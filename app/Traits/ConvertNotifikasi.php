<?php

namespace App\Traits;

trait ConvertNotifikasi
{
    public function formatWhatsappPesertaKelas($data_notifikasi, $id)
    {
        $data = \App\Models\Kelas::find($id);
        $notifikasi = $data_notifikasi;
        $notifikasi = str_replace('{Nama}', $data->peserta->nama ?? '-', $notifikasi);
        $notifikasi = str_replace('{No Telp}', $data->peserta->phone_number ?? null, $notifikasi);
        $notifikasi = str_replace('{Email}', $data->peserta->user ? $data->peserta->user->email : '-', $notifikasi);
        $notifikasi = str_replace('{Gender}', $data->peserta->jenis_peserta ?? '', $notifikasi);
        $notifikasi = str_replace('{Alamat}', $data->peserta->biodata ? $data->peserta->biodata['alamat'] : '', $notifikasi);
        $notifikasi = str_replace('{Kota}', $data->peserta->biodata ? $data->peserta->biodata['kota_domisili'] : '', $notifikasi);
        $notifikasi = str_replace('{Unit}', $data->periode->unit->nama ?? '', $notifikasi);
        $notifikasi = str_replace('{Periode}', $data->periode->nama ?? '', $notifikasi);
        $notifikasi = str_replace('{Angkatan}', $data->periode->angkatan ?? '', $notifikasi);
        $notifikasi = str_replace('{Jadwal}', $data->jadwal ? $data->jadwal->nama_jadwal : '-', $notifikasi);
        $notifikasi = str_replace('{Pengajar}', $data->jadwal ? $data->jadwal->pengajar->nama : '-', $notifikasi);
        $notifikasi = str_replace('{Level}', $data->jadwal ? $data->jadwal->level->nama : '-', $notifikasi);
        $notifikasi = str_replace('{Level Baru}', $data->data_nilai ? $data->data_nilai['penempatan-level'] : '-', $notifikasi);
        $notifikasi = str_replace('{Hari}', $data->jadwal ? $data->jadwal->hari_belajar : '', $notifikasi);
        $notifikasi = str_replace('{Jam}', $data->jadwal ? $data->jadwal->jam_mulai : '', $notifikasi);
        $notifikasi = str_replace('{Jenis Pembelajaran}', $data->jadwal ? $data->jadwal->status_belajar : '', $notifikasi);

        return $notifikasi;
    }

    public function formatWhatsappPesertaKelasDanTransaksi($data_notifikasi, $id_peserta_kelas, $id_transaksi)
    {
        $data = \App\Models\Kelas::find($id_peserta_kelas);
        $data_transaksi = \App\Models\Transaksi::find($id_transaksi);
        $notifikasi = $data_notifikasi;
        $notifikasi = str_replace('{Nama}', $data->peserta->nama ?? '-', $notifikasi);
        $notifikasi = str_replace('{No Telp}', $data->peserta->phone_number ?? null, $notifikasi);
        $notifikasi = str_replace('{Email}', $data->peserta->user ? $data->peserta->user->email : '-', $notifikasi);
        $notifikasi = str_replace('{Gender}', $data->peserta->jenis_peserta ?? '', $notifikasi);
        $notifikasi = str_replace('{Alamat}', $data->peserta->biodata ? $data->peserta->biodata['alamat'] : '', $notifikasi);
        $notifikasi = str_replace('{Kota}', $data->peserta->biodata ? $data->peserta->biodata['kota_domisili'] : '', $notifikasi);
        $notifikasi = str_replace('{Unit}', $data->periode->unit->nama ?? '', $notifikasi);
        $notifikasi = str_replace('{Periode}', $data->periode->nama ?? '', $notifikasi);
        $notifikasi = str_replace('{Angkatan}', $data->periode->angkatan ?? '', $notifikasi);
        $notifikasi = str_replace('{Jadwal}', $data->jadwal ? $data->jadwal->nama_jadwal : '-', $notifikasi);
        $notifikasi = str_replace('{Pengajar}', $data->jadwal ? $data->jadwal->pengajar->nama : '-', $notifikasi);
        $notifikasi = str_replace('{Level}', $data->jadwal ? $data->jadwal->level->nama : '-', $notifikasi);
        $notifikasi = str_replace('{Level Baru}', $data->data_nilai ? $data->data_nilai['penempatan-level'] : '-', $notifikasi);
        $notifikasi = str_replace('{Hari}', $data->jadwal ? $data->jadwal->hari_belajar : '', $notifikasi);
        $notifikasi = str_replace('{Jam}', $data->jadwal ? $data->jadwal->jam_mulai : '', $notifikasi);
        $notifikasi = str_replace('{Jenis Pembelajaran}', $data->jadwal ? $data->jadwal->status_belajar : '', $notifikasi);
        $notifikasi = str_replace('{Invoice}', $data_transaksi->uuid ?? '', $notifikasi);
        $notifikasi = str_replace('{Total Biaya Pembayaran}', $data_transaksi->nominal_total ?? 0, $notifikasi);
        $notifikasi = str_replace('{Total Selesai Pembayaran}', $data_transaksi->nominal_total_pembayaran ?? 0, $notifikasi);
        $notifikasi = str_replace('{Total Biaya Belum Dibayar}', 0, $notifikasi);
        $notifikasi = str_replace('{Bulan Terlunasi}', '-', $notifikasi);
        $notifikasi = str_replace('{Bulan Tunggakan}', '-', $notifikasi);

        return $notifikasi;
    }
}
