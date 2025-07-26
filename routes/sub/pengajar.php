<?php

use Illuminate\Support\Facades\Route;
Route::prefix('/pengajar/{unit}')->middleware('role:pengajar-tahsin|pengajar-rtq|pengajar-tla|pengajar-rq|pengajar-tahla')->group(function () {


    Route::get('/', [App\Http\Controllers\Pengajar\DashboardController::class, 'index'])->name('pengajar.index');

    Route::get('/jadwal', [App\Http\Controllers\Pengajar\JadwalController::class, 'index'])->name('pengajar.jadwal.index');
    Route::get('/jadwal/{periode}/data', [App\Http\Controllers\Pengajar\JadwalController::class, 'data'])->name('pengajar.jadwal.data');
    Route::get('/jadwal/{periode}/data/{kelas}', [App\Http\Controllers\Pengajar\JadwalController::class, 'data_kelas'])->name('pengajar.jadwal.data.kelas');

    Route::get('/absensi', [App\Http\Controllers\Pengajar\AbsensiController::class, 'index'])->name('pengajar.absensi.index');
    Route::get('/absensi/{periode}/data', [App\Http\Controllers\Pengajar\AbsensiController::class, 'data'])->name('pengajar.absensi.data');
    Route::get('/absensi/{periode}/data/{kelas}', [App\Http\Controllers\Pengajar\AbsensiController::class, 'data_kelas'])->name('pengajar.absensi.data.kelas');
    Route::post('/absensi/{periode}/data/{kelas}', [App\Http\Controllers\Pengajar\AbsensiController::class, 'data_kelas_store'])->name('pengajar.absensi.data.kelas.store');

    Route::get('/peserta', [App\Http\Controllers\Pengajar\PesertaController::class, 'index'])->name('pengajar.peserta.index');
    Route::get('/peserta/{peserta}', [App\Http\Controllers\Pengajar\PesertaController::class, 'show'])->name('pengajar.peserta.show');

    Route::get('/pengaturan', [App\Http\Controllers\Pengajar\PengaturanController::class, 'index'])->name('pengajar.pengaturan.index');
    Route::put('/pengaturan/{pengaturan}', [App\Http\Controllers\Pengajar\PengaturanController::class, 'update'])->name('pengajar.pengaturan.update');
    Route::delete('/pengaturan/{pengaturan}', [App\Http\Controllers\Pengajar\PengaturanController::class, 'destroy'])->name('pengajar.pengaturan.destroy');

    Route::get('/notifikasi', [App\Http\Controllers\Pengajar\NotifikasiController::class, 'index'])->name('pengajar.notifikasi.index');

    Route::get('/akun/', [App\Http\Controllers\Pengajar\AkunController::class, 'index'])->name('pengajar.akun.index');
    Route::post('/akun/', [App\Http\Controllers\Pengajar\AkunController::class, 'update'])->name('pengajar.akun.update');

});
