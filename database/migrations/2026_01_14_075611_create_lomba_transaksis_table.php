<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lomba_transaksis', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('peserta_id')->constrained('lomba_pesertas');
            $table->foreignId('user_id')->constrained('users');
            $table->tinyInteger('status')->default(1); // 1 Menunggu Pembayaran - 2 Menunggu Konfirmasi - 3 Lunas - 4 Kadaluarsa
            $table->integer('nominal_total')->default(0);
            $table->integer('donasi')->default(0);
            $table->integer('nominal_total_pembayaran')->default(0);
            $table->json('data_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lomba_transaksis');
    }
};
