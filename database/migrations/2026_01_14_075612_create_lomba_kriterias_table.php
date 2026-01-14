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
        Schema::create('lomba_kriterias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cabang_id')->constrained('lomba_cabangs')->cascadeOnDelete();
            $table->string('nama_kriteria');
            $table->integer('bobot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lomba_kriterias');
    }
};
