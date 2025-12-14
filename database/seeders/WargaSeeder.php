<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Faker Indonesia

        // Mengambil ID RW dan RT yang sudah dibuat
        $rwIds = DB::table('rws')->pluck('id')->toArray();
        $rtIds = DB::table('rts')->pluck('id')->toArray();

        if (empty($rwIds) || empty($rtIds)) {
            echo "Peringatan: Tabel rws atau rts kosong. Seeding WargaSeeder dibatalkan.\n";
            return;
        }

        $data = [];
        $usedNiks = [];
        $targetCount = 100; // Target 100 warga

        for ($i = 0; $i < $targetCount; $i++) {
            // Generate NIK unik 16 digit
            do {
                $nik = $faker->numerify('################');
            } while (in_array($nik, $usedNiks));

            $usedNiks[] = $nik;

            $jenisKelamin = $faker->randomElement(['Laki-laki', 'Perempuan']);
            $nama = $jenisKelamin === 'Laki-laki'
                ? $faker->firstNameMale . ' ' . $faker->lastNameMale
                : $faker->firstNameFemale . ' ' . $faker->lastNameFemale;

            $data[] = [
                'nik' => $nik,
                'nama' => $nama,
                'tgl_lahir' => $faker->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
                'jenis_kelamin' => $jenisKelamin,
                'alamat' => $faker->address,
                'rw_id' => $faker->randomElement($rwIds),
                'rt_id' => $faker->randomElement($rtIds),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('wargas')->insert($data);
    }
}
