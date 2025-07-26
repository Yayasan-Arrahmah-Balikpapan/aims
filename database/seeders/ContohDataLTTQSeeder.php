<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Carbon;
use App\Models\Periode;
use Illuminate\Support\Str;

class ContohDataLTTQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'                 => 'Peserta Tahsin Ikhwan',
                'email'                => 'tahsin.ikhwan@arrahmahbalikpapan.or.id',
                'phone_code'           => '62',
                'phone_number'         => '08111111111',
                'code_access'          => '5555',
                'code_access_max_date' => Carbon::now()->addHour(),
                'password'             => bcrypt('5555'),
            ],
            [
                'name'                 => 'Peserta Tahsin Akhwat',
                'email'                => 'tahsin.akhwat@arrahmahbalikpapan.or.id',
                'phone_code'           => '62',
                'phone_number'         => '08122222222',
                'code_access'          => '5555',
                'code_access_max_date' => Carbon::now()->addHour(),
                'password'             => bcrypt('5555'),
            ],
            [
                'name'                 => 'Peserta RQ',
                'email'                => 'rq@arrahmahbalikpapan.or.id',
                'phone_code'           => '62',
                'phone_number'         => '08133333333',
                'code_access'          => '5555',
                'code_access_max_date' => Carbon::now()->addHour(),
                'password'             => bcrypt('5555'),
            ],
            [
                'name'                 => 'Peserta TLA',
                'email'                => 'tla@arrahmahbalikpapan.or.id',
                'phone_code'           => '62',
                'phone_number'         => '08144444444',
                'code_access'          => '5555',
                'code_access_max_date' => Carbon::now()->addHour(),
                'password'             => bcrypt('5555'),
            ],
            [
                'name'                 => 'Peserta RTQ',
                'email'                => 'rtq@arrahmahbalikpapan.or.id',
                'phone_code'           => '62',
                'phone_number'         => '08155555555',
                'code_access'          => '5555',
                'code_access_max_date' => Carbon::now()->addHour(),
                'password'             => bcrypt('5555'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        for ($i = 1; $i <= 5; $i++) {
            $periode = Periode::create([
                'unit_id'              => $i,
                'nama'                 => "Periode {$i}",
                'slug'                 => Str::slug("Periode {$i}"),
                'aktifkan_pendaftaran' => rand(0,1),
                'tahun_ajaran'         => now()->year,
                'waktu_start'          => now()->addDays(rand(1,30)),
                'waktu_end'            => now()->addDays(rand(31,60)),
                'angkatan'             => rand(1,10),

                'form_biodata_daftar'  => json_encode([]),
                'format_nilai'         => json_encode([]),
                'format_rapot'         => json_encode([]),
                'format_absensi'       => json_encode([]),
                'format_pembayaran'    => json_encode([]),
            ]);
        }


    }
}
