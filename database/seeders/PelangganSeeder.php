<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Penjual;
use App\Models\Pelanggan;
use App\Models\TipePelanggan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penjual = Penjual::first();
        if (!$penjual) {
            $this->command->error('Penjual belum ada. Isi data penjual terlebih dahulu.');
            return;
        }

        $tipeMap = [
            'UMUM' => TipePelanggan::firstOrCreate(['nama' => 'UMUM'])->id,
            'PNS' => TipePelanggan::firstOrCreate(['nama' => 'PNS'])->id,
            'KOMERSIL' => TipePelanggan::firstOrCreate(['nama' => 'KOMERSIL'])->id,
            'POLRI' => TipePelanggan::firstOrCreate(['nama' => 'POLRI'])->id,
        ];

        $data = [
            [
                'kode_pelanggan' => 'GMPCSR-001',
                'nama' => 'RISKY DEBRIAN BANGOL',
                'alamat_1' => 'POOPO BARAT, DUSUN 2, RW 007, PASSI TIMUR',
                'kontak' => 'FAJRI / 08212990224',
                'no_telp' => '0852-5626-7060',
                'tipe' => 'UMUM',
                'saldo' => 1000000,
            ],
            [
                'kode_pelanggan' => 'GMPCSR-002',
                'nama' => 'NOVAN HENDRAWAN MAN',
                'alamat_1' => 'DUSUN III, RT 002 / 001, KEC PASSI BARAT',
                'kontak' => 'KANTOR',
                'no_telp' => '0813-4273-4325',
                'tipe' => 'UMUM',
                'saldo' => 1000000,
            ],
            [
                'kode_pelanggan' => 'GMPCSR-005',
                'nama' => 'FANTHY AFANDY DETU',
                'alamat_1' => 'MOLINOW, RT 011 / RW 006, KOTAMOBAGU BARAT',
                'kontak' => 'RINNY / 082187946695',
                'no_telp' => '08964994266',
                'tipe' => 'PNS',
                'saldo' => 1000000,
            ],
            [
                'kode_pelanggan' => 'GMPCSR-009',
                'nama' => 'SABRIA GUMOHUNG',
                'alamat_1' => null,
                'kontak' => 'KANTOR',
                'no_telp' => '082239524756',
                'tipe' => 'UMUM',
                'saldo' => 1000000,
            ],
            [
                'kode_pelanggan' => 'GMPCSR-011',
                'nama' => 'FIKRY POBELA, S.PT',
                'alamat_1' => 'BILALANG I, RT 001, KOTAMOBAGU TIMUR',
                'kontak' => 'ARI / 085657085227',
                'no_telp' => '08134838417',
                'tipe' => 'UMUM',
                'saldo' => 1000000,
            ],
        ];

        foreach ($data as $item) {
            Pelanggan::create([
                'kode_pelanggan' => $item['kode_pelanggan'],
                'nama' => $item['nama'],
                'alamat_1' => $item['alamat_1'],
                'kontak' => $item['kontak'],
                'no_telp' => $item['no_telp'],
                'tipe_pelanggan_id' => $tipeMap[$item['tipe']] ?? null,
                'penjual_id' => $penjual->id,
                'pajak_1_id' => 1,
                'proyek_id' => null,
                'proyek_type' => null,
                'saldo_awal' => $item['saldo'],
                'tanggal_saldo_awal' => Carbon::now(),
                'level_harga' => 0,
                'dihentikan' => false,
            ]);
        }
    }
}
