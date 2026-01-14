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
        Schema::create('lomba_pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_id')->constrained('lomba_pesertas')->cascadeOnDelete();
            $table->foreignId('cabang_id')->nullable()->constrained('lomba_cabangs')->cascadeOnDelete();
            $table->string('nomor_peserta')->unique()->nullable();
            $table->integer('biaya')->default(0);
            $table->enum('status', ['MENDAFTAR','TERVERIFIKASI','BATAL'])->default('MENDAFTAR');
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lomba_pendaftarans');
    }
};
