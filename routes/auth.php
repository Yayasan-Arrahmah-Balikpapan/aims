<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\AuthPhoneController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    // Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

// V2 - Phone NUmber

Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::redirect('register', 'akses');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::redirect('login', 'akses');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('akses', [AuthPhoneController::class, 'akses'])->name('akses');
    Route::post('akses', [AuthPhoneController::class, 'akses_validasi'])->middleware('throttle:5,5')->name('akses.validasi');
    Route::get('akses/{nomor}', [AuthPhoneController::class, 'akses_nomor'])->name('akses.nomor');
    Route::get('akses/kirim-otp/{nomor}', [AuthPhoneController::class, 'akses_nomor_kirim_otp'])->middleware('throttle:6,3')->name('akses.nomor.kirim-otp');
    Route::get('akses/kirim-otp/{nomor}/sesi-waktu-mulai', [AuthPhoneController::class, 'akses_nomor_kirim_otp_sesi_waktu_mulai'])->name('akses.nomor.kirim-otp.sesi-waktu-mulai');
    Route::get('akses/kirim-otp/{nomor}/sesi-waktu-batas', [AuthPhoneController::class, 'akses_nomor_kirim_otp_sesi_waktu_batas'])->name('akses.nomor.kirim-otp.sesi-waktu-batas');
    Route::post('akses/login', [AuthPhoneController::class, 'akses_login'])->name('akses.login');


    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::patch('/profile/phone/{id}', [\App\Http\Controllers\ProfileController::class, 'update_phone'])->name('phone.update');
});
