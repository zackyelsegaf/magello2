<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\ModulUtama\Aktiva\MetodePenyusutan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MetodePenyusutanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metodes = [
            ['nama' => 'Tidak Menyusut'],
            ['nama' => 'Metode Garis Lurus'],
            ['nama' => 'Double Declining Method'],
        ];

        foreach ($metodes as $metode) {
            MetodePenyusutan::create([
                'nama' => $metode['nama'],
                'slug' => Str::slug($metode['nama']),
                'keterangan' => 'Metode ' . $metode['nama'],
            ]);
        }
    }
}
