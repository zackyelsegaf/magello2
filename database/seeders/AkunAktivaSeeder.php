<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\ModulUtama\Aktiva\AkunAktiva;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AkunAktivaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $items = [
            'Tanah',
            'Bangunan',
            'Kendaraan',
            'Peralatan & Furniture Kantor',
            'Peralatan Proyek',
            'Merk Dagang',
            'Hak Cipta',
            'Goodwill',
        ];

        foreach ($items as $item) {
            AkunAktiva::create([
                'nama' => $item,
                'slug' => Str::slug($item),
            ]);
        }
    }
}
