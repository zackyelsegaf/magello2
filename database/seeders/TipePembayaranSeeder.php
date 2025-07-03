<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\TipePembayaran;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'Booking Fee',
            'Uang Muka',
            'Biaya Akad Kredit',
            'Biaya Kelebihan Tanah',
            'Biaya Penambahan Bangunan',
        ];

        foreach ($items as $item) {
            TipePembayaran::updateOrCreate(
                ['slug' => Str::slug($item)],
                ['nama' => $item]
            );
        }
    }
}
