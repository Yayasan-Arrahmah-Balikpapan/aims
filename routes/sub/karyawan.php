<?php

use Illuminate\Support\Facades\Route;


Route::prefix('/karyawan')->middleware('role:karyawan')->group(function () {

    Route::get('/', [\App\Http\Controllers\Karyawan\KaryawanController::class, 'index'])->name('karyawan.index');

    Route::get('/absensi', [\App\Http\Controllers\Karyawan\AbsensiController::class, 'index'])->name('karyawan.absensi.index');
    Route::get('/absensi/data', [\App\Http\Controllers\Karyawan\AbsensiController::class, 'data'])->name('karyawan.absensi.data');
    Route::get('/absensi/create', [\App\Http\Controllers\Karyawan\AbsensiController::class, 'create'])->name('karyawan.absensi.create');

});
