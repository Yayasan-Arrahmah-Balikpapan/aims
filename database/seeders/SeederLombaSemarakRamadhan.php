<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SeederLombaSemarakRamadhan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\LombaEvent::create([
            'id'        => 1,
            'nama' => 'Semarak Ramadhan 1447H',
            'slug' => 'semarak-ramadhan-1447h',
            'deskripsi' => 'Lomba Semarak Ramadhan 1447H di Masjid Arrahmah',
            'tanggal_mulai' => '2026-02-12',
            'tanggal_selesai' => '2026-03-10',
            'status'    => 'OPEN',
        ]);

        \App\Models\LombaCabang::create([
            'id' => 1,
            'event_id' => 1,
            'nama' => 'LOMBA MENGGAMBAR & MEWARNAI A',
            'deskripsi' => 'Anak Usia 4-6 Tahun - Mewarnai',
            'biaya_pendaftaran' => 50000,
            'slug' => Str::slug('LOMBA MENGGAMBAR & MEWARNAI A'),
        ]);
        \App\Models\LombaCabang::create([
            'id' => 2,
            'event_id' => 1,
            'nama' => 'LOMBA MENGGAMBAR & MEWARNAI B',
            'deskripsi' => 'Anak Usia 7-10 Tahun - Menggambar & Mewarnai ',
            'biaya_pendaftaran' => 50000,
            'slug' => Str::slug('LOMBA MENGGAMBAR & MEWARNAI B'),
        ]);
        \App\Models\LombaCabang::create([
            'id' => 3,
            'event_id' => 1,
            'nama' => 'LOMBA ADZAN & IQOMAH A',
            'deskripsi' => 'Anak Usia 5-8 Tahun',
            'biaya_pendaftaran' => 50000,
            'slug' => Str::slug('LOMBA ADZAN & IQOMAH A'),
        ]);
        \App\Models\LombaCabang::create([
            'id' => 4,
            'event_id' => 1,
            'nama' => 'LOMBA ADZAN & IQOMAH B',
            'deskripsi' => 'Anak Usia 9-12 Tahun',
            'biaya_pendaftaran' => 50000,
            'slug' => Str::slug('LOMBA ADZAN & IQOMAH B'),
        ]);
        \App\Models\LombaCabang::create([
            'id' => 5,
            'event_id' => 1,
            'nama' => 'LOMBA ADZAN & IQOMAH C',
            'deskripsi' => 'Anak Usia 13-15 Tahun',
            'biaya_pendaftaran' => 50000,
            'slug' => Str::slug('LOMBA ADZAN & IQOMAH C'),
        ]);
        \App\Models\LombaCabang::create([
            'id' => 6,
            'event_id' => 1,
            'nama' => 'LOMBA TAHFIDZ A',
            'deskripsi' => 'Anak Usia 3-6 Tahun',
            'biaya_pendaftaran' => 50000,
            'slug' => Str::slug('LOMBA TAHFIDZ A'),
        ]);
        \App\Models\LombaCabang::create([
            'id' => 7,
            'event_id' => 1,
            'nama' => 'LOMBA TAHFIDZ B',
            'deskripsi' => 'Anak Usia 7-10 Tahun',
            'biaya_pendaftaran' => 50000,
            'slug' => Str::slug('LOMBA TAHFIDZ B'),
        ]);
        \App\Models\LombaCabang::create([
            'id' => 8,
            'event_id' => 1,
            'nama' => 'LOMBA TAHFIDZ C',
            'deskripsi' => 'Anak Usia 11-15 Tahun',
            'biaya_pendaftaran' => 50000,
            'slug' => Str::slug('LOMBA TAHFIDZ C'),
        ]);
        \App\Models\LombaCabang::create([
            'id' => 9,
            'event_id' => 1,
            'nama' => 'LOMBA CERDAS CERMAT SD',
            'deskripsi' => 'Kategori SD Kelas 4-6 ',
            'biaya_pendaftaran' => 100000,
            'slug' => Str::slug('LOMBA CERDAS CERMAT SD'),
        ]);
        \App\Models\LombaCabang::create([
            'id' => 10,
            'event_id' => 1,
            'nama' => 'LOMBA CERDAS CERMAT SMP',
            'deskripsi' => 'Kategori SMP Kelas 7-9 ',
            'biaya_pendaftaran' => 100000,
            'slug' => Str::slug('LOMBA CERDAS CERMAT SMP'),
        ]);

    }
}
