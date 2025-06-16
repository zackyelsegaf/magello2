<?php

namespace Database\Seeders;

use App\Models\JenisHarga;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JenisHargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisHargaList = [
            ['nama' => 'Harga Baru 1', 'tipe' => 'jual', 'urutan' => 1],
            ['nama' => 'Harga Baru 2', 'tipe' => 'jual', 'urutan' => 2],
            ['nama' => 'Harga Baru 3', 'tipe' => 'jual', 'urutan' => 3],
            ['nama' => 'Harga Baru 4', 'tipe' => 'jual', 'urutan' => 4],
            ['nama' => 'Harga Baru 5', 'tipe' => 'jual', 'urutan' => 5],
            ['nama' => 'Diskon Barang', 'tipe' => 'diskon', 'urutan' => 6],
            ['nama' => 'Min Harga Jual', 'tipe' => 'jual', 'urutan' => 7],
            ['nama' => 'Max Harga Jual', 'tipe' => 'jual', 'urutan' => 8],
            ['nama' => 'Min Harga Beli', 'tipe' => 'beli', 'urutan' => 9],
            ['nama' => 'Max Harga Beli', 'tipe' => 'beli', 'urutan' => 10],
        ];

        foreach ($jenisHargaList as $item) {
            JenisHarga::firstOrCreate(
                ['slug' => Str::slug($item['nama'])],
                [
                    'nama' => $item['nama'],
                    'tipe' => $item['tipe'],
                    'urutan' => $item['urutan'],
                    'aktif' => true,
                ]
            );
        }
    }
}
