<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriBukuKasSeeder extends Seeder
{
    public function run()
    {
        // ambil id tipe berdasarkan nama (asumsi TipeBukuKasSeeder sudah dijalankan)
        $pemasukan = DB::table('tipe_buku_kas')->where('nama', 'Pemasukan')->value('id');
        $pengeluaran = DB::table('tipe_buku_kas')->where('nama', 'Pengeluaran')->value('id');

        $kategori = [
            // Pemasukan
            ['nama_kategori' => 'Penjualan', 'tipe_id' => $pemasukan, 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Pembayaran Konsumen', 'tipe_id' => $pemasukan, 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Lain-lain (Pemasukan)', 'tipe_id' => $pemasukan, 'created_at' => now(), 'updated_at' => now()],

            // Pengeluaran
            ['nama_kategori' => 'Gaji', 'tipe_id' => $pengeluaran, 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Operasional', 'tipe_id' => $pengeluaran, 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Pembelian Barang', 'tipe_id' => $pengeluaran, 'created_at' => now(), 'updated_at' => now()],
            ['nama_kategori' => 'Lain-lain (Pengeluaran)', 'tipe_id' => $pengeluaran, 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($kategori as $row) {
            DB::table('kategori_buku_kas')->updateOrInsert(
                ['nama_kategori' => $row['nama_kategori'], 'tipe_id' => $row['tipe_id']],
                ['created_at' => $row['created_at'], 'updated_at' => $row['updated_at']]
            );
        }
    }
}
