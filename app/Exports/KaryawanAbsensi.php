<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;

class KaryawanAbsensi implements FromView
{
    protected $users;
    protected $bulan;
    protected $tahun;

    public function __construct($users, $bulan, $tahun)
    {
        $this->users = $users;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        $users = User::with(['karyawan_absensi' => function ($query) {
            $query->whereMonth('waktu_datang', $this->bulan)
                  ->whereYear('waktu_datang', $this->tahun);
        }])->get();

        return view('dashboard.hrd.karyawan.export-karyawan-absensi', [
            'users' => $this->users,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
        ]);
    }
}
