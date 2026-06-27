<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        $dosens = [
            ['nidn' => '1001000001', 'nama' => 'Dr. Budi Santoso, M.Kom'],
            ['nidn' => '1001000002', 'nama' => 'Siti Aminah, M.T.'],
            ['nidn' => '1001000003', 'nama' => 'Ahmad Fauzi, M.Cs.'],
        ];

        foreach ($dosens as $dosen) {
            Dosen::create($dosen);
        }
    }
}
