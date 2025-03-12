<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ProtoneMedia\Splade\Facades\Toast;

class PengajarController extends Controller
{
    private function getPengajarClass($unit)
    {
        if ($unit == 'tahsin') {
            return \App\Tables\Admin\PengajarTahsin::class;
        } else {
            return \App\Tables\Pengajars::class;
        }
    }
    public function index($unit)
    {
        $pengajar = $this->getPengajarClass($unit);
        return view('dashboard.admin.pengajar.index', compact('unit', 'pengajar'));
    }

    public function create($unit)
    {
        $pengajars = \App\Models\User::selectRaw("id, concat(name, ' (', phone_number, ')') as name")
            ->get();
        return view('dashboard.admin.pengajar.create', compact('unit','pengajars'));
    }

    public function store(Request $request, $unit)
    {
        $id_unit = \App\Models\Modules\Unit::where('slug', $unit)->first()->id;
        $errors = [];
        DB::beginTransaction();
        try {
            $pengajars = $request->pengajars;
            // foreach ($pengajars as $pengajarId) {
            //     $pengajar = \App\Models\Pengajar::where('user_id', $pengajarId)->where('unit_id', $id_unit)->first();
            //     if ($pengajar) {
            //         $user = \App\Models\User::find($pengajarId);
            //         $errors[] = "User dengan nama $user->name sudah terdaftar sebagai pengajar di unit $unit";
            //         continue;
            //     }
            //     \App\Models\Pengajar::create(['user_id' => $pengajarId, 'unit_id' => $id_unit, 'kode_nama_pengajar' => $request->kode_nama_pengajar]);
            // }

            if ($request->pengajars) {
                $pengajar_a = \App\Models\Pengajar::where('user_id', $request->pengajars)->where('unit_id', $id_unit)->first();
                if ($pengajar_a) {
                    $user = \App\Models\User::find($request->pengajars);
                    Toast::warning("User dengan nama $user->name sudah terdaftar sebagai pengajar di unit $unit")->autoDismiss(5);
                    return redirect()->back();
                }
            }
            $pengajar_b = \App\Models\Pengajar::where('kode_nama_pengajar', $request->kode_nama_pengajar)->where('unit_id', $id_unit)->first();
            if ($pengajar_b) {
                Toast::warning("Pengajar $request->kode_nama_pengajar sudah terdaftar sebagai pengajar di unit $unit")->autoDismiss(5);
                return redirect()->back();
            }
            \App\Models\Pengajar::create(['user_id' => $request->pengajars ?? null, 'unit_id' => $id_unit, 'kode_nama_pengajar' => $request->kode_nama_pengajar]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Toast::warning('Terjadi kesalahan, data gagal di tambahkan')->autoDismiss(5);
        }

        if (count($errors) > 0) {
            $msg = implode('<br>', $errors);
            Toast::warning($msg)->autoDismiss(5);
        } else {
            Toast::message('Data berhasil di tambahkan')->autoDismiss(10);
        }

        return redirect()->route('admin.pengajar.index', $unit);
    }

    public function show($unit, $pengajar)
    {
        $pengajars = \App\Models\User::selectRaw("id, concat(name, ' (', phone_number, ')') as name")
            ->get();
        $pengajar = \App\Models\Pengajar::find($pengajar);

        return view('dashboard.admin.pengajar.show', compact('unit','pengajars', 'pengajar'));
    }

    public function update(Request $request, $unit, $pengajar)
    {
        $id_unit = \App\Models\Modules\Unit::where('slug', $unit)->first()->id;
        $errors = [];
        DB::beginTransaction();
        try {

            if ($request->pengajars) {
                $pengajar_a = \App\Models\Pengajar::where('user_id', $request->pengajars)
                                ->where('unit_id', $id_unit)
                                ->where('id', '!=', $pengajar)
                                ->first();
                if ($pengajar_a) {
                    $user = \App\Models\User::find($request->pengajars);
                    Toast::warning("User dengan nama $user->name sudah terdaftar sebagai pengajar di unit $unit")->autoDismiss(5);
                    return redirect()->back();
                }
            }
            $pengajar_b = \App\Models\Pengajar::where('kode_nama_pengajar', $request->kode_nama_pengajar)
                ->where('unit_id', $id_unit)
                ->where('id', '!=', $pengajar)
                ->first();
            if ($pengajar_b) {
                Toast::warning("Pengajar $request->kode_nama_pengajar sudah terdaftar sebagai pengajar di unit $unit")->autoDismiss(5);
                return redirect()->back();
            }
            $pengajarToUpdate = \App\Models\Pengajar::findOrFail($pengajar);
            $pengajarToUpdate->update([
                'user_id' => $request->pengajars ?? null,
                'kode_nama_pengajar' => $request->kode_nama_pengajar
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Toast::warning('Terjadi kesalahan')->autoDismiss(5);
        }

        if (count($errors) > 0) {
            $msg = implode('<br>', $errors);
            Toast::warning($msg)->autoDismiss(5);
        } else {
            Toast::message('Data berhasil di perbaruhi')->autoDismiss(10);
        }

        return redirect()->back();
    }
}
