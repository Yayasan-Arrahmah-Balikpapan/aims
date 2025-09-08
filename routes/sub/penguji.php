<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Penguji\PesertaController as PengujiPesertaController;
// use App\Http\Controllers\Penguji\PesertaBaruController as PengujiPesertaBaruController;
// use App\Http\Controllers\Penguji\DashboardController as PengujiDashboardController;
// use App\Http\Controllers\Penguji\JadwalController as PengujiJadwalController;

Route::prefix('/penguji/{unit}')->middleware('role:penguji-tahsin|penguji-rtq|penguji-tla|penguji-rq|penguji-tahla')->group(function () {

    // Route::get('/peserta', [App\Http\Controllers\Penguji\PesertaController::class, 'index'])->name('penguji.peserta.index');
    // Route::get('/peserta/create', [App\Http\Controllers\Penguji\PesertaController::class, 'create'])->name('penguji.peserta.create');
    // Route::post('/peserta', [App\Http\Controllers\Penguji\PesertaController::class, 'store'])->name('penguji.peserta.store');
    // Route::get('/peserta/{peserta}', [App\Http\Controllers\Penguji\PesertaController::class, 'show'])->name('penguji.peserta.show');
    // Route::get('/peserta/{peserta}/edit', [App\Http\Controllers\Penguji\PesertaController::class, 'edit'])->name('penguji.peserta.edit');
    // Route::put('/peserta/{peserta}', [App\Http\Controllers\Penguji\PesertaController::class, 'update'])->name('penguji.peserta.update');
    // Route::delete('/peserta/{peserta}', [App\Http\Controllers\Penguji\PesertaController::class, 'destroy'])->name('penguji.peserta.destroy');

    Route::get('/periksa', [App\Http\Controllers\Penguji\PesertaBaruController::class, 'periksa_index'])->name('penguji.periksa.index');
    Route::get('/periksa/{periode}/data', [App\Http\Controllers\Penguji\PesertaBaruController::class, 'periksa_data'])->name('penguji.periksa.data');

    Route::get('/peserta-baru', [App\Http\Controllers\Penguji\PesertaBaruController::class, 'index'])->name('penguji.peserta-baru.index');
    Route::get('/peserta-baru/{periode}/data', [App\Http\Controllers\Penguji\PesertaBaruController::class, 'data'])->name('penguji.peserta-baru.data');
    Route::get('/peserta-baru/{periode}/data/{peserta}', [App\Http\Controllers\Penguji\PesertaBaruController::class, 'show'])->name('penguji.peserta-baru.show');
    Route::get('/peserta-baru/{periode}/data/{peserta}/edit', [App\Http\Controllers\Penguji\PesertaBaruController::class, 'edit'])->name('penguji.peserta-baru.edit');
    Route::put('/peserta-baru/{periode}/data/{peserta}', [App\Http\Controllers\Penguji\PesertaBaruController::class, 'update'])->name('penguji.peserta-baru.update');

    Route::get('/peserta', [App\Http\Controllers\Penguji\PesertaController::class, 'index'])->name('penguji.peserta.index');
    Route::get('/peserta/{periode}/data', [App\Http\Controllers\Penguji\PesertaController::class, 'data'])->name('penguji.peserta.data');
    Route::get('/peserta/{periode}/data/{peserta}', [App\Http\Controllers\Penguji\PesertaController::class, 'show'])->name('penguji.peserta.show');
    Route::get('/peserta/{periode}/data/{peserta}/edit', [App\Http\Controllers\Penguji\PesertaController::class, 'edit'])->name('penguji.peserta.edit');
    Route::put('/peserta/{periode}/data/{peserta}', [App\Http\Controllers\Penguji\PesertaController::class, 'update'])->name('penguji.peserta.update');


    Route::get('/', [App\Http\Controllers\Penguji\DashboardController::class, 'index'])->name('penguji.dashboard.index');
    Route::get('/jadwal', [App\Http\Controllers\Penguji\JadwalController::class, 'index'])->name('penguji.jadwal.index');
});
