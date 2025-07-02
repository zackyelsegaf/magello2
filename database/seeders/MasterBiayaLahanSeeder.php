<?php

namespace Database\Seeders;

use App\Models\Akun;
use Illuminate\Database\Seeder;
use App\Models\MasterBiayaLahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterBiayaLahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Akta & BPHTB', 'perolehan' => '11006.13', 'closing' => '51001.12'],
            ['nama' => 'BP PDAM & Jaringan Pipa', 'perolehan' => '11006.13', 'closing' => '51001.13'],
            ['nama' => 'BP Listrik/unit', 'perolehan' => '11006.13', 'closing' => '51001.14'],
            ['nama' => 'Biaya IMB Induk', 'perolehan' => '11006.13', 'closing' => '51001.19'],
            ['nama' => 'Biaya Sertifikat Split + balik nama', 'perolehan' => '11006.13', 'closing' => '51001.15'],
            ['nama' => 'Cut and field', 'perolehan' => '11006.13', 'closing' => '51001.16'],
            ['nama' => 'Pengukuran dan Kontur', 'perolehan' => '11006.13', 'closing' => '51001.16'],
            ['nama' => 'UKL UPL', 'perolehan' => '11006.13', 'closing' => '51001.17'],
            ['nama' => 'Andalalin', 'perolehan' => '11006.13', 'closing' => '51001.17'],
            ['nama' => 'Biaya Srt. Ket. Ijin Lokasi', 'perolehan' => '11006.13', 'closing' => '51001.17'],
            ['nama' => 'Biaya Aspek PT/PGT(BPN)', 'perolehan' => '11006.13', 'closing' => '51001.17'],
            ['nama' => 'Biaya Rekomendasi Team 9', 'perolehan' => '11006.13', 'closing' => '51001.17'],
            ['nama' => 'Biaya Ijin Prinsip/IPPT', 'perolehan' => '11006.13', 'closing' => '51001.17'],
            ['nama' => 'Biaya Pembelian/Pembebasan lahan', 'perolehan' => '11006.13', 'closing' => '51001.18'],
        ];

        foreach ($data as $item) {
            $akunPerolehan = Akun::where('no_akun', $item['perolehan'])->first();
            $akunClosing = Akun::where('no_akun', $item['closing'])->first();

            if ($akunPerolehan && $akunClosing) {
                MasterBiayaLahan::create([
                    'nama_biaya' => $item['nama'],
                    'akun_perolehan_id' => $akunPerolehan->id,
                    'akun_closing_id' => $akunClosing->id,
                ]);
            }
        }
    }
}
