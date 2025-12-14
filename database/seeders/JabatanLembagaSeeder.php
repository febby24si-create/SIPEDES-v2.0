<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JabatanLembagaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $lembagaIds = DB::table('lembaga_desas')->pluck('id')->toArray();

        if (empty($lembagaIds)) {
            echo "⚠️  Peringatan: Tabel lembaga_desas kosong. Seeder JabatanLembagaSeeder dibatalkan.\n";
            return;
        }

        foreach ($lembagaIds as $lembagaId) {

            // Cegah duplikasi jika seeder dijalankan ulang
            $exists = DB::table('jabatan_lembagas')
                ->where('lembaga_id', $lembagaId)
                ->exists();

            if ($exists) {
                continue;
            }

            $jabatans = [
                ['nama_jabatan' => 'Ketua', 'level' => 'Ketua'],
                ['nama_jabatan' => 'Wakil Ketua', 'level' => 'Lainnya'],
                ['nama_jabatan' => 'Sekretaris', 'level' => 'Sekretaris'],
                ['nama_jabatan' => 'Bendahara', 'level' => 'Bendahara'],
                ['nama_jabatan' => 'Koordinator Bidang', 'level' => 'Lainnya'],
                ['nama_jabatan' => 'Anggota', 'level' => 'Anggota'],
            ];


            foreach ($jabatans as $jabatan) {
                DB::table('jabatan_lembagas')->insert([
                    'lembaga_id' => $lembagaId,
                    'nama_jabatan' => $jabatan['nama_jabatan'],
                    'level' => $jabatan['level'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
