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
        Schema::table('absens', function (Blueprint $table) {
            if (!Schema::hasColumn('absens', 'jadwal_id')) {
                $table->foreignId('jadwal_id')->after('id')->constrained('jadwals')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absens', function (Blueprint $table) {
            if (Schema::hasColumn('absens', 'jadwal_id')) {
                $table->dropForeign(['jadwal_id']);
                $table->dropColumn('jadwal_id');
            }
        });
    }
};
