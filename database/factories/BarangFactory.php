<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    public function definition(): array
    {
        $int  = fn(int $min, int $max) => $this->faker->numberBetween($min, $max);
        $ribuan = fn(int $minK, int $maxK) => $this->faker->numberBetween($minK, $maxK) * 1000;

        $qtyAwal   = $int(0, 100);
        $hargaAwal = $ribuan(10, 500);

        return [
            'no_barang'                   => $this->faker->unique()->bothify('BRG-####'),
            'nama_barang'                 => $this->faker->words(3, true),
            'tipe_barang'                 => $this->faker->randomElement(['stok', 'jasa', 'aset']),
            'dihentikan'                  => $this->faker->boolean(10),
            'tipe_persediaan'             => $this->faker->randomElement(['FIFO', 'LIFO', 'Average']),
            'kategori_barang'             => $this->faker->word(),
            'sub_barang_check'            => $this->faker->boolean(20),
            'sub_barang'                  => $this->faker->word(),
            'deskripsi_1'                 => $this->faker->sentence(),
            'deskripsi_2'                 => $this->faker->sentence(),
            'default_gudang'              => $this->faker->city(),
            'departemen'                  => $this->faker->word(),
            'proyek'                      => $this->faker->word(),
            'diskon'                      => $int(0, 50),
            'kode_pajak'                  => $this->faker->regexify('[A-Z]{2}[0-9]{2}'),
            'pemasok'                     => $this->faker->company(),
            'minimum_kuantitas_pesan_ulang'=> $int(1, 50),
            'kuantitas_saldo_awal'        => $qtyAwal,
            'biaya_satuan_saldo_awal'     => $hargaAwal,
            'total_saldo_awal'            => $qtyAwal * $hargaAwal,
            'kuantitas_saldo_sekarang'    => $qtyAwal,
            'harga_satuan_sekarang'       => $hargaAwal,
            'biaya_pokok_sekarang'        => $hargaAwal,
            'gudang'                      => $this->faker->city(),
            'tanggal_mulai'               => $this->faker->date(),
            'minimal_harga_jual'          => $ribuan(10, 100),
            'maksimal_harga_jual'         => $ribuan(101, 200),
            'minimal_harga_beli'          => $ribuan(5, 50),
            'maksimal_harga_beli'         => $ribuan(51, 100),
            'nomor_upc'                   => $this->faker->ean13(),
            'nomor_plu'                   => $this->faker->numerify('PLU###'),
            'fileupload_1'                => $this->faker->imageUrl(),
            'fileupload_2'                => $this->faker->imageUrl(),
            'fileupload_3'                => $this->faker->imageUrl(),
            'fileupload_4'                => $this->faker->imageUrl(),
            'fileupload_5'                => $this->faker->imageUrl(),
            'fileupload_6'                => $this->faker->imageUrl(),
            'fileupload_7'                => $this->faker->imageUrl(),
        ];
    }
}
