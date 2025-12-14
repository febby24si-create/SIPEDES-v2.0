<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableForAuth extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Cek dulu, hanya tambahkan jika belum ada
            if (!Schema::hasColumn('users', 'name')) {
                $table->string('name')->after('id');
            }

            if (!Schema::hasColumn('users', 'email')) {
                $table->string('email')->after('name');
            }

            // Hapus kolom lama (jika ada)
            if (Schema::hasColumn('users', 'username')) {
                $table->dropColumn('username');
            }
            if (Schema::hasColumn('users', 'nama_lengkap')) {
                $table->dropColumn('nama_lengkap');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambah kembali kolom lama
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username')->unique();
            }

            if (!Schema::hasColumn('users', 'nama_lengkap')) {
                $table->string('nama_lengkap');
            }

            // Hapus kolom baru jika ada
            if (Schema::hasColumn('users', 'name')) {
                $table->dropColumn('name');
            }

            if (Schema::hasColumn('users', 'email')) {
                $table->dropColumn('email');
            }
        });
    }
}
