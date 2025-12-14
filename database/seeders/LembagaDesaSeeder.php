<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LembagaDesa;
use Faker\Factory as Faker;

class LembagaDesaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $lembagaDesa = [
            'Badan Permusyawaratan Desa (BPD)',
            'Lembaga Pemberdayaan Masyarakat Desa (LPMD)',
            'Tim Penggerak PKK Desa',
            'Karang Taruna Desa',
            'Kelompok Tani',
            'Kelompok Ternak',
            'Kelompok Nelayan',
            'Gabungan Kelompok Tani (GAPOKTAN)',
            'Pos Pelayanan Terpadu (Posyandu)',
            'Lembaga Adat Desa',
            'Majelis Taklim Desa',
            'Remaja Masjid',
            'Koperasi Desa',
            'BUMDes (Badan Usaha Milik Desa)',
            'Forum RT/RW',
            'Kelompok Sadar Wisata (Pokdarwis)',
            'Kelompok Usaha Bersama (KUBE)',
            'Kelompok Perempuan Tani',
            'Kelompok UMKM Desa',
            'Forum Anak Desa',
            'Lembaga Perlindungan Anak Desa',
            'Relawan Desa Tangguh Bencana',
            'Satuan Perlindungan Masyarakat (Satlinmas)',
            'Kelompok Pecinta Lingkungan',
            'Kelompok Bank Sampah',
            'Kelompok Pengrajin Desa',
            'Kelompok Budidaya Ikan',
            'Forum Komunikasi Pemuda Desa',
            'Paguyuban Pedagang Pasar Desa',
            'Komite Sekolah Desa'
        ];

        foreach ($lembagaDesa as $nama) {
            LembagaDesa::create([
                'nama_lembaga' => $nama,
                'deskripsi' => $faker->paragraphs(3, true),
                'kontak' => $faker->phoneNumber(),
                'logo' => null // gunakan placeholder di view
            ]);
        }
    }
}
