<?php

use Illuminate\Support\Facades\Route;


Route::prefix('/karyawan')->middleware('role:karyawan')->group(function () {

    Route::get('/', [\App\Http\Controllers\Karyawan\KaryawanController::class, 'index'])->name('karyawan.index');

    Route::get('/absensi', [\App\Http\Controllers\Karyawan\AbsensiController::class, 'index'])->name('karyawan.absensi.index');
    Route::get('/absensi/data', [\App\Http\Controllers\Karyawan\AbsensiController::class, 'data'])->name('karyawan.absensi.data');
    Route::get('/absensi/create', [\App\Http\Controllers\Karyawan\AbsensiController::class, 'create'])->name('karyawan.absensi.create');

    Route::get('/cuti', [\App\Http\Controllers\Karyawan\CutiController::class, 'index'])->name('karyawan.cuti.index');
    Route::get('/cuti/create', [\App\Http\Controllers\Karyawan\CutiController::class, 'create'])->name('karyawan.cuti.create');
    Route::post('/cuti/store', [\App\Http\Controllers\Karyawan\CutiController::class, 'store'])->name('karyawan.cuti.store');
    Route::delete('/cuti/{id}', [\App\Http\Controllers\Karyawan\CutiController::class, 'destroy'])->name('karyawan.cuti.destroy');

    Route::get('/akun', [\App\Http\Controllers\Karyawan\AkunController::class, 'index'])->name('karyawan.akun.index');
    Route::patch('/akun/update', [\App\Http\Controllers\Karyawan\AkunController::class, 'update'])->name('karyawan.akun.update');

    Route::get('/notifikasi', [\App\Http\Controllers\Karyawan\NotifikasiController::class, 'index'])->name('karyawan.notifikasi.index');
});
