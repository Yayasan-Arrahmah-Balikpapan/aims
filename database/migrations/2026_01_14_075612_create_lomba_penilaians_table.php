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
        Schema::create('lomba_penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('lomba_pendaftarans')->cascadeOnDelete();
            $table->foreignId('juri_id')->constrained('lomba_juris')->cascadeOnDelete();
            $table->json('nilai');
            $table->decimal('total_nilai', 5, 2);
            $table->timestamps();

            $table->unique(['pendaftaran_id','juri_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lomba_penilaians');
    }
};
