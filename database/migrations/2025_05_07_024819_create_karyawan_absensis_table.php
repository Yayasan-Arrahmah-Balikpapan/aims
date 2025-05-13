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
        Schema::create('karyawan_absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('status')->default('HADIR'); // 1 HADIR, 2 TIDAK MASUK, 3 SAKIT, 4 IZIN
            $table->json('foto')->nullable();
            $table->json('koordinat')->nullable();
            $table->json('keterangan')->nullable();
            $table->timestamp('waktu_datang', 0)->nullable();
            $table->timestamp('waktu_pulang', 0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan_absensis');
    }
};
