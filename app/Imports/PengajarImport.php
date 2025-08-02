<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PengajarImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    private $unit;
    private $role;
    public function __construct($unit)
    {
        $this->unit = $unit;
        $data_unit = \App\Models\Modules\Unit::where('id', $unit)->first();
        $this->role = 'pengajar-'.$data_unit->slug;
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $user = \App\Models\User::firstOrCreate([
                'phone_number' => $row['nomor_handphone'],
            ], [
                'name' => $row['nama'],
                'email' => null,
                'phone_code' => '62',
                'code_access' => null,
                'code_access_max_date' => null,
                'password' => null,
            ]);

            \App\Models\Pengajar::firstOrCreate([
                'kode_nama_pengajar' => $row['pengajar'],
                'user_id' => $user->id,
                'unit_id' => $this->unit,
            ]);

            $user->assignRole($this->role);
        }
    }
}
