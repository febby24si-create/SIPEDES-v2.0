<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PerangkatDesaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Mengambil ID warga yang sudah dibuat
        $wargaIds = DB::table('wargas')->pluck('id')->toArray();

        if (empty($wargaIds)) {
            echo "Peringatan: Tabel wargas kosong. Seeding PerangkatDesaSeeder dibatalkan.\n";
            return;
        }

        $data = [];
        $usedWargaIds = [];
        $targetCount = 100; // Target 10 perangkat desa

        $jabatanList = [
            'Kepala Desa',
            'Sekretaris Desa',
            'Kaur Keuangan',
            'Kaur Umum',
            'Kasi Pemerintahan',
            'Kasi Kesejahteraan',
            'Kasi Pelayanan',
            'Kepala Dusun 1',
            'Kepala Dusun 2',
            'Kepala Dusun 3',
        ];

        for ($i = 0; $i < $targetCount && $i < count($jabatanList); $i++) {
            // Cari warga yang belum digunakan
            do {
                $warga_id = $faker->randomElement($wargaIds);
            } while (in_array($warga_id, $usedWargaIds));

            $usedWargaIds[] = $warga_id;

            $tgl_mulai = $faker->dateTimeBetween('-3 years', '-1 years')->format('Y-m-d');

            // 80% masih aktif, 20% sudah selesai
            $tgl_selesai = $faker->randomElement([
                null,
                $faker->dateTimeBetween($tgl_mulai, 'now')->format('Y-m-d')
            ]);

            $data[] = [
                'warga_id' => $warga_id,
                'jabatan' => $jabatanList[$i],
                'nip' => $faker->numerify('################'),
                'kontak' => $faker->phoneNumber,
                'periode_mulai' => $tgl_mulai,
                'periode_selesai' => $tgl_selesai,
                'foto' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('perangkat_desas')->insert($data);
    }
}
