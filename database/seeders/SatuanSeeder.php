<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Satuan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $satuans = [
            'Batang',
            'Bungkus',
            'Dos',
            'Dump',
            'Ikat',
            'Kaleng',
            'Kg',
            'Kubik',
            'Lembar',
            'Lusin',
            'M2',
            'Meter',
            'Pail',
            'Pcs',
            'Rol',
            'Set',
            'Zak',
        ];
        $now = Carbon::now();

        foreach ($satuans as $satuan) {
            Satuan::create([
                'nama' => $satuan,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
