<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipeBukuKasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nama' => 'Pemasukan', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Pengeluaran', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($data as $row) {
            DB::table('tipe_buku_kas')->updateOrInsert(
                ['nama' => $row['nama']],
                ['updated_at' => now(), 'created_at' => DB::raw('COALESCE(created_at, CURRENT_TIMESTAMP)')]
            );
        }
    }
}
