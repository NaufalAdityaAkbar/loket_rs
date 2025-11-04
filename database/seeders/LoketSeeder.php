<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loket;

class LoketSeeder extends Seeder
{
    public function run(): void
    {
        // name = nama loket, type = kode prefix untuk nomor antrian
        $lokets = [
            ['name' => 'Umum', 'type' => 'A'],
            ['name' => 'Poli Gigi', 'type' => 'B'],
            ['name' => 'Farmasi', 'type' => 'C'],
        ];

        foreach ($lokets as $loket) {
            Loket::create($loket);
        }
    }
}