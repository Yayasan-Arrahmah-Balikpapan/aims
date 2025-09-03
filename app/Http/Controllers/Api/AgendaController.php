<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class AgendaController extends Controller
{
        public function index()
    {
        $agenda = [
                [
                    "id"=> 1,
                    "title"=> "Orientasi Santri Baru RQ",
                    "date"=> "2025-07-10",
                    "category"=> "RQ",
                    "description"=> "Orientasi Santri Baru RQ pada tanggal 10-11 Juli 2025",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 2,
                    "title"=> "POMG RTQ Putra",
                    "date"=> "2025-07-13",
                    "category"=> "RTQ Putra",
                    "description"=> "Pertemuan Orang Tua Murid Guru RTQ Putra",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 3,
                    "title"=> "Kedatangan Santri Lama RTQ Putri",
                    "date"=> "2025-07-15",
                    "category"=> "RTQ Putri",
                    "description"=> "Kedatangan Santri Lama RTQ Putri",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 4,
                    "title"=> "Kedatangan Santri Baru RTQ Putri",
                    "date"=> "2025-07-20",
                    "category"=> "RTQ Putri",
                    "description"=> "Kedatangan Santri Baru RTQ Putri",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 5,
                    "title"=> "Acara Penyambutan Santri RTQ Putri",
                    "date"=> "2025-07-21",
                    "category"=> "RTQ Putri",
                    "description"=> "Acara Penyambutan Santri RTQ Putri",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 6,
                    "title"=> "Parenting RQ",
                    "date"=> "2025-08-09",
                    "category"=> "RQ",
                    "description"=> "Acara Parenting untuk Santri RQ",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 7,
                    "title"=> "Pawai RQ",
                    "date"=> "2025-08-15",
                    "category"=> "RQ",
                    "description"=> "Pawai dalam rangka peringatan HUT RI untuk Santri RQ",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 8,
                    "title"=> "Acara Kemerdekaan Yayasan",
                    "date"=> "2025-08-16",
                    "category"=> "Yayasan",
                    "description"=> "Acara Kemerdekaan untuk Yayasan Ar Rahmah",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 9,
                    "title"=> "Acara Kemerdekaan Santri RTQ Putri",
                    "date"=> "2025-08-23",
                    "category"=> "RTQ Putri",
                    "description"=> "Acara Kemerdekaan untuk Santri RTQ Putri",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 10,
                    "title"=> "Ujian Tahsin Akhwat",
                    "date"=> "2025-08-23",
                    "category"=> "Tahsin",
                    "description"=> "Ujian Tahsin untuk Akhwat pada tanggal 23-25 Agustus 2025",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 11,
                    "title"=> "Muhadhoroh Santri RTQ Putri",
                    "date"=> "2025-08-30",
                    "category"=> "RTQ Putri",
                    "description"=> "Muhadhoroh untuk Santri RTQ Putri",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 12,
                    "title"=> "Ujian Tahsin Ikhwan",
                    "date"=> "2025-08-31",
                    "category"=> "Tahsin",
                    "description"=> "Ujian Tahsin untuk Ikhwan",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 13,
                    "title"=> "Pembukaan Pendaftaran Tahsin",
                    "date"=> "2025-09-05",
                    "category"=> "Tahsin",
                    "description"=> "Pembukaan Pendaftaran Tahsin",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 14,
                    "title"=> "Maulid Nabi Muhammad",
                    "date"=> "2025-09-08",
                    "category"=> "Umum",
                    "description"=> "Peringatan Maulid Nabi Muhammad",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 15,
                    "title"=> "Pengumuman Ujian Tahsin Angkatan 26",
                    "date"=> "2025-09-13",
                    "category"=> "Tahsin",
                    "description"=> "Pengumuman hasil Ujian Tahsin Angkatan 26",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 16,
                    "title"=> "Rihlah Pengajar Tahsin",
                    "date"=> "2025-09-14",
                    "category"=> "Tahsin",
                    "description"=> "Rihlah (Darmawisata) untuk Pengajar Tahsin",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 17,
                    "title"=> "Evaluasi Hafalan Santri RQ",
                    "date"=> "2025-09-15",
                    "category"=> "RQ",
                    "description"=> "Evaluasi Hafalan untuk Santri RQ pada tanggal 15-26 September 2025",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 18,
                    "title"=> "Rihlah RTQ Putra",
                    "date"=> "2025-09-17",
                    "category"=> "RTQ Putra",
                    "description"=> "Rihlah (Darmawisata) untuk Santri RTQ Putra",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 19,
                    "title"=> "Muhadhoroh RTQ Putri",
                    "date"=> "2025-09-26",
                    "category"=> "RTQ Putri",
                    "description"=> "Muhadhoroh untuk Santri RTQ Putri",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 20,
                    "title"=> "Rihlah RTQ Putri",
                    "date"=> "2025-09-27",
                    "category"=> "RTQ Putri",
                    "description"=> "Rihlah (Darmawisata) untuk Santri RTQ Putri",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 21,
                    "title"=> "Pembagian Rapot Santri RQ",
                    "date"=> "2025-10-04",
                    "category"=> "RQ",
                    "description"=> "Pembagian Rapot untuk Santri RQ",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 22,
                    "title"=> "Mukhoyyam TLA",
                    "date"=> "2025-10-18",
                    "category"=> "TLA",
                    "description"=> "Mukhoyyam (Perkemahan) TLA pada tanggal 18-19 Oktober 2025",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 23,
                    "title"=> "Outing RQ (Perpustakaan)",
                    "date"=> "2025-10-22",
                    "category"=> "RQ",
                    "description"=> "Outing Santri RQ ke Perpustakaan",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 24,
                    "title"=> "Peringatan Hari Santri",
                    "date"=> "2025-10-22",
                    "category"=> "Umum",
                    "description"=> "Peringatan Hari Santri Nasional",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 25,
                    "title"=> "Santri RTQ Putri Berenang",
                    "date"=> "2025-10-25",
                    "category"=> "RTQ Putri",
                    "description"=> "Kegiatan Berenang untuk Santri RTQ Putri",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 26,
                    "title"=> "Peringatan Hari Sumpah Pemuda",
                    "date"=> "2025-10-28",
                    "category"=> "Umum",
                    "description"=> "Peringatan Hari Sumpah Pemuda",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 27,
                    "title"=> "Market Day RQ",
                    "date"=> "2025-10-28",
                    "category"=> "RQ",
                    "description"=> "Kegiatan Market Day untuk Santri RQ pada tanggal 28-29 Oktober 2025",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 28,
                    "title"=> "Estimasi Kuliah Perdana Tahsin",
                    "date"=> "2025-10-19",
                    "category"=> "Tahsin",
                    "description"=> "Estimasi Kuliah Perdana Tahsin pada tanggal 19 atau 26 Oktober 2025",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 29,
                    "title"=> "Outing RQ (Beruang Madu)",
                    "date"=> "2025-11-14",
                    "category"=> "RQ",
                    "description"=> "Outing Santri RQ ke Pusat Konservasi Beruang Madu",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 30,
                    "title"=> "Mukhoyyam RTQ Putra & Putri",
                    "date"=> "2025-11-22",
                    "category"=> "RTQ",
                    "description"=> "Mukhoyyam (Perkemahan) untuk Santri RTQ Putra dan Putri",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 31,
                    "title"=> "Ujian Akhir Semester RQ",
                    "date"=> "2025-11-24",
                    "category"=> "RQ",
                    "description"=> "Ujian Akhir Semester untuk Santri RQ pada tanggal 24-28 November 2025",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 32,
                    "title"=> "Estimasi Imtihan Wisuda TLA",
                    "date"=> "2025-11-30",
                    "category"=> "TLA",
                    "description"=> "Estimasi pelaksanaan Imtihan Wisuda TLA",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 33,
                    "title"=> "Ujian Akhir Semester RQ",
                    "date"=> "2025-12-01",
                    "category"=> "RQ",
                    "description"=> "Ujian Akhir Semester untuk Santri RQ pada tanggal 1-5 Desember 2025",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 34,
                    "title"=> "Khataman Qubro RTQ Putra",
                    "date"=> "2025-12-02",
                    "category"=> "RTQ Putra",
                    "description"=> "Khataman Qubro untuk Santri RTQ Putra",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 35,
                    "title"=> "Ujian Sertifikasi RTQ Putri",
                    "date"=> "2025-12-01",
                    "category"=> "RTQ Putri",
                    "description"=> "Ujian Sertifikasi untuk Santri RTQ Putri pada tanggal 1-9 Desember 2025",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 36,
                    "title"=> "Estimasi Imtihan Wisuda TLA",
                    "date"=> "2025-12-07",
                    "category"=> "TLA",
                    "description"=> "Estimasi pelaksanaan Imtihan Wisuda TLA",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 37,
                    "title"=> "Ujian Diniyah RTQ Putri",
                    "date"=> "2025-12-08",
                    "category"=> "RTQ Putri",
                    "description"=> "Ujian Diniyah untuk Santri RTQ Putri pada tanggal 8-12 Desember 2025",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 38,
                    "title"=> "Pembagian Rapot RQ",
                    "date"=> "2025-12-13",
                    "category"=> "RQ",
                    "description"=> "Pembagian Rapot untuk Santri RQ",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 39,
                    "title"=> "Libur Santri RQ",
                    "date"=> "2025-12-16",
                    "category"=> "RQ",
                    "description"=> "Libur Santri RQ dari tanggal 16 Desember 2025 hingga 13 Januari 2026",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 40,
                    "title"=> "Liburan Seru Part #7 RQ",
                    "date"=> "2025-12-16",
                    "category"=> "RQ",
                    "description"=> "Liburan Seru Bagian #7 untuk Santri RQ pada tanggal 16-19 Desember 2025",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 41,
                    "title"=> "Wisuda RTQ Putra Putri",
                    "date"=> "2025-12-20",
                    "category"=> "RTQ",
                    "description"=> "Wisuda untuk Santri RTQ Putra dan Putri",
                    "time"=> "Sepanjang Hari"
                ],
                [
                    "id"=> 42,
                    "title"=> "Kajian Kastah Tahsin",
                    "date"=> "2025-12-21",
                    "category"=> "Tahsin",
                    "description"=> "Kajian Kastah untuk Tahsin",
                    "time"=> "Sepanjang Hari"
                ]
                ];


        return response()->json([
            'status' => 'success',
            'data' => $agenda
        ]);
    }
}
