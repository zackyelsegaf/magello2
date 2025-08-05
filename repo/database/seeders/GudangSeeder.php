<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GudangSeeder extends Seeder
{
    public function run()
    {
        $data = [];
        $kode_awal = 'GMP';
        $huruf_awal = 'A';

        for ($i = 0; $i < 20; $i++) {
            $huruf = chr(ord($huruf_awal) + $i); // A, B, C, ..., T (20 huruf)
            $data[] = [
                'nama_gudang'        => $kode_awal . $huruf . '01',
                'alamat_gudang_1'    => "$kode_awal $huruf No. 1",
                'alamat_gudang_2'    => "Jl. Gudang $huruf Raya",
                'alamat_gudang_3'    => "Kota Gudang $huruf",
                'penanggung_jawab'   => "Pak $huruf",
                'deskripsi'          => "Gudang penyimpanan kode $huruf"
            ];
        }

        DB::table('gudang')->insert($data);
    }
}