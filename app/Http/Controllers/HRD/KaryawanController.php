<?php

namespace App\Http\Controllers\HRD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\Facades\Toast;

class KaryawanController extends Controller
{

    public function data()
    {
        $karyawans =\App\Tables\HRD\DataKaryawan::class;

        return view('dashboard.hrd.karyawan.data', compact('karyawans'));
    }


    public function data_create()
    {
        $divisis = \App\Models\Modules\Divisi::selectRaw("id, nama")->get();
        $karyawans = \App\Models\User::selectRaw("id, concat(name, ' (', phone_number, ')') as name")->get();

        return view('dashboard.hrd.karyawan.data-create', compact('karyawans', 'divisis'));
    }

    public function data_store(Request $request)
    {

        $karyawan = \App\Models\Karyawan::where('user_id', $request->karyawans)->first();
        if ($karyawan) {
            $user = \App\Models\User::find($request->karyawans);
            Toast::warning("User dengan nama $user->name sudah terdaftar sebagai karyawan")->autoDismiss(5);
            return redirect()->back();
        }

        $user = \App\Models\User::find($request->karyawans);
        $user->assignRole('karyawan');

        \App\Models\Karyawan::create([
            'user_id' => $request->karyawans,
            'divisi_id' => $request->divisi,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nip' => $request->nip,
            'status_bekerja' => $request->status_bekerja,
        ]);


        return redirect()->route('hrd.karyawan.data.index')->with('success', 'Data berhasil di tambahkan');
    }

}

