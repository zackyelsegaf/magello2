<?php

namespace Database\Seeders;

use App\Models\TipePelanggan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipePelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipePelanggan = [
            'PNS',
            'KOMERSIL',
            'TAPERA',
            'POLRI',
            'P3K',
            'UMUM',
        ];

        foreach ($tipePelanggan as $nama) {
            TipePelanggan::create(['nama' => $nama]);
        }
    }
}
