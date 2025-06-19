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
        Schema::table('kelas', function (Blueprint $table) {
            $table->string('status_daftar')->nullable()->after('status_aktif');
            $table->string('status_pendaftaran')->nullable()->after('status_daftar');
            $table->string('status_ujian')->nullable()->after('status_pendaftaran');
            $table->string('status_daftar_ulang')->nullable()->after('status_ujian');
            $table->string('status_domisili')->nullable()->after('status_daftar_ulang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropColumn([
                'status_daftar',
                'status_pendaftaran',
                'status_ujian',
                'status_daftar_ulang',
                'status_domisili'
            ]);
        });
    }
};
