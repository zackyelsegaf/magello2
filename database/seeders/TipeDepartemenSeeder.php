<?php

namespace Database\Seeders;

use App\Models\TipeDepartemen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipeDepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipeDepartemen = [
            'Inventory Part',
            'Non Inventory Part',
            'Service',
        ];

        foreach ($tipeDepartemen as $nama) {
            TipeDepartemen::create(['nama' => $nama]);
        }
    }
}
