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
        Schema::table('absensi_pesertas', function (Blueprint $table) {
            $table->foreignId('kelas_id')->after('id')->nullable()->constrained('kelas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensi_pesertas', function (Blueprint $table) {
            $table->dropForeign('absensi_pesertas_kelas_id_foreign');
            $table->dropColumn('kelas_id');
        });
    }
};
