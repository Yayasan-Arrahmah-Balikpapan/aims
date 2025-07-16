<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PeriodeKategori;

class PeriodeKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PeriodeKategori::create(['nama' => 'REGULER', 'slug' => 'reguler', 'keterangan' => 'reguler']);
        PeriodeKategori::create(['nama' => 'EKSKLUSIF', 'slug' => 'eksklusif', 'keterangan' => 'eksklusif']);
    }
}
