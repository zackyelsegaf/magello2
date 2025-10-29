<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $money = static function ($value): int {
            if (is_numeric($value)) {
                $value = (string) $value;
            }
            $digitsOnly = preg_replace('/\D+/', '', (string) $value);
            return $digitsOnly === '' ? 0 : (int) $digitsOnly;
        };

        $tipe_barang      = DB::table('tipe_barang')->get()->toArray();
        $tipe_persediaan  = DB::table('tipe_persediaan')->get()->toArray();
        $kategori_barang  = DB::table('kategori_barang')->get()->toArray();
        $gudang           = DB::table('gudang')->get()->toArray();
        $proyek           = DB::table('proyek')->get()->toArray();
        $pemasok          = DB::table('pemasok')->get()->toArray();
        $satuan           = DB::table('satuan')->get()->toArray();

        $defaultNamaBarang = [
            'SALDO AWAL','Uang Muka','Biaya Biaya Lainnya','Biaya Pengiriman','Biaya Angkut Pembelian',
            'Jasa Pemasangan','Jasa Perakitan','Baja Ringan','Canal','Hollo-2x4 cm','Reng','Ban Dalam Bola Gerobak',
            'Ban Luar Gerobak','Batu Olahan','Batu-Bata Merah','Batu-Hollowbrick','Batu-Paving','Besi',
            'Besi-10 Inch Sertifikat','Besi-6 Inch Sertifikat','Besi-8 Inch Sertifikat','Cat Dinding',
            'Cat-Dinding Dalam','Cat-Dinding Depan Cream','Cat-Dinding Depan Grey','Cat-Dinding Depan Orange',
            'Cat-Dinding Samping ','Cat-Kayu Avian Brown','Thinner-Cat Kayu Avian ','Closet Wc','Closet-Duduk + Tabung',
            'Closet-Jongkok','Ember','Ember Biasa','Ember Cor ','Inventaris Gudang','Gerobak Dorong','Kabel TC',
            'Lampu Biasa Poyek','Lampu Sorot Proyek','Mesin-Potong Rumput','Mesin-Semprot Air','Mesin-Stumper Paving',
            'Meteran','Molen 50 Kg','Palu ','Rompi Proyek','Sepatu Boot','Skop Kayu','Tali Benang Besar','Terpal 3x4',
            'Terpal 4x6','Terpal 6x8','Topi Proyek','Inventaris Kantor','Buku ','Komputer','Kursi','Lampu Kantor',
            'Meja ','Pulpen','Sapu','Spidol','Kawat','Kawat-Bendrat','Kayu','Kayu-2x4 mm','Kayu-4x6 mm',
            'Kayu-5x10 mm','Kayu-5x12 mm','Papan-30cm 3mm','Keramik Lantai','Keramik-25x25','Keramik-40x40',
            'Nat-Keramik','Kertas Gosok','Kertas Gosok-Halus','Kertas Gosok-Kasar','Kuas','Kuas-1  Inch','Kuas-2  Inch',
            'Kuas-3  Inch','Kuas-4  Inch','Kuas-Rol','Kunci Pintu','Kunci Pintu-Rumah','Kunci Pintu-WC','Kusen',
            'Kusen-1 Set + Roster','Listrik','Box MCB','Colokan Tunggal','Fitting Lampu','Isolasi Listrik ',
            'Kabel Tunggal/Meter','Klem Pipa Listrik','MCB','Pipa Listrik 5/8  Inch','Saklar Seri','Saklar Tunggal',
            'Material Alam','Batu Belah','Batu Kerikil','Batu Mangga','Pasir','Sirtu','Tanah Timbunan','Paku Beton',
            'Paku Beton-1 Inch','Paku Beton-2 Inch','Paku Beton-3 Inch','Paku Beton-4 Inch','Paku Beton-5 Inch',
            'Paku Kayu','Paku-Kayu 1 Inch','Paku-Kayu 2 Inch','Paku-Kayu 3 Inch','Paku-Kayu 4 Inch','Paku-Kayu 5 Inch',
            'Pintu Jendela','Grendel Jendela','Hak-Angin Jendela','Pintu Jendela - 1 Set','Pintu Jendela - 1 Set',
            'Pintu-PVC WC','Pipa','Isolasi Pipa / Sealtape','Klem Pipa Air','Kran Air 1/2  Inch','Lem Pipa ',
            'Pipa-1/2  Inch','Pipa-1  Inch','Pipa-2  Inch','Pipa-3/4  Inch','Pipa-3  Inch','Pipa-4  Inch',
            'Pipa Elbow Drat 1/2  Inch','Pipa Sock Lurus-1/2  Inch','Pipa Sock Lurus-3 Inch','Pipa Sock Lurus-4 Inch',
            'Pipa-Tee-1/2  Inch','Plafond','GRC-Plafond','Kain Kasa-Kasa Plafon','Profil Kayu-Plafond','Roster',
            'Roster-Besar','Roster-Kecil','Sekrup ','Sekrup-Canal','Sekrup-GRC','Sekrup-Hollo','Sekrup-Reng',
            'Semen','Semen Bosowa','Semen Cons','Seng','Seng-Not Atap','Spandek 370 mm ','Spandek 470 mm ','Tali ',
            'Tali/Benang Nilon','Tripleks','Tripleks-3mm','Tripleks-4mm','Tripleks-6mm','Tripleks-9mm',
        ];

        $makeBarang = function (array $payload) use ($money, $tipe_barang, $tipe_persediaan, $kategori_barang, $gudang, $proyek, $pemasok, $satuan) {
            $qtyAwal   = $payload['kuantitas_saldo_awal'] ?? fake()->numberBetween(0, 40);
            $hargaAwal = $money($payload['biaya_satuan_saldo_awal'] ?? (fake()->numberBetween(1, 50) * 1000));

            return [
                'no_barang'                   => $payload['no_barang'] ?? fake()->numberBetween(1, 9999),
                'nama_barang'                 => trim($payload['nama_barang']),
                'tipe_barang'                 => $payload['tipe_barang']    ?? (Arr::random($tipe_barang)->nama ?? 'stok'),
                'dihentikan'                  => $payload['dihentikan']     ?? fake()->boolean(5),
                'tipe_persediaan'             => $payload['tipe_persediaan']?? (Arr::random($tipe_persediaan)->nama ?? 'Average'),
                'kategori_barang'             => $payload['kategori_barang']?? (Arr::random($kategori_barang)->nama ?? 'Bahan Material'),
                'deskripsi_1'                 => $payload['deskripsi_1']    ?? $payload['nama_barang'],
                'deskripsi_2'                 => $payload['deskripsi_2']    ?? fake()->sentence(fake()->randomDigitNotZero()),
                'default_gudang'              => $payload['default_gudang'] ?? (Arr::random($gudang)->nama_gudang ?? 'GUDANG-1'),
                'proyek'                      => $payload['proyek']         ?? (Arr::random($proyek)->nama_proyek ?? 'PROYEK-1'),
                'diskon'                      => (int)($payload['diskon']   ?? fake()->numberBetween(0, 20)),
                'kode_pajak'                  => $payload['kode_pajak']     ?? Arr::random(['P', 'H']),
                'pemasok'                     => $payload['pemasok']        ?? (Arr::random($pemasok)->nama ?? 'PEMASOK'),
                'minimum_kuantitas_pesan_ulang' => (int)($payload['minimum_kuantitas_pesan_ulang'] ?? fake()->numberBetween(1, 20)),
                'kuantitas_saldo_awal'        => (int)$qtyAwal,
                'biaya_satuan_saldo_awal'     => (int)$hargaAwal,
                'total_saldo_awal'            => (int)($qtyAwal * $hargaAwal),
                'kuantitas_saldo_sekarang'    => (int)$qtyAwal,
                'harga_satuan_sekarang'       => (int)$hargaAwal,
                'biaya_pokok_sekarang'        => (int)$hargaAwal,
                'gudang'                      => $payload['gudang']         ?? (Arr::random($gudang)->nama_gudang ?? 'GUDANG-1'),
                'tanggal_mulai'               => $payload['tanggal_mulai']  ?? fake()->dateTimeBetween('-2 years')->format('Y-m-d'),
                'satuan'                      => $payload['satuan']         ?? (Arr::random($satuan)->nama ?? ($payload['unit'] ?? 'Pcs')),
                'rasio'                       => 1,
                'level_harga_1'               => (int)$money($payload['level_harga_1'] ?? 0),
                'level_harga_2'               => (int)$money($payload['level_harga_2'] ?? 0),
                'level_harga_3'               => (int)$money($payload['level_harga_3'] ?? 0),
                'level_harga_4'               => (int)$money($payload['level_harga_4'] ?? 0),
                'level_harga_5'               => (int)$money($payload['level_harga_5'] ?? 0),
                'minimal_harga_jual'          => (int)$money($payload['minimal_harga_jual'] ?? 0),
                'maksimal_harga_jual'         => (int)$money($payload['maksimal_harga_jual'] ?? 0),
                'minimal_harga_beli'          => (int)$money($payload['minimal_harga_beli'] ?? 0),
                'maksimal_harga_beli'         => (int)$money($payload['maksimal_harga_beli'] ?? 0),
                'nomor_upc'                   => $payload['nomor_upc'] ?? fake()->isbn10(),
                'nomor_plu'                   => $payload['nomor_plu'] ?? fake()->ean8(),
            ];
        };

        foreach ($defaultNamaBarang as $nama) {
            Barang::create($makeBarang([
                'nama_barang'               => $nama,
                'biaya_satuan_saldo_awal'   => fake()->numberBetween(1, 50) * 1000, 
                'satuan'                    => Arr::random(['Pcs','Unit','Dus','Meter','M3','Sak','Batang','Lembar','Rol','Kg']),
            ]));
        }

        $csvPath = base_path('database/csvs/barang_from_pdfs.csv');
        if (file_exists($csvPath)) {
            $csv = Reader::createFromPath($csvPath, 'r');
            $csv->setHeaderOffset(0);
            foreach ($csv->getRecords() as $row) {
                Barang::create($makeBarang([
                    'nama_barang'               => (string)($row['nama_barang'] ?? ''),
                    'biaya_satuan_saldo_awal'   => $row['harga_beli'] ?? 0,
                    'satuan'                    => $row['unit'] ?? 'Pcs',
                    'deskripsi_1'               => (string)($row['nama_barang'] ?? ''),
                    'deskripsi_2'               => 'Imported from ' . ($row['sumber_pdf'] ?? 'PDF'),
                    'kategori_barang'           => 'Bahan Material',
                    'minimal_harga_beli'        => $row['harga_beli'] ?? 0,
                    'maksimal_harga_beli'       => $row['harga_beli'] ?? 0,
                    'minimal_harga_jual'        => $row['harga_beli'] ?? 0,
                    'maksimal_harga_jual'       => $row['harga_beli'] ?? 0,
                ]));
            }
        } else {
            $this->command->warn("CSV barang_from_pdfs.csv tidak ditemukan. Lewati import PDF.");
        }
    }
}
