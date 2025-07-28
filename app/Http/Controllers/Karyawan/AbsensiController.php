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

        $today = Carbon::today('Asia/Makassar');
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
        $user = Auth::user();

        $bulan = $request->input('bulan'); // format: 01, 02, dst
        $tahun = $request->input('tahun'); // format: 2023

        $data = \App\Models\KaryawanAbsensi::where('user_id', $user->id)
            ->whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->created_at->format('Y-m-d') => $item->status];
            })
            ->toArray();

        return response()->json($data);
    }
    public function create()
    {
        return view('dashboard.karyawan.absensi.create',);
    }
    public function datang()
    {
        $user = Auth::user();
        $today = Carbon::today('Asia/Makassar');
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

        // Cek apakah sudah ada absensi datang hari ini
        $today = Carbon::now('Asia/Makassar')->startOfDay();
        $existingAbsensi = \App\Models\KaryawanAbsensi::where('user_id', $request->user_id)
                            ->whereDate('created_at', $today)
                            ->first();

        if ($existingAbsensi) {
            return redirect()->back()
                ->with('error', 'Anda sudah melakukan absensi datang hari ini')
                ->withInput();
        }

        $photoPath = null;

        if ($request->hasFile('photo')) {
            $manager = new ImageManager(new Driver());
            $userId = Auth::id();

            // Ambil tanggal sekarang dan formatnya
            $now = Carbon::now('Asia/Makassar');
            $tanggalFormatNama = $now->format('Ymd');

            // Nama file: userID-tanggal-datang.jpg
            $filename = "{$userId}-{$tanggalFormatNama}-datang.jpg";

            // Folder tujuan: absensi_photos/tahun/bulan/tanggal
            $yearFolder = $now->format('Y');
            $monthFolder = $now->format('m');
            $dayFolder = $now->format('d');
            $folder = "absensi_photos/{$yearFolder}/{$monthFolder}/{$dayFolder}";

            // Buat folder jika belum ada
            if (!Storage::exists("public/{$folder}")) {
                Storage::makeDirectory("public/{$folder}");
            }

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
                                            'latitude_datang' => $request->latitude ?? null,
                                            'longitude_datang' => $request->longitude ?? null,
                                        ];
        $absen->waktu_datang           = Carbon::now('Asia/Makassar');
        $absen->foto                   = [ 'datang' => $photoPath ?? null];
        $absen->status                 = $request->status;
        $absen->keterangan             = [ 'datang' => $request->keterangan ];
        $absen->created_at             = Carbon::now('Asia/Makassar');
        $absen->updated_at             = Carbon::now('Asia/Makassar');
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
        $user = Auth::user();
        $today = Carbon::today('Asia/Makassar');
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
            $now = Carbon::now('Asia/Makassar');
            $tanggalFormatNama = $now->format('Ymd');

            // Nama file: userID-tanggal-datang.jpg
            $filename = "{$userId}-{$tanggalFormatNama}-pulang.jpg";

            // Folder tujuan: absensi_photos/tahun/bulan/tanggal
            $yearFolder = $now->format('Y');
            $monthFolder = $now->format('m');
            $dayFolder = $now->format('d');
            $folder = "absensi_photos/{$yearFolder}/{$monthFolder}/{$dayFolder}";

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
            $absen->koordinat   =   array_merge($absen->koordinat ?? [], [
                                        'latitude_pulang'  => $request->latitude ?? null,
                                        'longitude_pulang' => $request->longitude ?? null,
                                    ]);
            $absen->waktu_pulang = Carbon::now('Asia/Makassar');
            $absen->foto         = array_merge($absen->foto ?? [], ['pulang' => $photoPath ?? null ]);
            $absen->updated_at   = Carbon::now('Asia/Makassar');

            $absen->save();
        }

        if ($absen) {
            session()->flash('success', 'Absen pulang berhasil disimpan!');
        } else {
            session()->flash('error', 'Gagal menyimpan absen pulang. Silakan coba lagi');
        }

        return redirect()->route('karyawan.absensi.index');
    }
    public function istirahat_mulai()
    {
        $user = Auth::user();
        $today = Carbon::today('Asia/Makassar');
        $absensi = \App\Models\KaryawanAbsensi::where('user_id', $user->id)
        ->whereDate('created_at', '>=', $today)
        ->first();

        if ($absensi && isset($absensi->keterangan['istirahat_mulai'])) {
            return redirect()->route('karyawan.absensi.index');
        }
        return view('dashboard.karyawan.absensi.istirahat-mulai',);
    }
    public function istirahat_mulai_store(Request $request)
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
            $now = Carbon::now('Asia/Makassar');
            $tanggalFormatNama = $now->format('Ymd');

            // Nama file: userID-tanggal-datang.jpg
            $filename = "{$userId}-{$tanggalFormatNama}-istirahat-mulai.jpg";

            // Folder tujuan: absensi_photos/tahun/bulan/tanggal
            $yearFolder = $now->format('Y');
            $monthFolder = $now->format('m');
            $dayFolder = $now->format('d');
            $folder = "absensi_photos/{$yearFolder}/{$monthFolder}/{$dayFolder}";

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
            $absen->koordinat = array_merge($absen->koordinat ?? [], [
                                    'latitude_istirahat_mulai'  => $request->latitude ?? null,
                                    'longitude_istirahat_mulai' => $request->longitude ?? null,
                                ]);
            $absen->keterangan = array_merge($absen->keterangan ?? [], ['istirahat_mulai' => Carbon::now('Asia/Makassar')]);
            $absen->foto       = array_merge($absen->foto ?? [], ['istirahat_mulai' => $photoPath ?? null ]);
            $absen->updated_at = Carbon::now('Asia/Makassar');

            $absen->save();
        }

        if ($absen) {
            session()->flash('success', 'Berhasil disimpan!');
        } else {
            session()->flash('error', 'Gagal. Silakan coba lagi');
        }

        return redirect()->route('karyawan.absensi.index');
    }
    public function istirahat_selesai()
    {
        $user = Auth::user();
        $today = Carbon::today('Asia/Makassar');
        $absensi = \App\Models\KaryawanAbsensi::where('user_id', $user->id)
        ->whereDate('created_at', '>=', $today)
        ->first();

        if ($absensi && isset($absensi->keterangan['istirahat_selesai'])) {
            return redirect()->route('karyawan.absensi.index');
        }
        return view('dashboard.karyawan.absensi.istirahat-selesai',);
    }
    public function istirahat_selesai_store(Request $request)
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
            $now = Carbon::now('Asia/Makassar');
            $tanggalFormatFolder = $now->format('d-m-Y');
            $tanggalFormatNama = $now->format('Ymd');

            // Nama file: userID-tanggal-datang.jpg
            $filename = "{$userId}-{$tanggalFormatNama}-istirahat-selesai.jpg";

            // Folder tujuan: absensi_photos/tahun/bulan/tanggal
            $yearFolder = $now->format('Y');
            $monthFolder = $now->format('m');
            $dayFolder = $now->format('d');
            $folder = "absensi_photos/{$yearFolder}/{$monthFolder}/{$dayFolder}";

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
            $absen->koordinat = array_merge($absen->koordinat ?? [], [
                                    'latitude_istirahat_selesai'  => $request->latitude ?? null,
                                    'longitude_istirahat_selesai' => $request->longitude ?? null,
                                ]);
            $absen->keterangan = array_merge($absen->keterangan ?? [], ['istirahat_selesai' => Carbon::now('Asia/Makassar')]);
            $absen->foto       = array_merge($absen->foto ?? [], ['istirahat_selesai' => $photoPath ?? null ]);
            $absen->updated_at = Carbon::now('Asia/Makassar');

            $absen->save();
        }

        if ($absen) {
            session()->flash('success', 'Berhasil disimpan!');
        } else {
            session()->flash('error', 'Gagal. Silakan coba lagi');
        }

        return redirect()->route('karyawan.absensi.index');
    }
}
