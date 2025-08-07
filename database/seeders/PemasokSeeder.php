<?php

namespace Database\Seeders;

use App\Models\Pajak;
use App\Models\Syarat;
use App\Models\Pemasok;
use App\Models\MataUang;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PemasokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $pajak = Pajak::where('nama', 'PPN 11 %')->first();
        $syarat = Syarat::where('nama', 'C.O.D')->first();
        $mataUang = MataUang::where('kode', 'IDR')->first();

        $data = [
            [
                'pemasok_id' => 'TB-001',
                'nama' => 'TB. Cahaya Bangunan Poyowa',
                'alamat_1' => 'Jalan Siliwangi Poyowa Besar 1',
                'kota' => 'Kotamobagu',
                'kontak' => null,
                'no_telp' => '081340686823',
                'saldo_awal' => 0
            ],
            [
                'pemasok_id' => 'TB-002',
                'nama' => 'TB. Aguan',
                'alamat_1' => 'Kotamobagu Selatan',
                'kota' => 'Kotamobagu',
                'kontak' => null,
                'no_telp' => null,
                'saldo_awal' => 183500
            ],
            [
                'pemasok_id' => 'TB-003',
                'nama' => 'TB. Terang',
                'alamat_1' => 'Kotamobagu Selatan',
                'kota' => 'Kotamobagu',
            ],
            [
                'pemasok_id' => 'TB-004',
                'nama' => 'TB. Cipta Sarana',
                'alamat_1' => 'Syukur',
                'provinsi' => 'Sulawesi Utara',
                'kota' => 'Minut',
            ],
            [
                'pemasok_id' => 'TB-005',
                'nama' => 'TB. Chiko',
                'alamat_1' => 'Matungkas',
                'kota' => 'Minut',
            ],
            [
                'pemasok_id' => 'TB-006',
                'nama' => 'TB. Harmoni',
                'alamat_1' => 'Kota Kotamobagu',
                'kota' => 'Kotamobagu',
            ],
            [
                'pemasok_id' => 'TB-007',
                'nama' => 'PD Alya Putri',
                'kontak' => 'Kiking Samsikin',
                'no_telp' => '089669276467',
                'email' => 'kikingsamsikinnrsup001@gmail.com',
                'kota' => 'Garut',
            ],
            [
                'pemasok_id' => 'TB-008',
                'nama' => 'Solo Makmur Sembada',
                'kontak' => 'Teh Hikmah',
                'no_telp' => '085221506900',
                'email' => 'solomakmurnrsup002@gmail.com',
                'kota' => 'Garut',
            ],
            [
                'pemasok_id' => 'TB-009',
                'nama' => 'Andri Banyu Bening',
                'kontak' => 'Andri',
                'no_telp' => '085210245899',
                'email' => 'andribanyu@gmail.com',
                'kota' => 'Garut',
            ],
            [
                'pemasok_id' => 'TB-010',
                'nama' => 'CKA Alumunium',
                'kontak' => 'Nita',
                'no_telp' => '085219190909',
                'email' => 'ckaalumunium@gmail.com',
                'kota' => 'Garut',
            ],
            [
                'pemasok_id' => 'TB-011',
                'nama' => 'Sun Jaya Elektronik',
                'kontak' => 'Isam',
                'no_telp' => '082316972679',
                'email' => 'sunjayaelektronik@gmail.com',
                'kota' => 'Garut',
            ],
            [
                'pemasok_id' => 'TB-012',
                'nama' => 'Intan Baja Mandiri',
                'kontak' => 'Suni',
                'no_telp' => '082129036662',
                'email' => 'intanbaja@gmail.com',
                'kota' => 'Garut',
            ],
            [
                'pemasok_id' => 'TB-013',
                'nama' => 'SJB',
                'kontak' => 'Ega',
                'no_telp' => '082216385772',
                'email' => 'sinarjayabaru@gmail.com',
                'kota' => 'Garut',
            ],
            [
                'pemasok_id' => 'TB-014',
                'nama' => 'Panca Logam',
                'kontak' => 'Ali',
                'no_telp' => '082240911784',
                'email' => 'pancalogam@gmail.com',
                'kota' => 'Garut',
            ],
            [
                'pemasok_id' => 'TB-015',
                'nama' => 'Rini Bata',
                'kontak' => 'Rini',
                'no_telp' => '081221411848',
                'email' => 'rinidahlia@gmail.com',
                'kota' => 'Garut',
            ],
            [
                'pemasok_id' => 'TB-016',
                'nama' => 'Shanty Bata',
                'kontak' => 'Shanty',
                'no_telp' => '085218543419',
                'email' => 'santy@gmail.com',
                'kota' => 'Garut',
            ],
            [
                'pemasok_id' => 'TB-017',
                'nama' => 'HB Mandiri',
                'kontak' => 'Ujang Tako',
                'no_telp' => '089522244244',
                'email' => 'hbmandiri@gmail.com',
                'kota' => 'Garut',
            ],
            [
                'pemasok_id' => 'TB-018',
                'nama' => 'Bintang Mas Jaya',
                'kontak' => 'Teh Luscy',
                'no_telp' => '085220298715',
                'email' => 'luscysuherman01@gmail.com',
                'kota' => 'Garut',
            ],
        ];

        foreach ($data as $item) {
            $city = City::with('province')->where('name', 'like', '%' . $item['kota'] . '%')->first();

            if (!$city) {
                continue; // Skip jika kota tidak ditemukan
            }

            Pemasok::create([
                'pemasok_id'       => $item['pemasok_id'],
                'nama'             => $item['nama'],
                'kontak'           => $item['kontak'] ?? null,
                'no_telp'          => $item['no_telp'] ?? null,
                'email'            => $item['email'] ?? null,
                'kota_code'        => $city->code,
                'provinsi_code'    => $city->province->code,
                'pajak_1_id'       => $pajak?->id,
                'syarat_id'        => $syarat?->id,
                'mata_uang_id'     => $mataUang?->id,
                'saldo_awal'       => 0,
                'tanggal_saldo_awal' => now(),
            ]);
        }
    }
}
