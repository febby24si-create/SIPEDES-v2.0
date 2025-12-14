<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RwSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $data = [];
        $rwNumbers = range(1, 5);

        foreach ($rwNumbers as $nomor) {
            $data[] = [
                'nomor_rw' => str_pad($nomor, 3, '0', STR_PAD_LEFT),
                'nama_ketua_rw' => $faker->name,
                'kontak_rw' => $faker->phoneNumber,
                'alamat_rw' => $faker->address,
                'status' => 'Aktif',
                'ketua_rw_warga_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('rws')->insert($data);
    }
}
