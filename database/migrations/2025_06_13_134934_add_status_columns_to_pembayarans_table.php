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
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->foreignId('periode_id')->constrained()->after('biaya_id');
            $table->foreignId('kelas_id')->constrained()->after('periode_id');
            $table->integer('nominal')->nullable()->after('kelas_id');
            $table->text('keterangan')->nullable()->after('nominal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->dropColumn('periode_id');
            $table->dropColumn('kelas_id');
            $table->dropColumn('nominal');
            $table->dropColumn('keterangan');
        });
    }
};
