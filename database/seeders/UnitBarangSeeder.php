<?php

namespace Database\Seeders;

use App\Models\UnitBarang;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $units = ['Unit 1', 'Unit 2', 'Unit 3', 'Unit 4', 'Unit 5'];

        foreach ($units as $i => $nama) {
            UnitBarang::firstOrCreate(
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
