<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Modules\Unit;


class RTQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin-rtq-putra'          => ['pendidikan', 'admin', 'rtq-putra', 'create', 'read', 'update', 'delete'],
            'ketua-unit-rtq-putra'     => ['pendidikan', 'ketua-unit', 'rtq-putra', 'read'],
            'penguji-rtq-putra'        => ['pendidikan', 'penguji','rtq-putra', 'read'],
            'pengajar-rtq-putra'       => ['pendidikan', 'pengajar','rtq-putra', 'read'],

            'admin-rtq-putri'          => ['pendidikan', 'admin', 'rtq-putri', 'create', 'read', 'update', 'delete'],
            'ketua-unit-rtq-putri'     => ['pendidikan', 'ketua-unit', 'rtq-putri', 'read'],
            'penguji-rtq-putri'        => ['pendidikan', 'penguji','rtq-putri', 'read'],
            'pengajar-rtq-putri'       => ['pendidikan', 'pengajar','rtq-putri', 'read'],
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            foreach ($permissions as $permissionName) {
                $permission = Permission::firstOrCreate(['name' => $permissionName]);
                $role->givePermissionTo($permission);
            }
        }

        Unit::create([
                'id'        => 8,
                'nama'      => 'Rumah Tahfizhil Qur\'an Putra',
                'slug'      => 'rtq-putra',
                'divisi_id' => 1,
            ]);

        Unit::create([
                'id'        => 9,
                'nama'      => 'Rumah Tahfizhil Qur\'an Putri',
                'slug'      => 'rtq-putri',
                'divisi_id' => 1,
            ]);
    }
}
