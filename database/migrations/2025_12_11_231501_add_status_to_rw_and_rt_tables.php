<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tambah kolom ke tabel rws
        Schema::table('rws', function (Blueprint $table) {
            if (!Schema::hasColumn('rws', 'nama_ketua_rw')) {
                $table->string('nama_ketua_rw')->after('nomor_rw');
            }
            if (!Schema::hasColumn('rws', 'kontak_rw')) {
                $table->string('kontak_rw')->nullable()->after('nama_ketua_rw');
            }
            if (!Schema::hasColumn('rws', 'alamat_rw')) {
                $table->text('alamat_rw')->nullable()->after('kontak_rw');
            }
            if (!Schema::hasColumn('rws', 'status')) {
                $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif')->after('alamat_rw');
            }
        });

        // Tambah kolom ke tabel rts
        Schema::table('rts', function (Blueprint $table) {
            if (!Schema::hasColumn('rts', 'nama_ketua_rt')) {
                $table->string('nama_ketua_rt')->after('nomor_rt');
            }
            if (!Schema::hasColumn('rts', 'kontak_rt')) {
                $table->string('kontak_rt')->nullable()->after('nama_ketua_rt');
            }
            if (!Schema::hasColumn('rts', 'alamat_rt')) {
                $table->text('alamat_rt')->nullable()->after('kontak_rt');
            }
            if (!Schema::hasColumn('rts', 'status')) {
                $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif')->after('alamat_rt');
            }

            // Pastikan kolom rw_id ada
            if (!Schema::hasColumn('rts', 'rw_id')) {
                $table->foreignId('rw_id')->after('id')->constrained('rws')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        // Hapus kolom dari rts
        Schema::table('rts', function (Blueprint $table) {
            $table->dropColumn(['nama_ketua_rt', 'kontak_rt', 'alamat_rt', 'status']);
        });

        // Hapus kolom dari rws
        Schema::table('rws', function (Blueprint $table) {
            $table->dropColumn(['nama_ketua_rw', 'kontak_rw', 'alamat_rw', 'status']);
        });
    }
};
