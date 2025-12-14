<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RtSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Mengambil ID RW yang sudah dibuat
        $rwIds = DB::table('rws')->pluck('id')->toArray();

        if (empty($rwIds)) {
            echo "Peringatan: Tabel rws kosong. Seeding RtSeeder dibatalkan.\n";
            return;
        }

        $data = [];

        foreach ($rwIds as $rwId) {
            // Setiap RW memiliki 3-5 RT
            $jumlahRt = $faker->numberBetween(3, 5);

            for ($i = 1; $i <= $jumlahRt; $i++) {
                $data[] = [
                    'rw_id' => $rwId,
                    'nomor_rt' => str_pad($i, 3, '0', STR_PAD_LEFT),
                    'nama_ketua_rt' => $faker->name,
                    'kontak_rt' => $faker->phoneNumber,
                    'alamat_rt' => $faker->address,
                    'status' => 'Aktif',
                    'ketua_rt_warga_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('rts')->insert($data);
    }
}