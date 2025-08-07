<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\ModulUtama\Aktiva\AkunAkumulasiPenyusutan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AkunAkumulasiPenyusutanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'Akumulasi Peny. Bangunan',
            'Akumulasi Peny. Kendaraan',
            'Akumulasi Peny. Mesin & Peralatan',
            'Akumulasi Peny. Peralatan',
        ];

        foreach ($items as $item) {
            AkunAkumulasiPenyusutan::create([
                'nama' => $item,
                'slug' => Str::slug($item),
            ]);
        }
    }
}
