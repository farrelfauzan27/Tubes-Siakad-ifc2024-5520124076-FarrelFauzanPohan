<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswas = [
            ['npm' => '2024001001', 'nidn' => '1001000001', 'nama' => 'Rian Saputra', 'email' => 'rian@siakad.test'],
            ['npm' => '2024001002', 'nidn' => '1001000001', 'nama' => 'Dewi Lestari', 'email' => 'dewi@siakad.test'],
            ['npm' => '2024001003', 'nidn' => '1001000002', 'nama' => 'Putu Ardiana', 'email' => 'putu@siakad.test'],
        ];

        foreach ($mahasiswas as $m) {
            Mahasiswa::create([
                'npm' => $m['npm'],
                'nidn' => $m['nidn'],
                'nama' => $m['nama'],
            ]);

            User::create([
                'name' => $m['nama'],
                'email' => $m['email'],
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'npm' => $m['npm'],
            ]);
        }
    }
}
