<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GudangFactory extends Factory
{
    protected static $hurufIndex = 0;

    public function definition(): array
    {
        $huruf = chr(ord('A') + self::$hurufIndex++); // A, B, C, ..., T

        return [
            'nama_gudang'        => 'GMP' . $huruf . '01',
            'alamat_gudang_1'    => 'GMP ' . $huruf . ' No. 1',
            'alamat_gudang_2'    => 'Jl. Gudang ' . $huruf . ' Raya',
            'alamat_gudang_3'    => 'Kota Gudang ' . $huruf,
            'penanggung_jawab'   => 'Pak ' . $huruf,
            'deskripsi'          => 'Gudang penyimpanan kode ' . $huruf,
        ];
    }
}
