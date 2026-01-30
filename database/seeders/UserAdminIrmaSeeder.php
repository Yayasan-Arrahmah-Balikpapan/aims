<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Carbon;

class UserAdminIrmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'         => 'Admin IRMA 1',
                'email'        => 'admin.irma.ilham@arrahmahbalikpapan.or.id',
                'phone_number' => '085387432115',
                'role'         => 'admin-irma',
            ],
            [
                'name'         => 'Admin IRMA 2',
                'email'        => 'admin.irma.rafly@arrahmahbalikpapan.or.id',
                'phone_number' => '081255939822',
                'role'         => 'admin-irma',
            ],
        ];

        foreach ($users as $userData) {
            // Buat User
            $user = User::create([
                'name'                 => $userData['name'],
                'email'                => $userData['email'],
                'phone_code'           => '62',
                'phone_number'         => $userData['phone_number'],
                'code_access'          => '1234',
                'code_access_max_date' => Carbon::now()->addHour(),
                'password'             => bcrypt('password'),
            ]);

            $user->assignRole($userData['role']);
        }
    }
}
