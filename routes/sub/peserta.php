<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/daftar-program', function () {
    return view('dashboard.peserta.daftar-program');
})->name('daftar-program');

Route::get('/daftar-program/tla', function () {
    return view('dashboard.peserta.daftar-program-tla');
})->name('daftar-program.tla');

Route::get('/daftar-program/tla/invoice', function () {
    return view('dashboard.peserta.daftar-program-tla-invoice');
})->name('daftar-program.tla.invoice');


Route::prefix('/peserta')->group(function () {

    Route::get('/{uuid}', [DashboardController::class, 'peserta'])->name('dashboard.peserta');

});

Route::get('/peserta/{peserta}/daftar-jadwal', [\App\Http\Controllers\Peserta\DaftarJadwalController::class, 'index'])->name('dashboard.peserta.daftar-jadwal');
Route::get('/peserta/{peserta}/daftar-jadwal/{jadwal}', [\App\Http\Controllers\Peserta\DaftarJadwalController::class, 'store'])->name('dashboard.peserta.daftar-jadwal.update');

Route::get('/agenda', [DashboardController::class, 'agenda'])->name('dashboard.peserta.agenda');
Route::get('/data', [DashboardController::class, 'peserta_data'])->name('dashboard.peserta.data');
Route::get('/riwayat-pembayaran', [DashboardController::class, 'peserta_riwayat_pembayaran'])->name('dashboard.peserta.riwayatpembayaran');
Route::get('/pembayaran/pilih-peserta', [\App\Http\Controllers\Peserta\PembayaranController::class, 'pembayaran_pilih_peserta'])->name('dashboard.peserta.pembayaran.pilih-peserta');
Route::get('/pembayaran/form/{uuid}', [\App\Http\Controllers\Peserta\PembayaranController::class, 'pembayaran_form'])->name('dashboard.peserta.pembayaran.form');
Route::post('/pembayaran/form/{uuid}', [\App\Http\Controllers\Peserta\PembayaranController::class, 'pembayaran_form_store'])->name('dashboard.peserta.pembayaran.form.store');
