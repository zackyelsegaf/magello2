<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\Pajak;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PajakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $akunPPNKeluaran = Akun::where('nama_akun_indonesia', 'PPN Keluaran')->first();
        $akunPPNMasukan  = Akun::where('nama_akun_indonesia', 'PPN Masukan')->first();

        $akunPPH23Penjualan = Akun::where('nama_akun_indonesia', 'PPH 23 Penjualan')->first();
        $akunPPH23Pembelian = Akun::where('nama_akun_indonesia', 'PPH 23 Pembelian')->first();

        Pajak::create([
            'kode' => 'P',
            'nama' => 'PPN 11 %',
            'nilai_persentase' => 11.00,
            'akun_pajak_penjualan_id' => $akunPPNKeluaran?->id,
            'akun_pajak_pembelian_id' => $akunPPNMasukan?->id,
            'deskripsi' => 'PPN 11 %',
        ]);

        Pajak::create([
            'kode' => 'H',
            'nama' => 'PPH 23 2 %',
            'nilai_persentase' => 2.00,
            'akun_pajak_penjualan_id' => $akunPPH23Penjualan?->id,
            'akun_pajak_pembelian_id' => $akunPPH23Pembelian?->id,
            'deskripsi' => 'PPH 23 2 %',
        ]);
    }
}
