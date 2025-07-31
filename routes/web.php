<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdminController;
use Illuminate\Support\Facades\Route;
use App\Domain\Website\Controllers\WebController;

    Route::get('/media-list', [\App\Http\Controllers\Api\MediaController::class, 'list']);

Route::get('/sandbox', function (){
    return view('sandbox');
});

Route::get('/veb', function (){
    return view('veb');
});

Route::get('/offline', function (){
    return view('offline');
});

Route::get('/serviceworker.js', function () {
    return response()
        ->view('sw')
        ->header('Content-Type', 'application/javascript');
});

Route::get("/lttq/tahsin/pendaftaran/rekaman", [WebController::class, "lttq_tahsin_pendaftaran_rekaman"])->name("website.lttq.tahsin.pendaftaran.rekaman");

Route::prefix('/dashboard/karyawan')->middleware('role:karyawan')->group(function () {
    Route::get('/absensi/datang', [\App\Http\Controllers\Karyawan\AbsensiController::class, 'datang'])->name('karyawan.absensi.datang');
    Route::post('/absensi/datang/store', [\App\Http\Controllers\Karyawan\AbsensiController::class, 'datang_store'])->name('karyawan.absensi.datang.store');
    Route::get('/absensi/pulang', [\App\Http\Controllers\Karyawan\AbsensiController::class, 'pulang'])->name('karyawan.absensi.pulang');
    Route::post('/absensi/pulang/store', [\App\Http\Controllers\Karyawan\AbsensiController::class, 'pulang_store'])->name('karyawan.absensi.pulang.store');
    Route::get('/absensi/istirahat-mulai', [\App\Http\Controllers\Karyawan\AbsensiController::class, 'istirahat_mulai'])->name('karyawan.absensi.istirahat-mulai');
    Route::post('/absensi/istirahat-mulai/store', [\App\Http\Controllers\Karyawan\AbsensiController::class, 'istirahat_mulai_store'])->name('karyawan.absensi.istirahat-mulai.store');
    Route::get('/absensi/istirahat-selesai', [\App\Http\Controllers\Karyawan\AbsensiController::class, 'istirahat_selesai'])->name('karyawan.absensi.istirahat-selesai');
    Route::post('/absensi/istirahat-selesai/store', [\App\Http\Controllers\Karyawan\AbsensiController::class, 'istirahat_selesai_store'])->name('karyawan.absensi.istirahat-selesai.store');

});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('splade')->group(function () {
    Route::get('/absen', function (){
        return view('absen');
    });

    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    // Route::get('/', function () {
    //     return view('welcome');
    // });

    // Route::middleware('auth.redirect')->group(function () {
    //     Route::get('/');
    // });

    Route::middleware('auth')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Route::get('/data', function(){
        //     return view('dashboard.peserta.data');
        // }
        // )->name('data');
        // Route::get('/riwayat-pembayaran', function(){
        //     return view('dashboard.peserta.riwayat-pembayaran');
        // }
        // )->name('riwayat-pembayaran');


        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::group(['prefix' => 'super-admin'], function () {
            require __DIR__.'/sub/super-admin.php';
        });

        Route::group(['prefix' => 'dashboard'], function () {
            require __DIR__.'/sub/ketua-divisi.php';
            require __DIR__.'/sub/ketua-unit.php';
            require __DIR__.'/sub/admin.php';
            require __DIR__.'/sub/pengajar.php';
            require __DIR__.'/sub/penguji.php';
            require __DIR__.'/sub/peserta.php';
            require __DIR__.'/sub/kasir.php';
            require __DIR__.'/sub/keuangan.php';
            require __DIR__.'/sub/pimpinan.php';
            require __DIR__.'/sub/karyawan.php';
            require __DIR__.'/sub/hrd.php';
        });
    });

    Route::get('/phpmyinfo', function () {
        phpinfo();
    })->name('phpmyinfo');

    require __DIR__.'/auth.php';

    # Routing Website Utama Non Auth
    require __DIR__.'/sub/website.php';
});
