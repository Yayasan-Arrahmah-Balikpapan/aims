<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/admin/{unit}')->middleware('role:admin-tahsin|admin-rtq|admin-tla|admin-rq|admin-tahla')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.index');

    Route::get('/periode', [App\Http\Controllers\Admin\PeriodeController::class, 'index'])->name('admin.periode.index');
    Route::get('/periode/create', [App\Http\Controllers\Admin\PeriodeController::class, 'create'])->name('admin.periode.create');
    Route::post('/periode', [App\Http\Controllers\Admin\PeriodeController::class, 'store'])->name('admin.periode.store');
    Route::get('/periode/{periode}', [App\Http\Controllers\Admin\PeriodeController::class, 'show'])->name('admin.periode.show');
    Route::get('/periode/{periode}/edit', [App\Http\Controllers\Admin\PeriodeController::class, 'edit'])->name('admin.periode.edit');
    Route::put('/periode/{periode}', [App\Http\Controllers\Admin\PeriodeController::class, 'update'])->name('admin.periode.update');
    Route::delete('/periode/{periode}', [App\Http\Controllers\Admin\PeriodeController::class, 'destroy'])->name('admin.periode.destroy');


    Route::prefix('/periode/{periode}')->group(function () {

        Route::get('/statistik', [App\Http\Controllers\Admin\PeriodeController::class, 'statistik'])->name('admin.periode.statistik');
        Route::get('/tahsin-chart-data-1', [App\Http\Controllers\Admin\PeriodeController::class, 'getTahsinDashboardChartData1'])->name('admin.periode.dashboard.tahsin-chart-data-1');
        Route::get('/tahsin-chart-data-2', [App\Http\Controllers\Admin\PeriodeController::class, 'getTahsinDashboardChartData2'])->name('admin.periode.dashboard.tahsin-chart-data-2');

        Route::get('/jadwal', [App\Http\Controllers\Admin\JadwalController::class, 'index'])->name('admin.jadwal.index');
        Route::get('/jadwal/absen', [App\Http\Controllers\Admin\JadwalController::class, 'absen'])->name('admin.jadwal.absen');
        Route::get('/jadwal/create', [App\Http\Controllers\Admin\JadwalController::class, 'create'])->name('admin.jadwal.create');
        Route::post('/jadwal', [App\Http\Controllers\Admin\JadwalController::class, 'store'])->name('admin.jadwal.store');
        Route::get('/jadwal/{jadwal}', [App\Http\Controllers\Admin\JadwalController::class, 'show'])->name('admin.jadwal.show');
        Route::get('/jadwal/{jadwal}/edit', [App\Http\Controllers\Admin\JadwalController::class, 'edit'])->name('admin.jadwal.edit');
        Route::put('/jadwal/{jadwal}', [App\Http\Controllers\Admin\JadwalController::class, 'update'])->name('admin.jadwal.update');
        Route::delete('/jadwal/{jadwal}', [App\Http\Controllers\Admin\JadwalController::class, 'destroy'])->name('admin.jadwal.destroy');

        Route::get('/peserta', [App\Http\Controllers\Admin\PesertaController::class, 'index'])->name('admin.peserta.index');
        Route::get('/peserta/create', [App\Http\Controllers\Admin\PesertaController::class, 'create'])->name('admin.peserta.create');
        Route::post('/peserta', [App\Http\Controllers\Admin\PesertaController::class, 'store'])->name('admin.peserta.store');
        Route::get('/peserta/{peserta}', [App\Http\Controllers\Admin\PesertaController::class, 'show'])->name('admin.peserta.show');
        Route::get('/peserta/{peserta}/edit', [App\Http\Controllers\Admin\PesertaController::class, 'edit'])->name('admin.peserta.edit');
        Route::put('/peserta/{peserta}', [App\Http\Controllers\Admin\PesertaController::class, 'update'])->name('admin.peserta.update');
        Route::delete('/peserta/{peserta}', [App\Http\Controllers\Admin\PesertaController::class, 'destroy'])->name('admin.peserta.destroy');

        Route::get('/absensi', [App\Http\Controllers\Admin\AbsensiController::class, 'index'])->name('admin.absensi.index');
        Route::get('/absensi/kehadiran', [App\Http\Controllers\Admin\AbsensiController::class, 'kehadiran'])->name('admin.absensi.kehadiran');
        Route::get('/absensi/create', [App\Http\Controllers\Admin\AbsensiController::class, 'create'])->name('admin.absensi.create');
        Route::post('/absensi', [App\Http\Controllers\Admin\AbsensiController::class, 'store'])->name('admin.absensi.store');
        Route::get('/absensi/{absensi}', [App\Http\Controllers\Admin\AbsensiController::class, 'show'])->name('admin.absensi.show');
        Route::get('/absensi/{absensi}/edit', [App\Http\Controllers\Admin\AbsensiController::class, 'edit'])->name('admin.absensi.edit');
        Route::put('/absensi/{absensi}', [App\Http\Controllers\Admin\AbsensiController::class, 'update'])->name('admin.absensi.update');
        Route::delete('/absensi/{absensi}', [App\Http\Controllers\Admin\AbsensiController::class, 'destroy'])->name('admin.absensi.destroy');

        Route::get('/kehadiran', [App\Http\Controllers\Admin\KehadiranController::class, 'index'])->name('admin.kehadiran.index');
        Route::get('/kehadiran/create', [App\Http\Controllers\Admin\KehadiranController::class, 'create'])->name('admin.kehadiran.create');
        Route::post('/kehadiran', [App\Http\Controllers\Admin\KehadiranController::class, 'store'])->name('admin.kehadiran.store');
        Route::get('/kehadiran/{kehadiran}', [App\Http\Controllers\Admin\KehadiranController::class, 'show'])->name('admin.kehadiran.show');
        Route::get('/kehadiran/{kehadiran}/edit', [App\Http\Controllers\Admin\KehadiranController::class, 'edit'])->name('admin.kehadiran.edit');
        Route::put('/kehadiran/{kehadiran}', [App\Http\Controllers\Admin\KehadiranController::class, 'update'])->name('admin.kehadiran.update');
        Route::delete('/kehadiran/{kehadiran}', [App\Http\Controllers\Admin\KehadiranController::class, 'destroy'])->name('admin.kehadiran.destroy');

        Route::get('/transaksi', [App\Http\Controllers\Admin\TransaksiController::class, 'index'])->name('admin.transaksi.index');
        Route::get('/transaksi/create', [App\Http\Controllers\Admin\TransaksiController::class, 'create'])->name('admin.transaksi.create');
        Route::post('/transaksi', [App\Http\Controllers\Admin\TransaksiController::class, 'store'])->name('admin.transaksi.store');
        Route::get('/transaksi/{transaksi}', [App\Http\Controllers\Admin\TransaksiController::class, 'show'])->name('admin.transaksi.show');
        Route::get('/transaksi/{transaksi}/edit', [App\Http\Controllers\Admin\TransaksiController::class, 'edit'])->name('admin.transaksi.edit');
        Route::put('/transaksi/{transaksi}', [App\Http\Controllers\Admin\TransaksiController::class, 'update'])->name('admin.transaksi.update');
        Route::delete('/transaksi/{transaksi}', [App\Http\Controllers\Admin\TransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');

        Route::get('/pembayaran', [App\Http\Controllers\Admin\PembayaranController::class, 'index'])->name('admin.pembayaran.index');
        Route::get('/pembayaran/rekap', [App\Http\Controllers\Admin\PembayaranController::class, 'rekap'])->name('admin.pembayaran.rekap');
        Route::get('/pembayaran/transaksi', [App\Http\Controllers\Admin\PembayaranController::class, 'transaksi'])->name('admin.pembayaran.transaksi');
        Route::get('/pembayaran/peserta/{peserta}', [App\Http\Controllers\Admin\PembayaranController::class, 'peserta'])->name('admin.pembayaran.peserta');
        Route::get('/pembayaran/{pembayaran}', [App\Http\Controllers\Admin\PembayaranController::class, 'show'])->name('admin.pembayaran.show');
        Route::get('/pembayaran/{pembayaran}/edit', [App\Http\Controllers\Admin\PembayaranController::class, 'edit'])->name('admin.pembayaran.edit');
        Route::put('/pembayaran/{pembayaran}', [App\Http\Controllers\Admin\PembayaranController::class, 'update'])->name('admin.pembayaran.update');
        Route::delete('/pembayaran/{pembayaran}', [App\Http\Controllers\Admin\PembayaranController::class, 'destroy'])->name('admin.pembayaran.destroy');

    });



    // Route::get('/transaksi', [App\Http\Controllers\Admin\TransaksiController::class, 'index'])->name('admin.transaksi.index');
    // Route::get('/transaksi/create', [App\Http\Controllers\Admin\TransaksiController::class, 'create'])->name('admin.transaksi.create');
    // Route::post('/transaksi', [App\Http\Controllers\Admin\TransaksiController::class, 'store'])->name('admin.transaksi.store');
    // Route::get('/transaksi/{transaksi}', [App\Http\Controllers\Admin\TransaksiController::class, 'show'])->name('admin.transaksi.show');
    // Route::get('/transaksi/{transaksi}/edit', [App\Http\Controllers\Admin\TransaksiController::class, 'edit'])->name('admin.transaksi.edit');
    // Route::put('/transaksi/{transaksi}', [App\Http\Controllers\Admin\TransaksiController::class, 'update'])->name('admin.transaksi.update');
    // Route::delete('/transaksi/{transaksi}', [App\Http\Controllers\Admin\TransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');

    Route::get('/pengajar', [App\Http\Controllers\Admin\PengajarController::class, 'index'])->name('admin.pengajar.index');
    Route::get('/pengajar/create', [App\Http\Controllers\Admin\PengajarController::class, 'create'])->name('admin.pengajar.create');
    Route::post('/pengajar', [App\Http\Controllers\Admin\PengajarController::class, 'store'])->name('admin.pengajar.store');
    Route::get('/pengajar/{pengajar}', [App\Http\Controllers\Admin\PengajarController::class, 'show'])->name('admin.pengajar.show');
    Route::get('/pengajar/{pengajar}/edit', [App\Http\Controllers\Admin\PengajarController::class, 'edit'])->name('admin.pengajar.edit');
    Route::put('/pengajar/{pengajar}', [App\Http\Controllers\Admin\PengajarController::class, 'update'])->name('admin.pengajar.update');
    Route::delete('/pengajar/{pengajar}', [App\Http\Controllers\Admin\PengajarController::class, 'destroy'])->name('admin.pengajar.destroy');

    Route::get('/level', [App\Http\Controllers\Admin\LevelController::class, 'index'])->name('admin.level.index');
    Route::get('/level/create', [App\Http\Controllers\Admin\LevelController::class, 'create'])->name('admin.level.create');
    Route::post('/level', [App\Http\Controllers\Admin\LevelController::class, 'store'])->name('admin.level.store');
    Route::get('/level/{level}', [App\Http\Controllers\Admin\LevelController::class, 'show'])->name('admin.level.show');
    Route::get('/level/{level}/edit', [App\Http\Controllers\Admin\LevelController::class, 'edit'])->name('admin.level.edit');
    Route::put('/level/{level}', [App\Http\Controllers\Admin\LevelController::class, 'update'])->name('admin.level.update');
    Route::delete('/level/{level}', [App\Http\Controllers\Admin\LevelController::class, 'destroy'])->name('admin.level.destroy');

    Route::get('/pengaturan', [App\Http\Controllers\Admin\PengaturanController::class, 'index'])->name('admin.pengaturan.index');
    Route::get('/pengaturan/create', [App\Http\Controllers\Admin\PengaturanController::class, 'create'])->name('admin.pengaturan.create');
    Route::post('/pengaturan', [App\Http\Controllers\Admin\PengaturanController::class, 'store'])->name('admin.pengaturan.store');
    Route::get('/pengaturan/{pengaturan}', [App\Http\Controllers\Admin\PengaturanController::class, 'show'])->name('admin.pengaturan.show');
    Route::get('/pengaturan/{pengaturan}/edit', [App\Http\Controllers\Admin\PengaturanController::class, 'edit'])->name('admin.pengaturan.edit');
    Route::put('/pengaturan/{pengaturan}', [App\Http\Controllers\Admin\PengaturanController::class, 'update'])->name('admin.pengaturan.update');
    Route::delete('/pengaturan/{pengaturan}', [App\Http\Controllers\Admin\PengaturanController::class, 'destroy'])->name('admin.pengaturan.destroy');

    Route::get('/notifikasi', [App\Http\Controllers\Admin\NotifikasiController::class, 'index'])->name('admin.notifikasi.index');
    Route::get('/notifikasi/create', [App\Http\Controllers\Admin\NotifikasiController::class, 'create'])->name('admin.notifikasi.create');
    Route::post('/notifikasi', [App\Http\Controllers\Admin\NotifikasiController::class, 'store'])->name('admin.notifikasi.store');
    Route::get('/notifikasi/{notifikasi}', [App\Http\Controllers\Admin\NotifikasiController::class, 'show'])->name('admin.notifikasi.show');
    Route::get('/notifikasi/{notifikasi}/edit', [App\Http\Controllers\Admin\NotifikasiController::class, 'edit'])->name('admin.notifikasi.edit');
    Route::put('/notifikasi/{notifikasi}', [App\Http\Controllers\Admin\NotifikasiController::class, 'update'])->name('admin.notifikasi.update');
    Route::delete('/notifikasi/{notifikasi}', [App\Http\Controllers\Admin\NotifikasiController::class, 'destroy'])->name('admin.notifikasi.destroy');

    Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user.index');
    Route::get('/user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.user.create');
    Route::post('/user', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.user.store');
    Route::get('/user/{id}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('admin.user.show');
    Route::put('/user/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.user.update');
    Route::get('/user/{id}/password', [App\Http\Controllers\Admin\UserController::class, 'password'])->name('admin.user.password');
    Route::put('/user/{id}/password', [App\Http\Controllers\Admin\UserController::class, 'password_update'])->name('admin.user.password.update');
    Route::delete('/user/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.user.destroy');

    // Route::get('/pembayaran/', function () {
    //     return view('dashboard.admin.pembayaran');
    // })->name('dashboard.admin.pembayaran');
});
