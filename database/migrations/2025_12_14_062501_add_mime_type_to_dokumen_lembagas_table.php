<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_mime_type_to_dokumen_lembagas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('dokumen_lembagas', function (Blueprint $table) {
            // Tambahkan kolom mime_type jika belum ada
            if (!Schema::hasColumn('dokumen_lembagas', 'mime_type')) {
                $table->string('mime_type')->nullable()->after('ukuran_file');
            }
        });
    }

    public function down(): void
    {
        Schema::table('dokumen_lembagas', function (Blueprint $table) {
            $table->dropColumn('mime_type');
        });
    }
};
