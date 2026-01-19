<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/admin-ramadhan')->middleware('role:admin-ramadhan')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminRamadhan\AdminRamadhanController::class, 'index'])->name('admin-ramadhan.index');

    Route::get('/peserta-lomba', [App\Http\Controllers\AdminRamadhan\PesertaLombaRamadhanController::class, 'index'])->name('admin-ramadhan.peserta-lomba.index');
    Route::get('/transaksi-lomba', [App\Http\Controllers\AdminRamadhan\TransaksiLombaRamadhanController::class, 'index'])->name('admin-ramadhan.transaksi-lomba.index');
    Route::get('/transaksi-lomba/konfirmasi/{transaksi}', [App\Http\Controllers\AdminRamadhan\TransaksiLombaRamadhanController::class, 'konfirmasi'])->name('admin-ramadhan.transaksi-lomba.konfirmasi');

});
