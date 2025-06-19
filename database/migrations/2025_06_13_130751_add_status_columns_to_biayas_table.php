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
        Schema::table('biayas', function (Blueprint $table) {
            $table->boolean('status_dicicil')->default(false)->after('nominal');
            $table->boolean('wajib_dibayar_awal')->default(false)->after('status_dicicil');
            $table->string('slug')->nullable()->after('wajib_dibayar_awal');
            $table->string('wajib_dibayar_oleh')->default('umum')->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biayas', function (Blueprint $table) {
            $table->dropColumn('status_dicicil');
            $table->dropColumn('wajib_dibayar_awal');
            $table->dropColumn('slug');
            $table->dropColumn('wajib_dibayar_oleh');
        });
    }
};
