<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\MetodePenyesuaian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MetodePenyesuaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Persentase', 'butuh_pembulatan' => false],
            ['nama' => 'Persentase Dibulatkan (Atas)', 'butuh_pembulatan' => true],
            ['nama' => 'Persentase Dibulatkan (Bawah)', 'butuh_pembulatan' => true],
            ['nama' => 'Penjumlahan Nilai', 'butuh_pembulatan' => false],
            ['nama' => 'Penjumlahan Nilai Dibulatkan (Atas)', 'butuh_pembulatan' => true],
            ['nama' => 'Penjumlahan Nilai Dibulatkan (Bawah)', 'butuh_pembulatan' => true],
            ['nama' => 'Pengurangan Nilai', 'butuh_pembulatan' => false],
            ['nama' => 'Pengurangan Nilai Dibulatkan (Atas)', 'butuh_pembulatan' => true],
            ['nama' => 'Pengurangan Nilai Dibulatkan (Bawah)', 'butuh_pembulatan' => true],
        ];

        foreach ($data as $i => $item) {
            MetodePenyesuaian::firstOrCreate(
                ['slug' => Str::slug($item['nama'])],
                [
                    'nama' => $item['nama'],
                    'butuh_pembulatan' => $item['butuh_pembulatan'],
                    'urutan' => $i + 1,
                ]
            );
        }
    }
}
