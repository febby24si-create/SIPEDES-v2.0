<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'password123', // Password plain, akan di-hash oleh mutator (jika ada) atau Auth
                'role' => 'admin',
            ],
            [
                'name' => 'Rezy',
                'email' => 'rezy@gmail.com',
                'password' => 'password123',
                'role' => 'admin',
            ],
            [
                'name' => 'Stefanny',
                'email' => 'fanny@gmail.com',
                'password' => 'password123',
                'role' => 'admin',
            ]
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']), // Hash di sini
                    'role' => $user['role'],
                ]
            );
        }
    }
}
