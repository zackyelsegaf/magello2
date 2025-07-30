<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BarangFactory extends Factory
{
    public function definition(): array
    {
        return [
            'no_barang' => $this->faker->unique()->bothify('BRG-####'),
            'nama_barang' => $this->faker->words(3, true),
            'tipe_barang' => $this->faker->randomElement(['stok', 'jasa', 'aset']),
            'dihentikan' => $this->faker->boolean(10),
            'tipe_persediaan' => $this->faker->randomElement(['FIFO', 'LIFO', 'Average']),
            'kategori_barang' => $this->faker->word(),
            'sub_barang_check' => $this->faker->boolean(20),
            'sub_barang' => $this->faker->word(),
            'deskripsi_1' => $this->faker->sentence(),
            'deskripsi_2' => $this->faker->sentence(),
            'default_gudang' => $this->faker->city(),
            'departemen' => $this->faker->word(),
            'proyek' => $this->faker->word(),
            'diskon' => $this->faker->numberBetween(0, 50) . '%',
            'kode_pajak' => $this->faker->regexify('[A-Z]{2}[0-9]{2}'),
            'pemasok' => $this->faker->company(),
            'minimum_kuantitas_pesan_ulang' => $this->faker->randomNumber(2),
            'kuantitas_saldo_awal' => $this->faker->randomFloat(2, 0, 100),
            'biaya_satuan_saldo_awal' => $this->faker->randomFloat(2, 10, 500),
            'total_saldo_awal' => $this->faker->randomFloat(2, 100, 10000),
            'kuantitas_saldo_sekarang' => $this->faker->randomFloat(2, 0, 100),
            'harga_satuan_sekarang' => $this->faker->randomFloat(2, 10, 500),
            'biaya_pokok_sekarang' => $this->faker->randomFloat(2, 10, 500),
            'gudang' => $this->faker->city(),
            'tanggal_mulai' => $this->faker->date(),
            'minimal_harga_jual' => $this->faker->randomFloat(2, 10, 100),
            'maksimal_harga_jual' => $this->faker->randomFloat(2, 101, 200),
            'minimal_harga_beli' => $this->faker->randomFloat(2, 5, 50),
            'maksimal_harga_beli' => $this->faker->randomFloat(2, 51, 100),
            'nomor_upc' => $this->faker->ean13(),
            'nomor_plu' => $this->faker->numerify('PLU###'),
            'fileupload_1' => $this->faker->imageUrl(),
            'fileupload_2' => $this->faker->imageUrl(),
            'fileupload_3' => $this->faker->imageUrl(),
            'fileupload_4' => $this->faker->imageUrl(),
            'fileupload_5' => $this->faker->imageUrl(),
            'fileupload_6' => $this->faker->imageUrl(),
            'fileupload_7' => $this->faker->imageUrl(),
        ];
    }
}
