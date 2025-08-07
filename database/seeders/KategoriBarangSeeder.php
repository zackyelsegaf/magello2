<?php

namespace Database\Seeders;

use App\Models\KategoriBarang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            'BAHAN BAKU',
            'BARANG JADI',
            'CHARGE/SERVICE',
            'OK',
        ];

        foreach ($kategori as $nama) {
            KategoriBarang::create([
                'nama' => $nama,
            ]);
        }
    }
}
