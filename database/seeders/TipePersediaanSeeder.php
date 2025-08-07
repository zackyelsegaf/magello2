<?php

namespace Database\Seeders;

use App\Models\TipePersediaan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipePersediaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipePersediaan = [
            'Barang Jadi',
            'Barang Lain-lain',
            'Barang Setengah Jadi',
            'Barang Baku Pembantu',
            'Baku'
        ];

        foreach ($tipePersediaan as $nama) {
            TipePersediaan::create(['nama' => $nama]);
        }
    }
}
