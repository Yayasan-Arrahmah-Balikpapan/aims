<?php

use Illuminate\Support\Facades\Route;
use App\Domain\Website\Controllers\WebController;
use App\Domain\Website\Controllers\DaftarUlangTahsinController;

Route::get("/", [WebController::class, "home"])->name("website.home");
// Route::get("/", function () {
//     return 'oke';
// });
Route::get("/lttq", [WebController::class, "lttq"])->name("website.lttq");
Route::get("/lttq/tahsin", [WebController::class, "lttq_tahsin"])->name("website.lttq.tahsin");

// Route::get("/lttq/tahsin/pendaftaran", function () {
//     return redirect()->away("https://atthala.arrahmahbalikpapan.or.id/tahsin/pendaftaran");
// });

// Route::get("/lttq/tahsin/pendaftaran", function () {
//     return redirect()->away("https://atthala.arrahmahbalikpapan.or.id/tahsin/pendaftaran");
// })->name("website.lttq.tahsin.pendaftaran");
// Route::get("/lttq/tahsin/pendaftaran", [WebController::class, "lttq_tahsin_pendaftaran"])->name("website.lttq.tahsin.pendaftaran");
Route::get("/lttq/tahsin/pendaftaran", [App\Domain\Website\Controllers\PendaftaranTahsinController::class, "tahsin_pendaftaran"])->name("website.lttq.tahsin.pendaftaran");

Route::post("/lttq/tahsin/pendaftaran/store", [App\Domain\Website\Controllers\PendaftaranTahsinController::class, "tahsin_pendaftaran_store"])->name("website.lttq.tahsin.pendaftaran.store");
Route::post("/lttq/tahsin/pendaftaran/store/ktp", [App\Domain\Website\Controllers\PendaftaranTahsinController::class, "tahsin_pendaftaran_store_ktp"])->name("website.lttq.tahsin.pendaftaran.store.ktp");
Route::post("/lttq/tahsin/pendaftaran/store/rekaman", [App\Domain\Website\Controllers\PendaftaranTahsinController::class, "tahsin_pendaftaran_store_rekaman"])->name("website.lttq.tahsin.pendaftaran.store.rekaman");
Route::get("/lttq/tahsin/pendaftaran/berhasil", [App\Domain\Website\Controllers\PendaftaranTahsinController::class, "tahsin_pendaftaran_berhasil"])->name("website.lttq.tahsin.pendaftaran.berhasil");
Route::get("/lttq/tahsin/pendaftaran/gagal", [App\Domain\Website\Controllers\PendaftaranTahsinController::class, "tahsin_pendaftaran_gagal"])->name("website.lttq.tahsin.pendaftaran.gagal");

Route::get("/lttq/tahsin/daftar-ulang", [DaftarUlangTahsinController::class, "tahsin_daftar_ulang"])->name("website.lttq.tahsin.daftar-ulang");
Route::post("/lttq/tahsin/daftar-ulang/store", [DaftarUlangTahsinController::class, "tahsin_daftar_ulang_store"])
    ->name("website.lttq.tahsin.daftar-ulang.store")
    // ->middleware('throttle:1,1')
    ;
Route::get("/lttq/tahsin/daftar-ulang/berhasil", [DaftarUlangTahsinController::class, "tahsin_daftar_ulang_berhasil"])->name("website.lttq.tahsin.daftar-ulang.berhasil");
Route::get("/lttq/tahsin/daftar-ulang/gagal", [DaftarUlangTahsinController::class, "tahsin_daftar_ulang_gagal"])->name("website.lttq.tahsin.daftar-ulang.gagal");

// Route::get("/lttq/tahsin/daftar-ulang/migrasi", [App\Domain\Website\Controllers\DaftarUlangTahsinMigrasiController::class, "tahsin_daftar_ulang"])->name("website.lttq.tahsin.daftar-ulang");
// Route::post("/lttq/tahsin/daftar-ulang/migrasi/store", [App\Domain\Website\Controllers\DaftarUlangTahsinMigrasiController::class, "tahsin_daftar_ulang_store"])->name("website.lttq.tahsin.daftar-ulang.store");
// Route::get("/lttq/tahsin/daftar-ulang/migrasi/berhasil", [App\Domain\Website\Controllers\DaftarUlangTahsinMigrasiController::class, "tahsin_daftar_ulang_berhasil"])->name("website.lttq.tahsin.daftar-ulang.berhasil");
// Route::get("/lttq/tahsin/daftar-ulang/migrasi/gagal", [App\Domain\Website\Controllers\DaftarUlangTahsinMigrasiController::class, "tahsin_daftar_ulang_gagal"])->name("website.lttq.tahsin.daftar-ulang.gagal");


