<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Buat tabel rws jika belum ada
        if (!Schema::hasTable('rws')) {
            Schema::create('rws', function (Blueprint $table) {
                $table->id();
                $table->string('nomor_rw', 10);
                $table->string('nama_ketua_rw');
                $table->string('kontak_rw')->nullable();
                $table->text('alamat_rw')->nullable();
                $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
                $table->timestamps();
            });
        }

        // Buat tabel rts jika belum ada
        if (!Schema::hasTable('rts')) {
            Schema::create('rts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('rw_id')->constrained('rws')->onDelete('cascade');
                $table->string('nomor_rt', 10);
                $table->string('nama_ketua_rt');
                $table->string('kontak_rt')->nullable();
                $table->text('alamat_rt')->nullable();
                $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('rts');
        Schema::dropIfExists('rws');
    }
};
