<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin-tahsin'       => ['pendidikan', 'admin', 'tahsin', 'create', 'read', 'update', 'delete'],
            'ketua-unit-tahsin'  => ['pendidikan', 'ketua-unit', 'tahsin', 'read'],
            'penguji-tahsin'     => ['pendidikan', 'penguji','tahsin', 'read'],
            'pengajar-tahsin'    => ['pendidikan', 'pengajar','tahsin', 'read'],

            'admin-rtq'          => ['pendidikan', 'admin', 'rtq', 'create', 'read', 'update', 'delete'],
            'ketua-unit-rtq'     => ['pendidikan', 'ketua-unit', 'rtq', 'read'],
            'penguji-rtq'        => ['pendidikan', 'penguji','rtq', 'read'],
            'pengajar-rtq'       => ['pendidikan', 'pengajar','rtq', 'read'],

            'admin-tla'          => ['pendidikan', 'admin', 'tla', 'create', 'read', 'update', 'delete'],
            'ketua-unit-tla'     => ['pendidikan', 'ketua-unit', 'tla', 'read'],
            'penguji-tla'        => ['pendidikan', 'penguji','tla', 'read'],
            'pengajar-tla'       => ['pendidikan', 'pengajar','tla', 'read'],

            'admin-rq'           => ['pendidikan', 'admin', 'rq', 'create', 'read', 'update', 'delete'],
            'ketua-unit-rq'      => ['pendidikan', 'ketua-unit', 'rq', 'read'],
            'penguji-rq'         => ['pendidikan', 'penguji','rq', 'read'],
            'pengajar-rq'        => ['pendidikan', 'pengajar','rq', 'read'],

            'admin-tahla'        => ['pendidikan', 'admin', 'tahla', 'create', 'read', 'update', 'delete'],
            'ketua-unit-tahla'   => ['pendidikan', 'ketua-unit', 'tahla', 'read'],
            'penguji-tahla'      => ['pendidikan', 'penguji','tahla', 'read'],
            'pengajar-tahla'     => ['pendidikan', 'pengajar','tahla', 'read'],

            'kasir'    => ['kasir'],
            'keuangan' => ['keuangan'],
            'dkm'      => ['dkm'],
            'laziz'    => ['laziz'],
            'mci'      => ['mci'],
            'karyawan' => ['karyawan'],
            'hrd'      => ['hrd'],

            'ketua-divisi-pendidikan' => ['pendidikan', 'rtq', 'tahsin', 'rq', 'tla', 'tahla', 'read'],
            'ketua-divisi-dkm'        => ['dkm', 'read'],
            'ketua-divisi-keuangan'   => ['keuangan', 'read'],
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            foreach ($permissions as $permissionName) {
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                $role->givePermissionTo($permission);
            }
        }
    }
}
