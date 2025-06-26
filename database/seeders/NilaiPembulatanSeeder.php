<?php

namespace Database\Seeders;

use App\Models\NilaiPembulatan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NilaiPembulatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [
            10,
            100,
            1000,
            10000,
            100000,
            1000000,
            10000000,
            100000000
        ];

        foreach ($values as $nilai) {
            NilaiPembulatan::firstOrCreate(
                ['nilai' => $nilai],
                ['aktif' => true]
            );
        }
    }
}
