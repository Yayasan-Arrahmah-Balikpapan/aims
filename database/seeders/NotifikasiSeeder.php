<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotifikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pesanWhatsappList = [
            'pendaftaran-baru' => "📌 *Pendaftaran Berhasil*

Assalamu'alaikum {Nama},
Terima kasih telah mendaftar di *{Unit} {Angkatan}*. Data Anda sudah kami terima.
Silakan tunggu informasi selanjutnya, atau hubungi admin jika ada pertanyaan.

Barakallahu fiikum.
Yayasan Ar Rahmah Balikpapan",

            'pendaftar-lanjutan' => "📌 *Daftar Ulang*

Assalamu'alaikum {Nama},
Alhamdulillah, Anda telah berhasil mendaftar kembali, terima kasih atas kepercayaannya.
Semoga Allah mudahkan proses belajar Anda di *{Unit} {Angkatan}*. Nantikan jadwal dan informasi berikutnya.

Yayasan Ar Rahmah Balikpapan",

            'mendapatkan-level' => "🏆 *Penempatan Level*

Assalamu'alaikum,

Peserta: *{Nama}*
Anda telah mendapatkan level : *{Level Baru}*.

Masuk ke dashboard dan lanjutan untuk pemilihan. Pilih secepatnya sebelum kuota penuh ya.
https://arrahmahbalikpapan.or.id/akses

Yayasan Ar Rahmah Balikpapan",

            'pengingat-pilih-jadwal' => "⏰ *Pengingat Pemilihan Jadwal*

Assalamu'alaikum {Nama},
Jangan lupa untuk memilih jadwal kelas Anda di *{Unit} {Angkatan}*. Pilih jadwal secepatnya sebelum kuota penuh ya.

https://arrahmahbalikpapan.or.id/akses

Yayasan Ar Rahmah Balikpapan",

            'mendapatkan-jadwal' => "🗓️ *Jadwal Telah Diplih*

Assalamu'alaikum, berikut kami informasikan jadwal kelas Anda di *{Unit} {Angkatan}*:

Peserta: *{Nama}*
Jadwal: *{Jadwal}*

Silakan persiapkan diri dengan baik. Semoga Allah memberkahi ilmu dan harta Anda.

Yayasan Ar Rahmah Balikpapan",

            'pengingat-pembayaran' => "💳 *Pengingat Pembayaran*

Assalamu'alaikum {Nama},
Ini adalah pengingat untuk menyelesaikan pembayaran program *{Unit} {Angkatan}*.

Silakan proses pembayaran melalui dashboard anda.
https://arrahmahbalikpapan.or.id/akses

Yayasan Ar Rahmah Balikpapan",

            'selesai-pembayaran' => "✅ *Pembayaran Berhasil*

Assalamu'alaikum {Nama},
Pembayaran Anda untuk program *{Unit} {Angkatan}* telah kami terima. Semoga Allah memberkahi ilmu dan harta Anda.

Yayasan Ar Rahmah Balikpapan",

            'selesai-ujian' => "🎓 *Ujian Telah Selesai*

Assalamu'alaikum {Nama},
Anda telah menyelesaikan ujian untuk *{Unit} {Angkatan}*. Terima kasih atas partisipasinya. InsyaAllah hasil ujian akan segera diumumkan.

Semoga mendapatkan hasil terbaik!

Yayasan Ar Rahmah Balikpapan",

            'tambahan-1' => "📌 *Notifikasi Tambahan 1*",

            'tambahan-2' => "📌 *Notifikasi Tambahan 2*",

            'tambahan-3' => "📌 *Notifikasi Tambahan 3*",
        ];

        for ($unit = 1; $unit <= 5; $unit++) {
            foreach ($pesanWhatsappList as $slug => $pesan) {
                DB::table('notifikasis')->insert([
                    'divisi_id' => 1,
                    'unit_id' => $unit,
                    'slug' => $slug,
                    'nama' => ucwords(str_replace('-', ' ', $slug)),
                    'pesan_whatsapp' => $pesan,
                    'pesan_email' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
