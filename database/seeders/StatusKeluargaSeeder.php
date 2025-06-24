<?php

namespace Database\Seeders;

use App\Models\StatusKeluarga;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusKeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusKeluarga = [
            'Keluarga',
            'Saudara',
            'Kerabat',
            'Lainnya',
        ];

        foreach ($statusKeluarga as $nama) {
            StatusKeluarga::create(['nama' => $nama]);
        }
    }
}
