<?php

namespace Database\Seeders;

use App\Models\GolonganDarah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GolonganDarahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $golonganDarah = [
            'A+',
            'A-',
            'B+',
            'B-',
            'AB+',
            'AB-',
            'O+',
            'O-'
        ];

        foreach ($golonganDarah as $nama) {
            GolonganDarah::create(['nama' => $nama]);
        }
    }
}
