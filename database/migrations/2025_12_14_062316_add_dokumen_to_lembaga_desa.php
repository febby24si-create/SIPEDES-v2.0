<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lembaga_desas', function (Blueprint $table) {
            $table->json('dokumen')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('lembaga_desas', function (Blueprint $table) {
            $table->dropColumn('dokumen');
        });
    }
};
