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
        Schema::create('daftar_anggota_irmas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('gender', ['Ikhwan', 'Akhwat']);
            $table->tinyInteger('umur');
            $table->string('telepon')->unique();
            $table->text('alamat');
            $table->string('instansi');
            $table->string('kelas_semester');
            $table->string('jurusan')->nullable();
            $table->enum('divisi', ['Sosial', 'Media', 'Dakwah']);
            $table->text('keahlian')->nullable();
            $table->enum('status', ['menunggu verifikasi', 'lolos', 'ditolak'])->default('menunggu verifikasi');
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_anggota_irmas');
    }
};
