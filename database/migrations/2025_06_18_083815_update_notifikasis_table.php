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
        Schema::table('notifikasis', function (Blueprint $table) {
            // Hapus relasi periode_id
            $table->dropForeign(['periode_id']);
            $table->dropColumn('periode_id');

            // Tambahkan relasi baru (nullable)
            $table->foreignId('divisi_id')->nullable()->constrained('divisis')->nullOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();

            // Ubah slug agar tidak unique
            $table->dropUnique(['slug']);

            // Ubah pesan_whatsapp jadi nullable
            $table->text('pesan_whatsapp')->nullable()->change();

            // Tambah pesan_email (json nullable)
            $table->json('pesan_email')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifikasis', function (Blueprint $table) {
            // Tambahkan kembali periode_id
            $table->foreignId('periode_id')->constrained('periodes');

            // Hapus kolom divisi_id dan unit_id
            $table->dropForeign(['divisi_id']);
            $table->dropColumn('divisi_id');

            $table->dropForeign(['unit_id']);
            $table->dropColumn('unit_id');

            // Tambahkan kembali unique ke slug
            $table->unique('slug');

            // Ubah kembali pesan_whatsapp jadi tidak nullable
            $table->text('pesan_whatsapp')->nullable(false)->change();

            // Hapus pesan_email
            $table->dropColumn('pesan_email');
        });
    }
};
