<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/admin-ramadhan')->middleware('role:admin-ramadhan')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminRamadhan\AdminRamadhanController::class, 'index'])->name('admin-ramadhan.index');

    Route::get('/peserta-lomba', [App\Http\Controllers\AdminRamadhan\PesertaLombaRamadhanController::class, 'index'])->name('admin-ramadhan.peserta-lomba.index');
    Route::delete('/peserta-lomba/{peserta}', [App\Http\Controllers\AdminRamadhan\PesertaLombaRamadhanController::class, 'destroy'])->name('admin-ramadhan.peserta-lomba.destroy');
    Route::get('/peserta-lomba/export', [App\Http\Controllers\AdminRamadhan\PesertaLombaRamadhanController::class, 'export'])->name('admin-ramadhan.peserta-lomba.export');

    Route::get('/peserta-lomba/cabang/{cabang}', [App\Http\Controllers\AdminRamadhan\PesertaLombaRamadhanController::class, 'data_cabang_lomba'])->name('admin-ramadhan.peserta-lomba.data-cabang-lomba');


    Route::get('/transaksi-lomba', [App\Http\Controllers\AdminRamadhan\TransaksiLombaRamadhanController::class, 'index'])->name('admin-ramadhan.transaksi-lomba.index');
    Route::get('/transaksi-lomba/konfirmasi/{transaksi}', [App\Http\Controllers\AdminRamadhan\TransaksiLombaRamadhanController::class, 'konfirmasi'])->name('admin-ramadhan.transaksi-lomba.konfirmasi');
    Route::get('/transaksi-lomba/konfirmasi/{transaksi}/notif-pengingat-pembayaran', [App\Http\Controllers\AdminRamadhan\TransaksiLombaRamadhanController::class, 'notif_pengingat_pembayaran'])->name('admin-ramadhan.transaksi-lomba.notif-pengingat-pembayaran');
});
