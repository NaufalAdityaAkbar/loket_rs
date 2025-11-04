<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loket;

class LoketSeeder extends Seeder
{
    public function run(): void
    {
        // use short names (A/B/C) so generated nomor prefix uses the letter directly
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