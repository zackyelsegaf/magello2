<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\SumberNilaiAsal;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SumberNilaiAsalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Nilai Sekarang',
            'Biaya Aktual',
            'Semua Nilai Terakhir',
            'Harga Lama 1',
            'Harga Lama 2',
            'Harga Lama 3',
            'Harga Lama 4',
            'Harga Lama 5',
            'Harga Baru 1',
            'Harga Baru 2',
            'Harga Baru 3',
            'Harga Baru 4',
            'Harga Baru 5',
            'Harga Min Jual Lama',
            'Harga Max Jual Lama',
            'Harga Min Jual Baru',
            'Harga Max Jual Baru',
        ];

        foreach ($data as $i => $nama) {
            SumberNilaiAsal::firstOrCreate(
                ['slug' => Str::slug($nama)],
                [
                    'nama' => $nama,
                    'urutan' => $i + 1,
                    'aktif' => true,
                ]
            );
        }
    }
}
