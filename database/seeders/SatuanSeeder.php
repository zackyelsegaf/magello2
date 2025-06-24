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
            'Pcs',
            'Batang',
            'Bungkus',
            'Dus',
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
            'Rol',
            'Set',
            'Sak',
            'Unit',
            'Buah',
            'Truk',
            'Lnt',
            'Fail',
            'M3',
            'Orang',
            'Hari',
            'Botol',
            'Butir',
            'Galon',
            'Liter',
            'Set M2',
            'Rek',
            'Ret'
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
