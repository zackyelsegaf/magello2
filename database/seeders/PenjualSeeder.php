<?php

namespace Database\Seeders;

use App\Models\Penjual;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenjualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_depan_penjual' => 'ARI',
                'nama_belakang_penjual' => 'Marketing',
                'jabatan' => 'Marketing freelance',
                'dihentikan' => false,
            ],
            [
                'nama_depan_penjual' => 'CLAUDIA',
                'nama_belakang_penjual' => 'Marketing',
                'jabatan' => 'Marketing freelance',
                'dihentikan' => false,
            ],
            [
                'nama_depan_penjual' => 'FAURI',
                'nama_belakang_penjual' => 'Marketing',
                'jabatan' => 'Marketing freelance',
                'dihentikan' => false,
            ],
            [
                'nama_depan_penjual' => 'JOBEL',
                'nama_belakang_penjual' => 'Marketing',
                'jabatan' => 'Marketing freelance',
                'dihentikan' => false,
            ],
            [
                'nama_depan_penjual' => 'KANTOR',
                'nama_belakang_penjual' => 'Marketing',
                'jabatan' => 'Marketing Kantor',
                'dihentikan' => false,
            ],
            [
                'nama_depan_penjual' => 'NADYA',
                'nama_belakang_penjual' => 'Marketing',
                'jabatan' => 'Marketing freelance',
                'dihentikan' => false,
            ],
            [
                'nama_depan_penjual' => 'PKS TIKA',
                'nama_belakang_penjual' => 'Marketing',
                'jabatan' => 'Marketing freelance',
                'dihentikan' => false,
            ],
            [
                'nama_depan_penjual' => 'RIANTY',
                'nama_belakang_penjual' => 'Marketing',
                'jabatan' => 'Marketing freelance',
                'dihentikan' => false,
            ],
            [
                'nama_depan_penjual' => 'RINNY',
                'nama_belakang_penjual' => 'Marketing',
                'jabatan' => 'Marketing freelance',
                'dihentikan' => false,
            ],
            [
                'nama_depan_penjual' => 'SANDRA',
                'nama_belakang_penjual' => 'Kantor',
                'jabatan' => 'Marketing Kantor',
                'dihentikan' => false,
            ],
        ];

        foreach ($data as $penjual) {
            Penjual::create($penjual);
        }
    }
}
