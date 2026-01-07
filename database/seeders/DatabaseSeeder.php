<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RolesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(DivisiSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(RoleAndPermission::class);

        $this->call(NotifikasiSeeder::class);
        $this->call(PeriodeKategoriSeeder::class);
        $this->call(RTQSeeder::class);
        // $this->call(ContohDataLTTQSeeder::class);

    }
}
