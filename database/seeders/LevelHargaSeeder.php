<?php

namespace Database\Seeders;

use App\Models\LevelHarga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelHargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levelHarga = [
            '1',
            '2',
            '3',
            '4',
            '5'
        ];

        foreach ($levelHarga as $nama) {
            LevelHarga::create(['nama' => $nama]);
        }
    }
}
