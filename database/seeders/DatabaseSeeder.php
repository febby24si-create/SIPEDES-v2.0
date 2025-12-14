<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\WargaSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RwSeeder::class,
            RtSeeder::class,
            WargaSeeder::class,
            LembagaDesaSeeder::class,
            JabatanLembagaSeeder::class,
            PerangkatDesaSeeder::class,
            AnggotaLembagaSeeder::class,
        ]);
    }
}
