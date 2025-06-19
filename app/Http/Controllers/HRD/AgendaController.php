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
use Illuminate\Support\Str;

class AgendaController extends Controller
{

    public function index()
    {
        $agendas = \App\Tables\HRD\DataAgenda::class;

        return view('dashboard.hrd.agenda.index', compact('agendas'));
    }


    public function store(Request $request)
    {
        $tanggal = Carbon::parse($request->tanggal);
        $slug = Str::slug($request->nama . '-' . $tanggal->format('mdY'));

        if ($request->jumlah_hari) {
            for ($i = 0; $i < $request->jumlah_hari; $i++) {
                $tanggalBaru = $tanggal->copy()->addDays($i);
                $slugBaru = Str::slug($request->nama . '-' . $tanggalBaru->format('mdY'));

                if (\App\Models\Agenda::where('slug', $slugBaru)->exists()) {
                    Toast::warning("Agenda dengan nama $request->nama sudah terdaftar untuk tanggal $tanggalBaru->format('d-m-Y')")->autoDismiss(5);
                    return redirect()->back();
                }

                \App\Models\Agenda::create([
                    'user_id' => Auth::id(),
                    'nama' => $request->nama,
                    'slug' => $slugBaru,
                    'tanggal' => $tanggalBaru,
                    'keterangan' => $request->keterangan,
                    'jenis' => $request->jenis,
                ]);
            }
        } else {
            if (\App\Models\Agenda::where('slug', $slug)->exists()) {
                Toast::warning("Agenda dengan nama $request->nama sudah terdaftar untuk tanggal $tanggal->format('d-m-Y')")->autoDismiss(5);
                return redirect()->back();
            }

            \App\Models\Agenda::create([
                'user_id' => Auth::id(),
                'nama' => $request->nama,
                'slug' => $slug,
                'tanggal' => $tanggal,
                'keterangan' => $request->keterangan,
                'jenis' => $request->jenis,
            ]);
        }

        Toast::success("Agenda berhasil ditambahkan")->autoDismiss(5);

        return redirect()->back();
    }


    public function destroy($id)
    {
        $agenda = \App\Models\Agenda::findOrFail($id);
        $agenda->delete();

        Toast::success("Agenda berhasil dihapus")->autoDismiss(5);

        return redirect()->back();
    }

}

