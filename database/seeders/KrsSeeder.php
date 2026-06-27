<?php

namespace Database\Seeders;

use App\Models\Krs;
use Illuminate\Database\Seeder;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        $krs = [
            ['npm' => '2024001001', 'kode_matakuliah' => 'IF53413'],
            ['npm' => '2024001001', 'kode_matakuliah' => 'IF53201'],
            ['npm' => '2024001002', 'kode_matakuliah' => 'IF53413'],
        ];

        foreach ($krs as $k) {
            Krs::create($k);
        }
    }
}
