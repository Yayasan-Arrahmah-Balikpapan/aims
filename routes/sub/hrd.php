<?php

use Illuminate\Support\Facades\Route;


Route::prefix('/hrd')->middleware('role:hrd')->group(function () {

    Route::get('/', [\App\Http\Controllers\HRD\HRDController::class, 'index'])->name('hrd.index');

    Route::get('/karyawan/data', [\App\Http\Controllers\HRD\KaryawanController::class, 'data'])->name('hrd.karyawan.data.index');
    Route::get('/karyawan/data/create', [\App\Http\Controllers\HRD\KaryawanController::class, 'data_create'])->name('hrd.karyawan.data.create');
    Route::post('/karyawan/data/store', [\App\Http\Controllers\HRD\KaryawanController::class, 'data_store'])->name('hrd.karyawan.data.store');

    Route::get('/karyawan/absensi', [\App\Http\Controllers\HRD\AbsensiKaryawanController::class, 'absensi'])->name('hrd.karyawan.absensi.index');
    Route::get('/karyawan/hari-libur/create', [\App\Http\Controllers\HRD\AbsensiKaryawanController::class, 'hari_libur_create'])->name('hrd.karyawan.hari_libur_create');
    Route::post('/karyawan/hari-libur/store', [\App\Http\Controllers\HRD\AbsensiKaryawanController::class, 'hari_libur_store'])->name('hrd.karyawan.hari_libur_store');
    Route::delete('/karyawan/hari-libur/delete', [\App\Http\Controllers\HRD\AbsensiKaryawanController::class, 'hari_libur_delete'])->name('hrd.karyawan.hari_libur_delete');

    Route::get('/karyawan/cuti', [\App\Http\Controllers\HRD\CutiKaryawanController::class, 'cuti'])->name('hrd.karyawan.cuti.index');
    Route::post('/karyawan/cuti/setujui/{id}', [\App\Http\Controllers\HRD\CutiKaryawanController::class, 'cuti_setujui'])->name('hrd.karyawan.cuti.setujui');
    Route::post('/karyawan/cuti/tolak/{id}', [\App\Http\Controllers\HRD\CutiKaryawanController::class, 'cuti_tolak'])->name('hrd.karyawan.cuti.tolak');

    Route::get('/agenda', [\App\Http\Controllers\HRD\AgendaController::class, 'index'])->name('hrd.agenda.index');
    Route::post('/agenda/store', [\App\Http\Controllers\HRD\AgendaController::class, 'store'])->name('hrd.agenda.store');
    Route::delete('/agenda/delete', [\App\Http\Controllers\HRD\AgendaController::class, 'delete'])->name('hrd.agenda.delete');

});
