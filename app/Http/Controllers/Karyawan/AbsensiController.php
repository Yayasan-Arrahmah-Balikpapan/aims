<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Splade;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\Facades\Toast;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $today = Carbon::today();
        $absensi = \App\Models\KaryawanAbsensi::where('user_id', $user->id)
            ->whereDate('created_at', '>=', $today)
            ->first();

        if (session('success')) { Toast::title(session('success')); }
        if (session('error')) { Toast::warning(session('error')); }

        return view('dashboard.karyawan.absensi.index', compact('absensi'));
    }

    // app/Http/Controllers/AbsensiController.php
    public function data(Request $request)
    {
        $bulan = $request->input('bulan'); // format: 01, 02, dst
        $tahun = $request->input('tahun'); // format: 2023

        $data = [
            "{$tahun}-{$bulan}-09" => 'hadir',
            "{$tahun}-{$bulan}-10" => 'izin',
            "{$tahun}-{$bulan}-12" => 'cuti',
        ];

        return response()->json($data);
    }
    public function create()
    {
        return view('dashboard.karyawan.absensi.create',);
    }

    public function datang()
    {
        $today = Carbon::today();
        $user = Auth::user();
        $absensi = \App\Models\KaryawanAbsensi::where('user_id', $user->id)
            ->whereDate('created_at', '>=', $today)
            ->first();

        if ($absensi) {
            return redirect()->route('karyawan.absensi.index');
        }

        return view('dashboard.karyawan.absensi.datang',);
    }
    public function datang_store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'time' => 'required',
            'user_id' => 'required|exists:users,id',
            'photo' => 'nullable|image'
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $manager = new ImageManager(new Driver());
            $userId = Auth::id();

            // Ambil tanggal sekarang dan formatnya
            $now = Carbon::now();
            $tanggalFormatFolder = $now->format('d-m-Y');
            $tanggalFormatNama = $now->format('Ymd');

            // Nama file: userID-tanggal-datang.jpg
            $filename = "{$userId}-{$tanggalFormatNama}-datang.jpg";

            // Folder tujuan
            $folder = "absensi_photos/{$tanggalFormatFolder}";

            // Buat gambar dengan kompresi
            $image = $manager->read($request->file('photo'))
                    ->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->toJpeg(70); // 70% quality JPEG

            // Simpan gambar ke storage
            Storage::put("public/{$folder}/{$filename}", $image);

            // Simpan path-nya ke database
            $photoPath = "{$folder}/{$filename}";
        }

        $absen                         = new \App\Models\KaryawanAbsensi();
        $absen->user_id                = $request->user_id;
        $absen->koordinat              = [
                                            'latitude' => $request->latitude ?? null,
                                            'longitude' => $request->longitude ?? null,
                                        ];
        $absen->waktu_datang           = Carbon::now('Asia/Makassar');
        $absen->foto                   = [ 'datang' => $photoPath ?? null];
        $absen->save();

        if ($absen) {
            session()->flash('success', 'Absen datang berhasil disimpan!');
        } else {
            session()->flash('error', 'Gagal menyimpan absen datang. Silakan coba lagi');
        }

        return redirect()->route('karyawan.absensi.index');
    }

    public function pulang()
    {
        $today = Carbon::today();
        $user = Auth::user();
        $absensi = \App\Models\KaryawanAbsensi::where('user_id', $user->id)
            ->whereDate('created_at', '>=', $today)
            ->first();

        if ($absensi && $absensi->waktu_pulang) {
            return redirect()->route('karyawan.absensi.index');
        }
        return view('dashboard.karyawan.absensi.pulang',);
    }
    public function pulang_store(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
            'time' => 'required',
            'user_id' => 'required|exists:users,id',
            'photo' => 'nullable|image'
        ]);

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $manager = new ImageManager(new Driver());
            $userId = Auth::id();

            // Ambil tanggal sekarang dan formatnya
            $now = Carbon::now();
            $tanggalFormatFolder = $now->format('d-m-Y');
            $tanggalFormatNama = $now->format('Ymd');

            // Nama file: userID-tanggal-datang.jpg
            $filename = "{$userId}-{$tanggalFormatNama}-pulang.jpg";

            // Folder tujuan
            $folder = "absensi_photos/{$tanggalFormatFolder}";

            // Buat gambar dengan kompresi
            $image = $manager->read($request->file('photo'))
                    ->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->toJpeg(70); // 70% quality JPEG

            // Simpan gambar ke storage
            Storage::put("public/{$folder}/{$filename}", $image);

            // Simpan path-nya ke database
            $photoPath = "{$folder}/{$filename}";
        }

        $absen = \App\Models\KaryawanAbsensi::where('user_id', $request->user_id)
            ->whereDate('created_at', Carbon::today())
            ->first();

        if ($absen) {
            $absen->koordinat = [
                'latitude' => $request->latitude ?? null,
                'longitude' => $request->longitude ?? null,
            ];
            $absen->waktu_pulang = Carbon::now('Asia/Makassar');
            $absen->foto =  ['pulang' => $photoPath ?? null ];
            $absen->save();
        }

        if ($absen) {
            session()->flash('success', 'Absen pulang berhasil disimpan!');
        } else {
            session()->flash('error', 'Gagal menyimpan absen pulang. Silakan coba lagi');
        }

        return redirect()->route('karyawan.absensi.index');
    }
}
