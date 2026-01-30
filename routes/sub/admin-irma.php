<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/admin-irma')->middleware('role:admin-irma')->group(function () {
    Route::get('/', [App\Http\Controllers\AdminIrma\AdminIrmaController::class, 'index'])->name('admin-irma.index');

});
