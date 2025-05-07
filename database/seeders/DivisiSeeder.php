<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modules\Divisi;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Divisi::create([
                'id'   => 1,
                'nama' => 'Pendidikan',
                'slug' => 'pendidikan',
        ]);
        Divisi::create([
                'id'   => 2,
                'nama' => 'Keuangan',
                'slug' => 'keuangan',
        ]);
        Divisi::create([
                'id'   => 3,
                'nama' => 'DKM',
                'slug' => 'dkm',
        ]);
        Divisi::create([
                'id'   => 4,
                'nama' => 'HRD',
                'slug' => 'hrd',
        ]);
        Divisi::create([
                'id'   => 5,
                'nama' => 'KARYAWAN',
                'slug' => 'karyawan',
        ]);
    }
}
