<?php

use Illuminate\Support\Facades\Route;


Route::prefix('/hrd')->middleware('role:hrd')->group(function () {

    Route::get('/', [\App\Http\Controllers\HRD\HRDController::class, 'index'])->name('hrd.index');

    Route::get('/karyawan/data', [\App\Http\Controllers\HRD\KaryawanController::class, 'data'])->name('hrd.karyawan.data.index');
    Route::get('/karyawan/data/create', [\App\Http\Controllers\HRD\KaryawanController::class, 'data_create'])->name('hrd.karyawan.data.create');
    Route::post('/karyawan/data/store', [\App\Http\Controllers\HRD\KaryawanController::class, 'data_store'])->name('hrd.karyawan.data.store');
    Route::get('/karyawan/absensi', [\App\Http\Controllers\HRD\KaryawanController::class, 'absensi'])->name('hrd.karyawan.absensi.index');
    Route::get('/karyawan/cuti', [\App\Http\Controllers\HRD\KaryawanController::class, 'cuti'])->name('hrd.karyawan.cuti.index');
    Route::post('/karyawan/cuti/setujui/{id}', [\App\Http\Controllers\HRD\KaryawanController::class, 'cuti_setujui'])->name('hrd.karyawan.cuti.setujui');
    Route::post('/karyawan/cuti/tolak/{id}', [\App\Http\Controllers\HRD\KaryawanController::class, 'cuti_tolak'])->name('hrd.karyawan.cuti.tolak');
});
