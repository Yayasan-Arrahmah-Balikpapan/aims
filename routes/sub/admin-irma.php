<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminIrma\AdminIrmaController;
use App\Http\Controllers\AdminIrma\AnggotaIrmaController;

Route::prefix('/admin-irma')->middleware('role:admin-irma')->group(function () {
    Route::get('/', [AdminIrmaController::class, 'index'])->name('admin-irma.index');
    
    Route::get('/anggota-irma', [AnggotaIrmaController::class, 'index'])->name('admin-irma.anggota-irma.index');
});
