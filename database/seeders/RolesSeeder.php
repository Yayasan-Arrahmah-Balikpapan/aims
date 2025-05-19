<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'ketua-divisi-pendidikan']);
        Role::create(['name' => 'ketua-divisi-dkm']);
        Role::create(['name' => 'ketua-divisi-keuangan']);
        Role::create(['name' => 'ketua-divisi-fundraising']);

        Role::create(['name' => 'admin-tahsin']);
        Role::create(['name' => 'ketua-unit-tahsin']); // kepsek / mudir
        Role::create(['name' => 'penguji-tahsin']);
        Role::create(['name' => 'pengajar-tahsin']);  // atau musyrif

        Role::create(['name' => 'admin-rtq']);
        Role::create(['name' => 'ketua-unit-rtq']); // kepsek / mudir
        Role::create(['name' => 'penguji-rtq']);
        Role::create(['name' => 'pengajar-rtq']);  // atau musyrif

        Role::create(['name' => 'admin-tla']);
        Role::create(['name' => 'ketua-unit-tla']); // kepsek / mudir
        Role::create(['name' => 'penguji-tla']);
        Role::create(['name' => 'pengajar-tla']);  // atau musyrif

        Role::create(['name' => 'admin-rq']);
        Role::create(['name' => 'ketua-unit-rq']); // kepsek / mudir
        Role::create(['name' => 'penguji-rq']);
        Role::create(['name' => 'pengajar-rq']);  // atau musyrif

        Role::create(['name' => 'admin-tahla']);
        Role::create(['name' => 'ketua-unit-tahla']); // kepsek / mudir
        Role::create(['name' => 'penguji-tahla']);
        Role::create(['name' => 'pengajar-tahla']);  // atau musyrif

        Role::create(['name' => 'kasir']);
        Role::create(['name' => 'keuangan']);
        Role::create(['name' => 'pimpinan']);
        Role::create(['name' => 'dkm']);
        Role::create(['name' => 'laziz']);
        Role::create(['name' => 'mci']);
        Role::create(['name' => 'karyawan']);
        Role::create(['name' => 'hrd']);

        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'cms']);

    }
}
