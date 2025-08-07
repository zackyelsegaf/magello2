<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Laki-laki'],
            ['nama' => 'Perempuan'],
        ];

        foreach ($data as $gender) {
            Gender::updateOrCreate(['nama' => $gender['nama']], $gender);
        }
    }
}