Route::get("/lttq/tla", [App\Domain\Website\Controllers\LttqTlaController::class, "index"])->name("website.lttq.tla");
Route::get("/lttq/rq", [App\Domain\Website\Controllers\LttqRqController::class, "index"])->name("website.lttq.rq");

Route::get("/lttq/rtq-putra", [WebController::class, "lttq_rtq_putra"])->name("website.lttq.rtq-putra");
Route::get("/lttq/rtq-putri", [WebController::class, "lttq_rtq_putri"])->name("website.lttq.rtq-putri");

Route::get("/lttq/invoice/{uuid}", [App\Domain\Website\Controllers\InvoiceLttqController::class, "index"])->name("website.lttq.invoice");
Route::post("/lttq/invoice/{uuid}/store", [App\Domain\Website\Controllers\InvoiceLttqController::class, "store"])->name("website.lttq.invoice.store");
Route::post("/lttq/invoice/{uuid}/store/bukti-transfer", [App\Domain\Website\Controllers\InvoiceLttqController::class, "store_bukti_transfer"])->name("website.lttq.invoice.store.buktitransfer");


Route::get("/kontak", [WebController::class, "kontak"])->name("website.kontak");
Route::get("/yayasan", [WebController::class, "yayasan"])->name("website.yayasan");
Route::get("/informasi", [WebController::class, "informasi"])->name("website.informasi");
Route::get("/informasi/{slug}", [WebController::class, "informasi_slug"])->name("website.informasi.slug");
Route::get("/informasi/tag/{slug}", [WebController::class, "informasi_tag_slug"])->name("website.informasi.tag.slug");

Route::get("/quranic-camp", [WebController::class, "quranic_camp"])->name("website.quranic-camp");

Route::get("/ibadah", [App\Domain\Website\Controllers\IbadahController::class, "index"])->name("website.ibadah");
Route::get("/agenda", [App\Domain\Website\Controllers\AgendaController::class, "index"])->name("website.agenda");
// Route::get('/agenda', [\App\Http\Controllers\DashboardController::class, 'agenda'])->name('dashboard.peserta.agenda');
Route::get("/ramadhan", [App\Domain\Website\Controllers\Ramadhan\RamadhanController::class, "index"])->name("website.ramadhan");
Route::get("/ramadhan/lomba", [App\Domain\Website\Controllers\Ramadhan\RamadhanController::class, "lomba"])->name("website.ramadhan.lomba");
Route::get("/ramadhan/lomba/daftar", [App\Domain\Website\Controllers\Ramadhan\RamadhanController::class, "lomba_daftar"])->name("website.ramadhan.lomba.daftar");
Route::post("/ramadhan/lomba/daftar", [App\Domain\Website\Controllers\Ramadhan\RamadhanController::class, "lomba_daftar_store"])->name("website.ramadhan.lomba.daftar.store");
Route::get("/ramadhan/lomba/invoice/{uuid}", [App\Domain\Website\Controllers\Ramadhan\RamadhanController::class, "lomba_invoice"])->name("website.ramadhan.lomba.invoice");
Route::post("/ramadhan/lomba/invoice/{uuid}/store", [App\Domain\Website\Controllers\Ramadhan\RamadhanController::class, "lomba_invoice_store"])->name("website.ramadhan.lomba.invoice.store");
Route::post("/ramadhan/lomba/invoice/{uuid}/store/bukti-transfer", [App\Domain\Website\Controllers\Ramadhan\RamadhanController::class, "lomba_invoice_store_bukti_transfer"])->name("website.ramadhan.lomba.invoice.store.buktitransfer");


//SOSIAL
Route::get("/sosial", [App\Domain\Website\Controllers\SosialController::class, "index"])->name("website.sosial");
Route::get("/sosial/fundraising", [App\Domain\Website\Controllers\Sosial\FundraisingController::class, "index"])->name("website.sosial.fundraising.index");





