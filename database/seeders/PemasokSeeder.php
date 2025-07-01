<?php

namespace Database\Seeders;

use App\Models\Pajak;
use App\Models\Syarat;
use App\Models\Pemasok;
use App\Models\MataUang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PemasokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pajak = Pajak::where('nama', 'PPN 11 %')->first();
        $syarat = Syarat::where('nama', 'C.O.D')->first(); // asumsikan kamu punya field 'nama' di tabel syarat
        $mataUang = MataUang::where('kode', 'IDR')->first();

        $data = [
            [
                'pemasok_id' => 'TB-001',
                'nama' => 'TB. Cahaya Bangunan Poyowa',
                'alamat_1' => 'Jalan Siliwangi Poyowa Besar 1',
                'provinsi' => 'Sulawesi Utara',
                'kota' => 'Kotamobagu',
                'negara' => 'INDONESIA',
                'no_telp' => '081340686823',
            ],
            [
                'pemasok_id' => 'TB-002',
                'nama' => 'TB. Aguan',
                'alamat_1' => 'Kotamobagu Selatan',
                'provinsi' => 'Sulawesi Utara',
                'kota' => 'Kotamobagu',
                'negara' => 'INDONESIA',
            ],
            [
                'pemasok_id' => 'TB-003',
                'nama' => 'TB. Terang',
                'alamat_1' => 'Kotamobagu Selatan',
                'provinsi' => 'Sulawesi Utara',
                'kota' => 'Kotamobagu',
                'negara' => 'INDONESIA',
            ],
            [
                'pemasok_id' => 'TB-004',
                'nama' => 'TB. Cipta Sarana',
                'alamat_1' => 'Syukur',
                'provinsi' => 'Sulawesi Utara',
                'kota' => 'Minut',
                'negara' => 'INDONESIA',
            ],
            [
                'pemasok_id' => 'TB-005',
                'nama' => 'TB. Chiko',
                'alamat_1' => 'Matungkas',
                'provinsi' => 'Sulawesi Utara',
                'kota' => 'Minut',
                'negara' => 'INDONESIA',
            ],
            [
                'pemasok_id' => 'TB-006',
                'nama' => 'TB. Harmoni',
                'alamat_1' => 'Kota Kotamobagu',
                'kota' => 'Kotamobagu',
                'negara' => 'INDONESIA',
            ],
        ];

        foreach ($data as $item) {
            Pemasok::create([
                ...$item,
                'pajak_1_id' => $pajak?->id,
                'syarat_id' => $syarat?->id,
                'mata_uang_id' => $mataUang?->id,
                'saldo_awal' => 0,
                'tanggal_saldo_awal' => now(),
            ]);
        }
    }
}
