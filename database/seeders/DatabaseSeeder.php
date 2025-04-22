<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // database/seeders/DatabaseSeeder.php
User::create([
    'name' => 'Admin',
    'email' => 'admin@mail.com',
    'password' => bcrypt('password'),
    'role' => 'admin',
]);

User::create([
    'name' => 'Dosen Satu',
    'email' => 'dosen@mail.com',
    'password' => bcrypt('password'),
    'role' => 'dosen',
]);

User::create([
    'name' => 'Mahasiswa Satu',
    'email' => 'mahasiswa@mail.com',
    'password' => bcrypt('password'),
    'role' => 'mahasiswa',
]);


    }
}
