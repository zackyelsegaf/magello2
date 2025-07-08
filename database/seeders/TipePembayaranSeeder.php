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
            'Kredit/KPR',
            'Tunai',
            'Tunai Bertahap',
        ];

        foreach ($items as $item) {
            TipePembayaran::updateOrCreate(
                ['slug' => Str::slug($item)],
                ['nama' => $item]
            );
        }
    }
}
