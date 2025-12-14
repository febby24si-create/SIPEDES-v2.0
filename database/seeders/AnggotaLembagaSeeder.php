<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnggotaLembagaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil parent IDs
        $lembagaIds = DB::table('lembaga_desas')->pluck('id')->toArray();
        $wargaIds   = DB::table('wargas')->pluck('id')->toArray();

        if (empty($lembagaIds) || empty($wargaIds)) {
            echo "⚠️  Parent table kosong. Seeder AnggotaLembagaSeeder dibatalkan.\n";
            return;
        }

        $data = [];
        $usedCombinations = [];

        $targetCount = 80;
        $maxLoop = 500;

        while (count($data) < $targetCount && $maxLoop > 0) {

            $lembagaId = $faker->randomElement($lembagaIds);
            $wargaId   = $faker->randomElement($wargaIds);

            $key = $lembagaId . '-' . $wargaId;

            // Hindari duplikasi warga dalam lembaga yang sama
            if (isset($usedCombinations[$key])) {
                $maxLoop--;
                continue;
            }

            // Ambil jabatan SESUAI lembaga
            $jabatanIds = DB::table('jabatan_lembagas')
                ->where('lembaga_id', $lembagaId)
                ->pluck('id')
                ->toArray();

            if (empty($jabatanIds)) {
                $maxLoop--;
                continue;
            }

            $startDate = $faker->dateTimeBetween('-5 years', '-6 months');

            $endDate = $faker->boolean(30)
                ? null
                : $faker->dateTimeBetween($startDate, 'now');

            $data[] = [
                'lembaga_id'  => $lembagaId,
                'warga_id'    => $wargaId,
                'jabatan_id'  => $faker->randomElement($jabatanIds),
                'tgl_mulai'   => $startDate->format('Y-m-d'),
                'tgl_selesai' => $endDate ? $endDate->format('Y-m-d') : null,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];

            $usedCombinations[$key] = true;
            $maxLoop--;
        }

        DB::table('anggota_lembagas')->insert($data);
    }
}
