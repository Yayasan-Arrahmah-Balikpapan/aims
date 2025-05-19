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

Route::get("/lttq/tahsin/pendaftaran", function () {
    return redirect()->away("https://atthala.arrahmahbalikpapan.or.id/tahsin/pendaftaran");
})->name("website.lttq.tahsin.pendaftaran");
// Route::get("/lttq/tahsin/pendaftaran", [WebController::class, "lttq_tahsin_pendaftaran"])->name("website.lttq.tahsin.pendaftaran");

Route::post("/lttq/tahsin/pendaftaran/store", [WebController::class, "lttq_tahsin_pendaftaran_store"])->name("website.lttq.tahsin.pendaftaran.store");
Route::post("/lttq/tahsin/pendaftaran/store/ktp", [WebController::class, "lttq_tahsin_pendaftaran_store_ktp"])->name("website.lttq.tahsin.pendaftaran.store.ktp");
Route::post("/lttq/tahsin/pendaftaran/store/rekaman", [WebController::class, "lttq_tahsin_pendaftaran_store_rekaman"])->name("website.lttq.tahsin.pendaftaran.store.rekaman");
Route::get("/lttq/tahsin/pendaftaran/berhasil", [WebController::class, "lttq_tahsin_pendaftaran_berhasil"])->name("website.lttq.tahsin.pendaftaran.berhasil");
Route::get("/lttq/tahsin/pendaftaran/gagal", [WebController::class, "lttq_tahsin_pendaftaran_gagal"])->name("website.lttq.tahsin.pendaftaran.gagal");

Route::get("/lttq/tahsin/daftar-ulang", [DaftarUlangTahsinController::class, "tahsin_daftar_ulang"])->name("website.lttq.tahsin.daftar-ulang");
Route::post("/lttq/tahsin/daftar-ulang/store", [DaftarUlangTahsinController::class, "tahsin_daftar_ulang_store"])->name("website.lttq.tahsin.daftar-ulang.store");
Route::get("/lttq/tahsin/daftar-ulang/berhasil", [DaftarUlangTahsinController::class, "tahsin_daftar_ulang_berhasil"])->name("website.lttq.tahsin.daftar-ulang.berhasil");
Route::get("/lttq/tahsin/daftar-ulang/gagal", [DaftarUlangTahsinController::class, "tahsin_daftar_ulang_gagal"])->name("website.lttq.tahsin.daftar-ulang.gagal");

Route::get("/lttq/tla", [App\Domain\Website\Controllers\LttqTlaController::class, "index"])->name("website.lttq.tla");
Route::get("/lttq/rq", [App\Domain\Website\Controllers\LttqRqController::class, "index"])->name("website.lttq.rq");

Route::get("/lttq/rtq-putra", [WebController::class, "lttq_rtq_putra"])->name("website.lttq.rtq-putra");
Route::get("/lttq/rtq-putri", [WebController::class, "lttq_rtq_putri"])->name("website.lttq.rtq-putri");

Route::get("/lttq/invoice/{uuid}", [WebController::class, "lttq_invoice"])->name("website.lttq.invoice");
Route::post("/lttq/invoice/{uuid}/store", [WebController::class, "lttq_invoice_store"])->name("website.lttq.invoice.store");
Route::post("/lttq/invoice/{uuid}/store/bukti-transfer", [WebController::class, "lttq_invoice_store_bukti_transfer"])->name("website.lttq.invoice.store.buktitransfer");


Route::get("/kontak", [WebController::class, "kontak"])->name("website.kontak");
Route::get("/yayasan", [WebController::class, "yayasan"])->name("website.yayasan");
Route::get("/informasi", [WebController::class, "informasi"])->name("website.informasi");
Route::get("/informasi/{slug}", [WebController::class, "informasi_slug"])->name("website.informasi.slug");
Route::get("/informasi/tag/{slug}", [WebController::class, "informasi_tag_slug"])->name("website.informasi.tag.slug");

Route::get("/quranic-camp", [WebController::class, "quranic_camp"])->name("website.quranic-camp");


