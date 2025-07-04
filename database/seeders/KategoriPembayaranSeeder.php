<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\KategoriPembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'Biaya',
            'Diskon',
            'Pajak',
        ];

        foreach ($items as $item) {
            KategoriPembayaran::updateOrCreate(
                ['slug' => Str::slug($item)],
                ['nama' => $item]
            );
        }
    }
}
