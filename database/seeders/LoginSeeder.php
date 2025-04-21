<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
                [
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'role' => 'admin',
                    'password' => bcrypt('Admin123'),
                ],
                [
                    'name' => 'Dosen',
                    'email' => 'dosen@gmail.com',
                    'role' => 'dosen',
                    'password' => bcrypt('Dosen123'),
                ],
                [
                    'name' => 'Mahasiswa',
                    'email' => 'mahasiswa@gmail.com',
                    'role' => 'mahasiswa',
                    'password' => bcrypt('Mahasiswa123'),
                ],
            ];

            foreach ($userData as $key => $val) {
                User::create($val);
            }
    }
}
