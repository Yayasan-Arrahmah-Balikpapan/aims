<?php

namespace App\Tables\Admin;

use App\Models\Kelas;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\SpladeTable;
use Maatwebsite\Excel\Excel;
use ProtoneMedia\Splade\Facades\Toast;


class TahsinPeserta extends AbstractTable
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    private $periode;
    private $unit;
    public function __construct($periode, $unit)
    {
        $this->periode = $periode;
        $this->unit = $unit;
    }

    /**
     * Determine if the user is authorized to perform bulk actions and exports.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        return false;
    }

    /**
     * The resource or query builder.
     *
     * @return mixed
     */
    public function for()
    {
        return Kelas::query()->where('periode_id', $this->periode);
    }

    /**
     * Configure the given SpladeTable.
     *
     * @param \ProtoneMedia\Splade\SpladeTable $table
     * @return void
     */
    public function configure(SpladeTable $table)
    {
        $table
            ->withGlobalSearch(columns: ['peserta.nama', 'peserta.jenis_peserta', 'jadwal.nama_jadwal', 'jadwal.pengajar.user.name', 'peserta.user.phone_number'])
            // ->rowLink(fn (Kelas $kelas) => route('admin.peserta.show', ['unit' => $this->unit, 'periode' => $this->periode,'peserta' => $kelas->id], $kelas))
            // ->column('id', sortable: true)
            ->selectFilter(
                key: 'peserta.jenis_peserta',
                label: 'Jenis',
                options: [
                    'ikhwan' => 'Ikhwan',
                    'akhwat' => 'Akhwat',
                ]
            )
            ->selectFilter(
                key: 'status_penerimaan',
                label: 'Status Penerimaan',
                options: [
                    'umum' => 'Umum',
                    'karyawan' => 'Karyawan',
                    'pengajar' => 'Pengajar',
                    'beasiswa' => 'Beasiswa',
                ]
            )
            ->selectFilter(
                key: 'status_daftar',
                label: 'Status Daftar',
                options: [
                    'baru' => 'Baru Daftar',
                    'melanjutkan' => 'Peserta Lanjutan',
                ]
            )
            ->selectFilter(
                key: 'status_pendaftaran',
                label: 'Status Pendaftaran',
                options: [
                    'belum diberikan level' => 'Belum Diberikan Level',
                    'belum pilih jadwal' => 'Belum Pilih Jadwal',
                    'selesai pilih jadwal' => 'Selesai Pilih Jadwal',
                ]
            )
            ->selectFilter(
                key: 'status_aktif',
                label: 'Status Aktif',
                options: [
                    'aktif' => 'Aktif',
                    'ditangguhkan' => 'Ditangguhkan',
                    'off' => 'Off',
                ]
            )
            ->selectFilter(
                key: 'status_ujian',
                label: 'Status Ujian',
                options: [
                    'belum ujian' => 'Belum Ujian',
                    'selesai ujian' => 'Selesai Ujian',
                ]
            )
            ->selectFilter(
                key: 'status_daftar_ulang',
                label: 'Status Daftar Ulang',
                options: [
                    'belum daftar ulang' => 'Belum Daftar Ulang',
                    'selesai daftar ulang' => 'Selesai Daftar Ulang',
                ]
            )
            ->selectFilter(
                key: 'status_domisili',
                label: 'Asal Kota',
                options: [
                    '1' => 'Kota Balikpapan',
                    '0' => 'Luar Kota Balikpapan',
                ]
            )
            ->column(label: 'Actions')
            ->column(
                key:'nis_peserta',
                label:'NIS',
            )
            ->column(
                key:'peserta.nama',
                label:'Nama',
            )
            ->column(
                key:'peserta.user.phone_number',
                label:'No. Telp',
            )
            ->column(
                key:'peserta.jenis_peserta',
                label:'Jenis',
            )
            ->column(
                key:'jadwal.nama_jadwal',
                label:'Kelas',
            )
            ->column(
                key:'jadwal.pengajar.user.name',
                label:'Pengajar',
            )
            ->column(
                key:'created_at',
                label:'Tanggal Daftar',
            )
            ->column(
                key:'status_aktif',
                label:'Status',
            )
            ->bulkAction(
                label: 'Kirim Notifikasi Pembayaran SPP',
                each: function (Kelas $kelas) {
                    Toast::warning('Terjadi kesalahan, data gagal disimpan'.$kelas->id)->autoDismiss(5);
                },
                confirm: 'Touch kelass',
                confirmText: 'Are you sure you want to touch the kelass?',
                confirmButton: 'Yes, touch all selected rows!',
                cancelButton: 'No, do not touch!',
            )
            ->bulkAction(
                label: 'Kirim Notifikasi Pilih Jadwal',
                each: fn (Kelas $kelas) => $kelas->touch(),
                confirm: 'Touch kelass',
                confirmText: 'Are you sure you want to touch the kelass?',
                confirmButton: 'Yes, touch all selected rows!',
                cancelButton: 'No, do not touch!',
            )
            ->export()
            ->paginate(10)
            ;
    }
}
