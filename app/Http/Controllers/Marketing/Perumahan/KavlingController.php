<?php

namespace App\Http\Controllers\Marketing\Perumahan;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Kapling;
use App\Models\Arsip;
use App\Models\City;
use App\Models\District;
use App\Models\Province;
use App\Models\Village;
use App\Models\BookingKavling;
use App\Models\DokumenBooking;
use App\Models\ArsipFile;
use App\Models\JadwalBiayaBooking;
use App\Models\BiayaBooking;
use App\Models\SuratPemesananRumah;
use App\Models\BookingStatus0Pemberkasan;
use App\Models\BookingStatus1Proses;
use App\Models\BookingStatus2AnalisaBank;
use App\Models\BookingStatus3Sp3k;
use App\Models\BookingStatus4AkadKredit;
use App\Models\BookingStatus5Ajb;
use App\Models\BookingStatus6DitolakBank;
use App\Models\BookingStatus7Mundur;
use App\Models\BookingTimeline;
use Barryvdh\DomPDF\Facade\Pdf;

class KavlingController extends Controller
{
    public function kavlingList()
    {
        $cluster = DB::table('cluster')->get();
        $rap_rab = DB::table('rap_rab')->get();
        return view('marketing.perumahan.kavling.kavling', compact('cluster', 'rap_rab'));
    }

    public function bookingList()
    {
        $cluster = DB::table('cluster')->get();
        $rap_rab = DB::table('rap_rab')->get();
        return view('booking.listbooking', compact('cluster', 'rap_rab'));
    }

    public function kavlingAddNew()
    {
        $cluster = DB::table('cluster')->get();
        // Filter tabel rab berdasarkan tipe_model = Kapling
        $rap_rab = DB::table('rap_rab')->where('tipe_model', 'Kapling')->get();
        return view('marketing.perumahan.kavling.kavlingaddnew', compact('cluster', 'rap_rab'));
    }

    public function saveRecordKavlingBooking(Request $request)
    {
        $rules =  [
            'kapling_id'        => 'required|exists:kapling,id',
            'konsumen_id'       => 'required|exists:konsumen,id',
            'tanggal_booking'   => 'nullable|string|max:255',
            'metode_pembayaran' => 'required|string|max:255',
            'spr_id'            => 'nullable|string|max:255',
            'status_pengajuan'  => 'nullable|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $data = $validator->validated();
            
            if (!empty($data['tanggal_booking'])) {
                $data['tanggal_booking'] = Carbon::createFromFormat('d/m/Y', $data['tanggal_booking'])->format('Y-m-d');
            }

            $bookingKavling = new BookingKavling($data);
            $bookingKavling->save();

            $costs = (array) $request->input('costs', []);

            $moneyToNumeric = function ($value) {
                if ($value === null) return null;
                $digits = preg_replace('/[^\d]/', '', (string) $value);
                return $digits === '' ? null : $digits;
            };

            $parseDateDMY = function ($value) {
                if (empty($value)) return null;
                try {
                    return Carbon::parse($value)->format('Y-m-d');
                } catch (\Throwable $e) {
                    return $value;
                }
            };

            foreach ($costs as $jenisId => $payload) {
                $amountRaw     = $payload['amount']   ?? null;
                $discountRaw   = $payload['discount'] ?? null;
                $useDiscount   = !empty($payload['use_discount']);
                $useSchedule   = !empty($payload['use_schedule']);
                $schedules     = isset($payload['schedules']) && is_array($payload['schedules'])
                                    ? $payload['schedules'] : [];

                $amount   = $moneyToNumeric($amountRaw);
                $discount = $moneyToNumeric($discountRaw);

                $hasSchedules = count(array_filter($schedules, function ($row) {
                    return !empty($row['due_date']) || !empty($row['amount']);
                })) > 0;

                if (is_null($amount) && is_null($discount) && !$hasSchedules) {
                    continue;
                }

                $biaya = BiayaBooking::updateOrCreate(
                    [
                        'booking_id'    => (int) $bookingKavling->id,
                        'jenis_biaya_id'=> (int) $jenisId,
                    ],
                    [
                        'use_jadwal'     => $useSchedule,
                        'nominal_biaya'  => $amount,
                        'use_diskon'     => $useDiscount,
                        'nominal_diskon' => $useDiscount ? $discount : null,
                    ]
                );

                JadwalBiayaBooking::where('biaya_booking_id', $biaya->id)->delete();

                $urut = 1;
                foreach ($schedules as $row) {
                    $due   = $parseDateDMY($row['due_date'] ?? null);
                    $amt   = $moneyToNumeric($row['amount'] ?? null);

                    if (empty($due) && is_null($amt)) continue;

                    JadwalBiayaBooking::create([
                        'biaya_booking_id'   => $biaya->id,
                        'urutan'             => $urut++,
                        'tanggal_bayar'      => $due,     // di migrasi: string; kalau kamu ubah ke date, ini sudah Y-m-d
                        'nominal_pembayaran' => $amt,
                    ]);
                }
            }


            $disk     = config('filesystems.default', 'public');
            $bookingId = (int) $bookingKavling->id;
            $baseDir  = "arsip/booking/{$bookingId}";

            $max = (int) $request->input('arsip_counter', 0);
            for ($i = 1; $i <= $max; $i++) {
                $jenisId  = $request->input("jenis_dokumen_persyaratan_id_{$i}");
                $uploaded = $request->file("file_arsip_{$i}");

                if (!$uploaded) {
                    continue;
                }

                if (!$jenisId) {
                    DB::rollBack();
                    sweetalert()->warning("Jenis dokumen tidak dikenali pada baris #{$i}.");
                    return redirect()->back()->withInput();
                }

                $ext  = strtolower($uploaded->getClientOriginalExtension());
                $size = $uploaded->getSize();

                if (!in_array($ext, ['pdf','jpg','jpeg','png','doc','docx'])) {
                    DB::rollBack();
                    sweetalert()->warning("Tipe file pada baris #{$i} tidak diperbolehkan. Hanya PDF/JPG/PNG/DOC/DOCX.");
                    return redirect()->back()->withInput();
                }
                if ($size > 20 * 1024 * 1024) {
                    DB::rollBack();
                    sweetalert()->warning("Ukuran file pada baris #{$i} melebihi 20MB.");
                    return redirect()->back()->withInput();
                }

                $dokumen = DokumenBooking::firstOrCreate(
                    [
                        'booking_id' => $bookingId,
                        'jenis_dokumen_persyaratan_id' => $jenisId,
                    ],
                    [
                        'is_submitted' => false,
                        'submitted_at' => null,
                    ]
                );

                $subdir   = "{$baseDir}/jenis/{$jenisId}";
                $ext      = $uploaded->getClientOriginalExtension();
                $filename = now()->format('Ymd_His') . '_' . Str::random(8) . ($ext ? ".{$ext}" : '');
                $path     = $uploaded->storeAs($subdir, $filename, $disk);

                $dokumen->files()->create([
                    'disk'           => $disk,
                    'file_arsip'     => $path,
                    'original_name'  => $uploaded->getClientOriginalName(),
                    'mime_type'      => $uploaded->getMimeType(),
                    'file_size'      => $uploaded->getSize(),
                    'uploaded_by'    => auth()->id(),
                ]);

                $dokumen->is_submitted = true;
                $dokumen->submitted_at = now();
                $dokumen->save();
            }

            DB::commit();
            sweetalert()->success('Create new Barang & Detail successfully :)');
            return redirect()->route('booking/list/page');

        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function saveRecordKavling(Request $request)
    {
        $rules =  [
            'cluster_id' => 'required|exists:cluster,id',
            'rap_rab_id' => 'required|exists:rap_rab,id',
            'tipe_model' => 'nullable|string|max:255',
            'blok_kapling' => 'required|string|max:255',
            'nomor_unit_kapling' => 'required|string|max:255',
            'jumlah_lantai' => 'required|string|max:255',
            'luas_tanah' => 'required|string|max:255',
            'luas_bangunan' => 'required|string|max:255',
            'harga_kapling' => 'required|string|max:255',
            'spesifikasi' => 'required|string|max:255',
            'status_penjualan' => 'nullable|string|max:255',
            'status_pembangunan' => 'nullable|string|max:255'
        ];

        $message = [
            'cluster_id.required' => 'Cluster is required.',
            'rap_rab_id.required' => 'RAP/RAB is required.',
            'blok_kapling.required' => 'Blok Kavling is required.',
            'nomor_unit_kapling.required' => 'Nomor Unit Kavling is required.',
            'jumlah_lantai.required' => 'Jumlah Lantai is required.',
            'luas_tanah.required' => 'Luas Tanah is required.',
            'luas_bangunan.required' => 'Luas Bangunan is required.',
            'harga_kapling.required' => 'Harga Kavling is required.',
            'spesifikasi.required' => 'Spesifikasi is required.'
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $kapling = new Kapling($validator->validated());
            $kapling->save();

            DB::commit();
            sweetalert()->success('Create new Barang & Detail successfully :)');
            return redirect()->route('kavling/list/page');
            
        } catch (\Exception $e) {
            DB::rollback();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function saveRecordSpr(Request $request)
    {
        $rules =  [
            'booking_id'         => 'required|exists:booking_kavling,id',
            'nomor_spr'          => 'nullable|string|max:255',
            'tanggal_pemesanan'  => 'required|string|max:255',
            'lokasi_pemesanan'   => 'required|string|max:255',
            'deskripsi'          => 'nullable|string',
        ];

        $message = [
            'booking_id.required'        => 'Booking ID is required.',
            'tanggal_pemesanan.required' => 'Tanggal pemesanan is required.',
            'lokasi_pemesanan.required'  => 'Lokasi pemesanan is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $data    = $validator->validated();
            $booking = BookingKavling::findOrFail($data['booking_id']);

            if (empty($data['nomor_spr'])) {
                $data['nomor_spr'] = 'SPR' . substr($booking->nomor_booking, 2);
            }

            $spr = new SuratPemesananRumah($data);
            $spr->save();

            $booking->spr_id = $spr->id;
            $booking->save();

            DB::commit();
            sweetalert()->success('SPR berhasil dibuat.');
            return redirect()->route('booking/list/page');

        } catch (\Exception $e) {
            DB::rollBack();
            sweetalert()->error('Tambah Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function kavlingAddBooking($id)
    {
        $kavling = Kapling::with('activeBooking')->findOrFail($id);

        if ($kavling->is_booked) {
            sweetalert()->warning('Tidak bisa membuat booking baru.', [
                'title' => 'Sudah dibooking',
            ]);
            return redirect()->route('kavling/edit', $kavling->id);
        }
        $jenisBiaya = DB::table('jenis_biaya_konsumen')->orderBy('urutan')->get();
        $jenisBiayaByNama = DB::table('jenis_biaya_konsumen')->pluck('id', 'nama');
        $jenisDokumen = DB::table('jenis_dokumen_persyaratan')->orderBy('urutan')->get();
        $jenisByNama = DB::table('jenis_dokumen_persyaratan')->pluck('id', 'nama');

        $ruleByBiaya = [
            'Cash Keras' => [
                'Booking Fee',
                'Biaya Administrasi',
                'Uang Muka',
                'Biaya Kelebihan Tanah',
                'Biaya Penambahan Bangunan',
                'Biaya Lainnya',
                'Total Penjualan Cash',
            ],
            'Cash Bertahap' => [
                'Booking Fee',
                'Biaya Administrasi',
                'Uang Muka',
                'Biaya Kelebihan Tanah',
                'Biaya Penambahan Bangunan',
                'Biaya Lainnya',
                'Cicilan Cash (Bertahap)',
            ],
            'KPR' => [
                'Booking Fee',
                'Uang Muka',
                'Biaya Kelebihan Tanah',
                'Biaya Penambahan Bangunan',
                'Biaya Lainnya',
                'Biaya Akad Kredit',
                'Biaya Penambahan Fasilitas',
                'Penerimaan KPR dari Bank',
            ],
        ];

        $showIdsByBiaya = [];
        foreach ($ruleByBiaya as $metode => $namaList) {
            $ids = [];
            foreach ($namaList as $nama) {
                if (isset($jenisBiayaByNama[$nama])) $ids[] = (int) $jenisBiayaByNama[$nama];
            }
            $showIdsByBiaya[$metode] = $ids;
        }

        $ruleByMetode = [
            'Cash Keras' => [
                'Surat Perjanjian Cash Bertahap',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
                'Pas Photo 3x4',
            ],
            'Cash Bertahap' => [
                'Surat Perjanjian Cash Bertahap',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
                'Pas Photo 3x4',
            ],
            'KPR' => [
                'SBOM',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
                'Pas Photo 3x4',
                'FC Buku Tabungan',
                'NPWP',
                'Slip Gaji',
                'Surat Keterangan Kerja',
                'Rekening Koran',
                'Surat Keterangan Belum Memiliki Rumah',
                'Surat Keterangan Usaha (Wiraswasta)',
                'Neraca Keuangan (Wirausaha)',
            ],
        ];

        $showIdsByMetode = [];
        foreach ($ruleByMetode as $metode => $namaList) {
            $ids = [];
            foreach ($namaList as $nama) {
                if (isset($jenisByNama[$nama])) $ids[] = (int) $jenisByNama[$nama];
            }
            $showIdsByMetode[$metode] = $ids;
        }
        
        $cluster = DB::table('cluster')
            ->leftJoin('kapling','kapling.cluster_id','=','cluster.id')
            ->select(
                'cluster.id as cluster_id',
                'cluster.nama_cluster',
                'kapling.id as kapling_id',
                'kapling.blok_kapling',
                'kapling.nomor_unit_kapling'
            )
            ->orderBy('cluster.nama_cluster')
            ->orderBy('kapling.blok_kapling')
            ->get()
            ->groupBy('cluster_id');
        $konsumen = DB::table('konsumen')->get();
        $rap_rab = DB::table('rap_rab')->get();

        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $nomorPreview = BookingKavling::generateNomorBooking($today);

        return view('marketing.perumahan.kavling.kavlingbookingaddnew', compact('jenisDokumen','jenisBiaya','kavling', 'cluster', 'konsumen', 'rap_rab', 'nomorPreview', 'showIdsByMetode', 'showIdsByBiaya'));
    }

    public function kavlingAddSpr(BookingKavling $booking)
    {
        $kota = DB::table('kota')
            ->select('id', 'nama')
            ->union(
                DB::table('provinsi')->select('id', 'nama')
            )
            ->orderBy('nama')
            ->get();

        if (empty($booking->nomor_booking)) {
            $tanggal = $booking->tanggal_booking ?? Carbon::now('Asia/Jakarta')->toDateString();
            $booking->tanggal_booking = $tanggal;
            $booking->nomor_booking   = BookingKavling::generateNomorBooking($tanggal);
            $booking->save();
        }

        $nomorPreview = 'SPR' . substr($booking->nomor_booking, 2);

        return view('marketing.perumahan.kavling.spraddnew', compact('kota','nomorPreview', 'booking'));
    }

    public function addStatusBooking(BookingKavling $booking)
    {
        // $activeCode = BookingTimeline::where('booking_id', $booking->id)
        //     ->where('is_current', 1)
        //     ->value('status_code');
            
        $detailPemberkasan = BookingStatus0Pemberkasan::where('booking_id', $booking->id)->first();
        $detailProses      = BookingStatus1Proses::where('booking_id', $booking->id)->first();
        $detailAnalisa     = BookingStatus2AnalisaBank::where('booking_id', $booking->id)->first();
        $detailSp3k        = BookingStatus3Sp3k::where('booking_id', $booking->id)->first();
        $detailAkad        = BookingStatus4AkadKredit::where('booking_id', $booking->id)->first();
        $detailAjb         = BookingStatus5Ajb::where('booking_id', $booking->id)->first();
        $detailDitolakBank = BookingStatus6DitolakBank::where('booking_id', $booking->id)->first();
        $detailMundur      = BookingStatus7Mundur::where('booking_id', $booking->id)->first();
        $arsip0 = collect();
        if ($detailSp3k) {
            $arsip0 = $detailSp3k->arsipFiles()
                ->latest('id')
                ->get()
                ->map(function ($a) {
                    return [
                        'id'               => $a->id,
                        'nama_arsip'       => $a->nama_arsip,
                        'nomor_arsip'      => $a->nomor_arsip,
                        'keterangan_arsip' => $a->keterangan_arsip,
                        'original_name'    => $a->original_name,
                        'file_url'         => $a->file_arsip ? Storage::url($a->file_arsip) : null,
                        'file_label'       => 'Ganti File',
                    ];
                });
        }

        $arsip1 = collect();
        if ($detailDitolakBank) {
            $arsip1 = $detailDitolakBank->arsipFiles()
                ->latest('id')
                ->get()
                ->map(function ($a) {
                    return [
                        'id'               => $a->id,
                        'nama_arsip'       => $a->nama_arsip,
                        'nomor_arsip'      => $a->nomor_arsip,
                        'keterangan_arsip' => $a->keterangan_arsip,
                        'original_name'    => $a->original_name,
                        'file_url'         => $a->file_arsip ? Storage::url($a->file_arsip) : null,
                        'file_label'       => 'Ganti File',
                    ];
                });
        }

        $has0     = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 0)->whereIn('is_current', [0,1])->exists();
        $isAktif0 = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 0)->where('is_current', 1)->exists();

        $has1     = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 1)->whereIn('is_current', [0,1])->exists();
        $isAktif1 = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 1)->where('is_current', 1)->exists();

        $has2     = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 2)->whereIn('is_current', [0,1])->exists();
        $isAktif2 = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 2)->where('is_current', 1)->exists();

        $has3     = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 3)->whereIn('is_current', [0,1])->exists();
        $isAktif3 = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 3)->where('is_current', 1)->exists();

        $has4     = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 4)->whereIn('is_current', [0,1])->exists();
        $isAktif4 = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 4)->where('is_current', 1)->exists();

        $has5     = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 5)->whereIn('is_current', [0,1])->exists();
        $isAktif5 = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 5)->where('is_current', 1)->exists();

        $has6     = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 6)->whereIn('is_current', [0,1])->exists();
        $isAktif6 = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 6)->where('is_current', 1)->exists();

        $has7     = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 7)->whereIn('is_current', [0,1])->exists();
        $isAktif7 = BookingTimeline::where('booking_id', $booking->id)->where('status_code', 7)->where('is_current', 1)->exists();
            
        $timelineBooking = BookingTimeline::where('booking_id', $booking->id)
            ->where('status_code', 0)
            ->latest('changed_at')
            ->first();

        $kota = DB::table('kota')
            ->select('id', 'nama')
            ->union(
                DB::table('provinsi')->select('id', 'nama')
            )
            ->orderBy('nama')
            ->get();

        if (empty($booking->nomor_booking)) {
            $tanggal = $booking->tanggal_booking ?? Carbon::now('Asia/Jakarta')->toDateString();
            $booking->tanggal_booking = $tanggal;
            $booking->nomor_booking   = BookingKavling::generateNomorBooking($tanggal);
            $booking->save();
        }

        $tanggalPemberkasan = optional($detailPemberkasan)->tanggal_pemberkasan;
        $tanggalProses = optional($detailProses)->tanggal_masuk_bank;
        $tanggalAnalisa = optional($detailAnalisa)->tanggal_masuk_analisa_bank;
        $tanggalSp3k = optional($detailSp3k)->tanggal_sp3k;
        $tanggalAkad = optional($detailAkad)->tanggal_akad;
        $tanggalAjb = optional($detailAjb)->tanggal_ajb;
        $tanggalDitolakBank = optional($detailDitolakBank)->tanggal_ditolak;
        $tanggalMundur = optional($detailMundur)->tanggal_mundur;

        $tanggalPemberkasan = $tanggalPemberkasan ? Carbon::parse($tanggalPemberkasan)->format('d/m/Y') : null;
        $tanggalProses      = $tanggalProses ? Carbon::parse($tanggalProses)->format('d/m/Y') : null;
        $tanggalAnalisa     = $tanggalAnalisa ? Carbon::parse($tanggalAnalisa)->format('d/m/Y') : null;
        $tanggalSp3k        = $tanggalSp3k ? Carbon::parse($tanggalSp3k)->format('d/m/Y') : null;
        $tanggalAkad        = $tanggalAkad ? Carbon::parse($tanggalAkad)->format('d/m/Y') : null;
        $tanggalAjb         = $tanggalAjb ? Carbon::parse($tanggalAjb)->format('d/m/Y') : null;
        $tanggalDitolakBank = $tanggalDitolakBank ? Carbon::parse($tanggalDitolakBank)->format('d/m/Y') : null;
        $tanggalMundur      = $tanggalMundur ? Carbon::parse($tanggalMundur)->format('d/m/Y') : null;

        $nomorPreview = 'SPR' . substr($booking->nomor_booking, 2);

        return view('marketing.perumahan.kavling.statusbookingaddnew', compact('kota','nomorPreview', 'booking', 'detailPemberkasan', 'timelineBooking', 'detailProses', 'detailAnalisa', 'detailSp3k', 'arsip0', 'arsip1', 'detailAkad', 'detailAjb', 'detailDitolakBank', 'detailMundur', 'tanggalPemberkasan', 'tanggalProses', 'tanggalAnalisa', 'tanggalSp3k', 'tanggalAkad', 'tanggalAjb', 'tanggalDitolakBank', 'tanggalMundur', 'has0', 'has1', 'has2', 'has3', 'has4', 'has5', 'has6', 'has7', 'isAktif0', 'isAktif1', 'isAktif2', 'isAktif3', 'isAktif4', 'isAktif5', 'isAktif6', 'isAktif7'));
    }

    // public function storePemberkasan(Request $request, $booking_id)
    // {
    //     $rules = [
    //         'tanggal_pemberkasan' => 'nullable|string|max:255',
    //         'catatan_pemberkasan' => 'nullable|string',
    //         'action'              => 'nullable|string|in:save,set',
    //     ];

    //     $validator = Validator::make($request->all(), $rules);
    //     if ($validator->fails()) {
    //         sweetalert()->error('Validasi gagal! Mohon lengkapi data.');
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     DB::beginTransaction();
    //     try {
    //         $booking = BookingKavling::findOrFail($booking_id);

    //         $timeline = new BookingTimeline();
    //         $timeline->booking_id         = $booking->id;
    //         $timeline->status_code        = 0;
    //         $timeline->notes              = $request->catatan_pemberkasan;
    //         $timeline->changed_by         = auth()->id();
    //         $timeline->changed_at         = now();
    //         $timeline->statusable_id      = $booking->id;
    //         $timeline->statusable_type    = BookingKavling::class;
    //         $timeline->save();

    //         if ($request->action === 'set') {
    //             $booking->status_pengajuan = 0;
    //             $booking->save();
    //         }

    //         DB::commit();
    //         sweetalert()->success($request->action === 'set' ? 'Status berhasil diubah ke Pemberkasan.' : 'Data pemberkasan berhasil disimpan.');
    //         return redirect()->back();

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         sweetalert()->error('Gagal menyimpan data: ' . $e->getMessage());
    //         return redirect()->back()->withInput();
    //     }
    // }

    // public function storePemberkasan(Request $request, $booking_id)
    // {
    //     $rules = [
    //         'tanggal_pemberkasan' => 'nullable|string|max:255',
    //         'catatan_pemberkasan' => 'nullable|string',
    //         'action'              => 'nullable|string|in:save,set',
    //     ];

    //     $validator = Validator::make($request->all(), $rules);
    //     if ($validator->fails()) {
    //         sweetalert()->error('Validasi gagal! Mohon lengkapi data.');
    //         return back()->withErrors($validator)->withInput();
    //     }

    //     DB::beginTransaction();
    //     try {
    //         $booking = BookingKavling::findOrFail($booking_id);

    //         $detail = BookingStatus0Pemberkasan::updateOrCreate(
    //             ['booking_id' => $booking->id],
    //             [
    //                 'tanggal_pemberkasan' => $request->tanggal_pemberkasan,
    //                 'catatan_pemberkasan' => $request->catatan_pemberkasan,
    //                 'updated_by'          => auth()->id() ?? null,
    //             ]
    //         );

    //         BookingTimeline::create([
    //             'booking_id'      => $booking->id,
    //             'status_code'     => 0,
    //             'notes'           => $request->catatan_pemberkasan,
    //             'changed_by'      => auth()->id(),
    //             'changed_at'      => now(),
    //             'statusable_id'   => $detail->id,
    //             'statusable_type' => BookingStatus0Pemberkasan::class,
    //         ]);

    //         if ($request->action === 'set') {
    //             $booking->update(['status_pengajuan' => 0]);
    //         }

    //         DB::commit();
    //         sweetalert()->success($request->action === 'set' ? 'Status berhasil diubah ke Pemberkasan.' : 'Data pemberkasan berhasil disimpan.');
    //         return back();

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         sweetalert()->error('Gagal menyimpan data: ' . $e->getMessage());
    //         return back()->withInput();
    //     }
    // }

    // public function storePemberkasan(Request $request, $booking_id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'tanggal_pemberkasan' => 'nullable|string|max:255',
    //         'catatan_pemberkasan' => 'nullable|string',
    //         'action'              => 'nullable|in:save,set',
    //     ]);

    //     if ($validator->fails()) {
    //         sweetalert()->error('Validasi gagal! Mohon lengkapi data.');
    //         return back()->withErrors($validator)->withInput();
    //     }

    //     DB::beginTransaction();
    //     try {
    //         $booking = BookingKavling::findOrFail($booking_id);

    //         $detail = BookingStatus0Pemberkasan::updateOrCreate(
    //             ['booking_id' => $booking->id],
    //             [
    //                 'tanggal_pemberkasan' => $request->tanggal_pemberkasan,
    //                 'catatan_pemberkasan'             => $request->catatan_pemberkasan,
    //             ]
    //         );
    //         BookingTimeline::where('booking_id', $booking->id)
    //             ->where('status_code', 0) // pemberkasan
    //             ->where('statusable_type', BookingStatus0Pemberkasan::class)
    //             ->delete();

    //         // 3) Buat timeline baru via relasi (auto isi statusable_id/type)
    //         $detail->timeline()->create([
    //             'booking_id'  => $booking->id,
    //             'status_code' => 0,
    //             'notes'       => $request->catatan_pemberkasan,
    //             'changed_by'  => auth()->id(),
    //             'changed_at'  => now(),
    //         ]);

    //         // 4) Optional: update status utama kalau klik "Set Status"
    //         if ($request->action === 'set') {
    //             $booking->update(['status_pengajuan' => 0]);
    //         }

    //         DB::commit();
    //         sweetalert()->success($request->action === 'set'
    //             ? 'Status berhasil diubah ke Pemberkasan.'
    //             : 'Data pemberkasan berhasil disimpan.');
    //         return back();

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         sweetalert()->error('Gagal menyimpan data: '.$e->getMessage());
    //         return back()->withInput();
    //     }
    // }

    public function storePemberkasan(Request $request, $booking_id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_pemberkasan' => 'nullable|string|max:255',
            'catatan_pemberkasan' => 'nullable|string',
            'action'              => 'nullable|in:save,set',
        ]);
        if ($validator->fails()) {
            sweetalert()->error('Validasi gagal! Mohon lengkapi data.');
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $booking = BookingKavling::findOrFail($booking_id);

            $detail = BookingStatus0Pemberkasan::updateOrCreate(
                ['booking_id' => $booking->id],
                [
                    'tanggal_pemberkasan' => $request->tanggal_pemberkasan ? Carbon::createFromFormat('d/m/Y', $request->tanggal_pemberkasan)->format('Y-m-d') : null,
                    'catatan_pemberkasan' => $request->catatan_pemberkasan,
                ]
            );

            $timeline = BookingTimeline::updateOrCreate(
                [
                    'booking_id'      => $booking->id,
                    'status_code'     => 0,
                    'statusable_type' => BookingStatus0Pemberkasan::class,
                ],
                [
                    'statusable_id' => $detail->id,
                    'notes'         => $request->catatan_pemberkasan,
                    'changed_by'    => auth()->id(),
                    'changed_at'    => now(),
                ]
            );

            if ($request->action === 'save') {

                $timeline->update(['is_current' => '']);
            }

            if ($request->action === 'set') {
                $label = "Pemberkasan";
                if (!empty($detail->tanggal_pemberkasan)) {
                    $label .= '<strong>'."<br>Tanggal: {$detail->tanggal_pemberkasan}".'</strong>';
                }

                $booking->update(['status_pengajuan' => $label]);

                BookingTimeline::where('booking_id', $booking->id)->update(['is_current' => false]);

                $timeline->update(['is_current' => true]);
            }


            DB::commit();
            sweetalert()->success($request->action === 'set'
                ? 'Status berhasil diubah ke Pemberkasan.'
                : 'Data pemberkasan berhasil disimpan.');
            return  redirect()->route('booking/list/page');

        } catch (\Exception $e) {
            DB::rollBack();
            sweetalert()->error('Gagal menyimpan data: '.$e->getMessage());
            return back()->withInput();
        }
    }

    public function storeProses(Request $request, $booking_id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_masuk_bank'  => 'nullable|string|max:255',
            'nama_bank_proses'    => 'nullable|string|max:255',
            'catatan_proses'      => 'nullable|string',
            'action'              => 'nullable|in:save,set',
        ]);
        if ($validator->fails()) {
            sweetalert()->error('Validasi gagal! Mohon lengkapi data.');
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $booking = BookingKavling::findOrFail($booking_id);

            $detail = BookingStatus1Proses::updateOrCreate(
                ['booking_id' => $booking->id],
                [
                    'tanggal_masuk_bank'  => $request->tanggal_masuk_bank ? Carbon::createFromFormat('d/m/Y', $request->tanggal_masuk_bank)->format('Y-m-d') : null,
                    'nama_bank_proses'    => $request->nama_bank_proses,
                    'catatan_proses' => $request->catatan_proses,
                ]
            );

            $timeline = BookingTimeline::updateOrCreate(
                [
                    'booking_id'      => $booking->id,
                    'status_code'     => 1,
                    'statusable_type' => BookingStatus1Proses::class,
                ],
                [
                    'statusable_id' => $detail->id,
                    'notes'         => $request->catatan_proses,
                    'changed_by'    => auth()->id(),
                    'changed_at'    => now(),
                ]
            );

            if ($request->action === 'save') {

                $timeline->update(['is_current' => '']);
            }

            if ($request->action === 'set') {
                // $parts = [];
                // if (!empty($detail->tanggal_masuk_bank)) {
                //     $parts[] = 'Tanggal: '.$detail->tanggal_masuk_bank;
                // }
                // if (!empty($detail->nama_bank_proses)) {
                //     $parts[] = 'Bank: '.$detail->nama_bank_proses;
                // }

                $label = "Proses Ke Bank";
                if (!empty($detail->tanggal_masuk_bank)) {
                    $label .= '<strong>'."<br>Tanggal: {$detail->tanggal_masuk_bank}".'</strong>';
                }
                if (!empty($detail->nama_bank_proses)) {
                    $label .= '<strong>'."<br>Bank: {$detail->nama_bank_proses}".'</strong>';
                }

                $booking->update(['status_pengajuan' => $label]);

                BookingTimeline::where('booking_id', $booking->id)->update(['is_current' => false]);

                $timeline->update(['is_current' => true]);
            }

            DB::commit();
            sweetalert()->success($request->action === 'set'
                ? 'Status berhasil diubah ke Proses Ke Bank.'
                : 'Data Proses Ke Bank berhasil disimpan.');
            return  redirect()->route('booking/list/page');

        } catch (\Exception $e) {
            DB::rollBack();
            sweetalert()->error('Gagal menyimpan data: '.$e->getMessage());
            return back()->withInput();
        }
    }

    public function storeAnalisa(Request $request, $booking_id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_masuk_analisa_bank' => 'nullable|string|max:255',
            'nama_bank_analisa'          => 'nullable|string|max:255',
            'catatan_analisa'            => 'nullable|string',
            'action'                     => 'nullable|in:save,set',
        ]);
        if ($validator->fails()) {
            sweetalert()->error('Validasi gagal! Mohon lengkapi data.');
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $booking = BookingKavling::findOrFail($booking_id);

            $detail = BookingStatus2AnalisaBank::updateOrCreate(
                ['booking_id' => $booking->id],
                [
                    'tanggal_masuk_analisa_bank'  => $request->tanggal_masuk_analisa_bank ? Carbon::createFromFormat('d/m/Y', $request->tanggal_masuk_analisa_bank)->format('Y-m-d') : null,
                    'nama_bank_analisa'    => $request->nama_bank_analisa,
                    'catatan_analisa' => $request->catatan_analisa,
                ]
            );

            $timeline = BookingTimeline::updateOrCreate(
                [
                    'booking_id'      => $booking->id,
                    'status_code'     => 2,
                    'statusable_type' => BookingStatus2AnalisaBank::class,
                ],
                [
                    'statusable_id' => $detail->id,
                    'notes'         => $request->catatan_analisa,
                    'changed_by'    => auth()->id(),
                    'changed_at'    => now(),
                ]
            );

            if ($request->action === 'save') {

                $timeline->update(['is_current' => '']);
            }

            if ($request->action === 'set') {
                // $parts = [];
                // if (!empty($detail->tanggal_masuk_analisa_bank)) {
                //     $parts[] = 'Tanggal: '.$detail->tanggal_masuk_analisa_bank;
                // }
                // if (!empty($detail->nama_bank_analisa)) {
                //     $parts[] = 'Bank: '.$detail->nama_bank_analisa;
                // }

                $label = "Analisa Bank";
                if (!empty($detail->tanggal_masuk_analisa_bank)) {
                    $label .= '<strong>'."<br>Tanggal: {$detail->tanggal_masuk_analisa_bank}".'</strong>';
                }
                if (!empty($detail->nama_bank_analisa)) {
                    $label .= '<strong>'."<br>Bank: {$detail->nama_bank_analisa}".'</strong>';
                }

                $booking->update(['status_pengajuan' => $label]);

                BookingTimeline::where('booking_id', $booking->id)->update(['is_current' => false]);

                $timeline->update(['is_current' => true]);
            }

            DB::commit();
            sweetalert()->success($request->action === 'set'
                ? 'Status berhasil diubah ke Analisa Bank.'
                : 'Data Analisa Bank berhasil disimpan.');
            return  redirect()->route('booking/list/page');

        } catch (\Exception $e) {
            DB::rollBack();
            sweetalert()->error('Gagal menyimpan data: '.$e->getMessage());
            return back()->withInput();
        }
    }

    public function storeSp3k(Request $request, $booking_id)
    {
        $validator = Validator::make($request->all(), [
            'nomor_sp3k'      => 'nullable|string|max:255',
            'tanggal_sp3k'    => 'nullable|string|max:255',
            'file_sp3k'       => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'plafond_sp3k'    => 'nullable|string|max:255',
            'cicilan_sp3k'    => 'nullable|string|max:255',
            'tenor_sp3k'      => 'nullable|string|max:255',
            'bank_sp3k'       => 'nullable|string|max:255',
            'program_subsidi' => 'nullable|string|max:255',
            'action'          => 'nullable|in:save,set',
        ]);
        if ($validator->fails()) {
            sweetalert()->error('Validasi gagal! Mohon lengkapi data.');
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $booking = BookingKavling::findOrFail($booking_id);

            $filePath = null;
            if ($request->hasFile('file_sp3k')) {
                $filePath = $request->file('file_sp3k')->store('sp3k', 'public');
            }

            $detail = BookingStatus3Sp3k::updateOrCreate(
                ['booking_id' => $booking->id],
                [
                    'nomor_sp3k'      => $request->nomor_sp3k,
                    'tanggal_sp3k'    => $request->tanggal_sp3k ? Carbon::createFromFormat('d/m/Y', $request->tanggal_sp3k)->format('Y-m-d') : null,
                    'file_sp3k'       => $filePath,
                    'plafond_sp3k'    => $request->plafond_sp3k,
                    'cicilan_sp3k'    => $request->cicilan_sp3k,
                    'tenor_sp3k'      => $request->tenor_sp3k,
                    'bank_sp3k'       => $request->bank_sp3k,
                    'program_subsidi' => $request->program_subsidi,
                ]
            );

            if ($filePath) { 
                $uploaded = $request->file('file_sp3k');
                $detail->arsipFiles()->create([
                    'nama_arsip'       => $detail['nomor_sp3k'] ?? 'Lampiran SP3K',
                    'nomor_arsip'      => null,
                    'tanggal_arsip'    => $detail['tanggal_sp3k'],
                    'disk'             => 'public',
                    'file_arsip'       => $filePath,
                    'keterangan_arsip' => 'Lampiran SP3K',
                    'original_name'    => $uploaded?->getClientOriginalName(),
                    'mime_type'        => $uploaded?->getClientMimeType(),
                    'file_size'        => $uploaded?->getSize(),
                    'uploaded_by'      => optional($request->user())->id,
                ]);
            }

            $timeline = BookingTimeline::updateOrCreate(
                [
                    'booking_id'      => $booking->id,
                    'status_code'     => 3,
                    'statusable_type' => BookingStatus3Sp3k::class,
                ],
                [
                    'statusable_id' => $detail->id,
                    'notes'         => $request->catatan_analisa,
                    'changed_by'    => auth()->id(),
                    'changed_at'    => now(),
                ]
            );

            if ($request->action === 'save') {

                $timeline->update(['is_current' => '']);
            }

            if ($request->action === 'set') {
                // $parts = [];
                // if (!empty($detail->tanggal_sp3k)) {
                //     $parts[] = 'Tanggal: '.$detail->tanggal_sp3k;
                // }
                // if (!empty($detail->nama_bank_analisa)) {
                //     $parts[] = 'Bank: '.$detail->nama_bank_analisa;
                // }

                $label = "SP3K";
                if (!empty($detail->tanggal_sp3k)) {
                    $label .= '<strong>'."<br>Tanggal: {$detail->tanggal_sp3k}".'</strong>';
                }
                // if (!empty($detail->nama_bank_analisa)) {
                //     $label .= '<strong>'."<br>Bank: {$detail->nama_bank_analisa}".'</strong>';
                // }

                $booking->update(['status_pengajuan' => $label]);

                BookingTimeline::where('booking_id', $booking->id)->update(['is_current' => false]);

                $timeline->update(['is_current' => true]);
            }

            DB::commit();
            sweetalert()->success($request->action === 'set'
                ? 'Status berhasil diubah ke SP3K.'
                : 'Data SP3K berhasil disimpan.');
            return  redirect()->route('booking/list/page');

        } catch (\Exception $e) {
            DB::rollBack();
            sweetalert()->error('Gagal menyimpan data: '.$e->getMessage());
            return back()->withInput();
        }
    }
    

    public function storeAkad(Request $request, $booking_id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_akad' => 'nullable|string|max:255',
            'nama_akad'    => 'nullable|string|max:255',
            'plafond_akad' => 'nullable|string',
            'action'       => 'nullable|in:save,set',
        ]);
        if ($validator->fails()) {
            sweetalert()->error('Validasi gagal! Mohon lengkapi data.');
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $booking = BookingKavling::findOrFail($booking_id);

            $detail = BookingStatus4AkadKredit::updateOrCreate(
                ['booking_id' => $booking->id],
                [
                    'tanggal_akad' => $request->tanggal_akad ? Carbon::createFromFormat('d/m/Y', $request->tanggal_akad)->format('Y-m-d') : null,
                    'nama_akad'    => $request->nama_akad,
                    'plafond_akad' => $request->plafond_akad,
                ]
            );

            $timeline = BookingTimeline::updateOrCreate(
                [
                    'booking_id'      => $booking->id,
                    'status_code'     => 4,
                    'statusable_type' => BookingStatus4AkadKredit::class,
                ],
                [
                    'statusable_id' => $detail->id,
                    'notes'         => $request->plafond_akad,
                    'changed_by'    => auth()->id(),
                    'changed_at'    => now(),
                ]
            );

            if ($request->action === 'save') {

                $timeline->update(['is_current' => '']);
            }

            if ($request->action === 'set') {
                // $parts = [];
                // if (!empty($detail->tanggal_akad)) {
                //     $parts[] = 'Tanggal: '.$detail->tanggal_akad;
                // }
                // if (!empty($detail->nama_akad)) {
                //     $parts[] = 'Bank: '.$detail->nama_akad;
                // }
                // if (!empty($detail->plafond_akad)) {
                //     $parts[] = 'Plafond: '.$detail->plafond_akad;
                // }

                $label = "Akad Kredit";
                if (!empty($detail->tanggal_akad)) {
                    $label .= '<strong>'."<br>Tanggal: {$detail->tanggal_akad}".'</strong>';
                }
                if (!empty($detail->nama_akad)) {
                    $label .= '<strong>'."<br>Bank: {$detail->nama_akad}".'</strong>';
                }
                if (!empty($detail->plafond_akad)) {
                    $label .= '<strong>'."<br>Plafond: {$detail->plafond_akad}".'</strong>';
                }

                $booking->update(['status_pengajuan' => $label]);

                BookingTimeline::where('booking_id', $booking->id)->update(['is_current' => false]);

                $timeline->update(['is_current' => true]);
            }

            DB::commit();
            sweetalert()->success($request->action === 'set'
                ? 'Status berhasil diubah ke Akad Kredit.'
                : 'Data Akad Kredit berhasil disimpan.');
            return  redirect()->route('booking/list/page');

        } catch (\Exception $e) {
            DB::rollBack();
            sweetalert()->error('Gagal menyimpan data: '.$e->getMessage());
            return back()->withInput();
        }
    }

    public function storeAjb(Request $request, $booking_id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_ajb' => 'nullable|string|max:255',
            'catatan_ajb' => 'nullable|string',
            'action'      => 'nullable|in:save,set',
        ]);
        if ($validator->fails()) {
            sweetalert()->error('Validasi gagal! Mohon lengkapi data.');
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $booking = BookingKavling::findOrFail($booking_id);

            $detail = BookingStatus5Ajb::updateOrCreate(
                ['booking_id' => $booking->id],
                [
                    'tanggal_ajb' => $request->tanggal_ajb ? Carbon::createFromFormat('d/m/Y', $request->tanggal_ajb)->format('Y-m-d') : null,
                    'catatan_ajb' => $request->catatan_ajb,
                ]
            );

            $timeline = BookingTimeline::updateOrCreate(
                [
                    'booking_id'      => $booking->id,
                    'status_code'     => 5,
                    'statusable_type' => BookingStatus5Ajb::class,
                ],
                [
                    'statusable_id' => $detail->id,
                    'notes'         => $request->catatan_ajb,
                    'changed_by'    => auth()->id(),
                    'changed_at'    => now(),
                ]
            );

            if ($request->action === 'save') {

                $timeline->update(['is_current' => '']);
            }

            if ($request->action === 'set') {
                // $parts = [];
                // if (!empty($detail->tanggal_ajb)) {
                //     $parts[] = 'Tgl: '.$detail->tanggal_ajb;
                // }
                // if (!empty($detail->catatan_ajb)) {
                //     $parts[] = 'Catatan: '.$detail->catatan_ajb;
                // }

                $label = "AJB";
                if (!empty($detail->tanggal_ajb)) {
                    $label .= '<strong>'."<br>Tanggal: {$detail->tanggal_ajb}".'</strong>';
                }
                // if (!empty($detail->catatan_ajb)) {
                //     $label .= "<br>Catatan: {$detail->catatan_ajb}";
                // }

                $booking->update(['status_pengajuan' => $label]);

                BookingTimeline::where('booking_id', $booking->id)->update(['is_current' => false]);

                $timeline->update(['is_current' => true]);
            }

            DB::commit();
            sweetalert()->success($request->action === 'set'
                ? 'Status berhasil diubah ke AJB.'
                : 'Data AJB berhasil disimpan.');
            return  redirect()->route('booking/list/page');

        } catch (\Exception $e) {
            DB::rollBack();
            sweetalert()->error('Gagal menyimpan data: '.$e->getMessage());
            return back()->withInput();
        }
    }

    public function storeDitolak(Request $request, $booking_id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_ditolak' => 'nullable|string|max:255',
            'alasan_ditolak'  => 'nullable|string|max:255',
            'file_ditolak'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'action'          => 'nullable|in:save,set',
        ]);
        if ($validator->fails()) {
            sweetalert()->error('Validasi gagal! Mohon lengkapi data.');
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $booking = BookingKavling::findOrFail($booking_id);

            $filePath = null;
            if ($request->hasFile('file_ditolak')) {
                $filePath = $request->file('file_ditolak')->store('ditolakBank', 'public');
            }

            $detail = BookingStatus6DitolakBank::updateOrCreate(
                ['booking_id' => $booking->id],
                [
                    'tanggal_ditolak' => $request->tanggal_ditolak ? Carbon::createFromFormat('d/m/Y', $request->tanggal_ditolak)->format('Y-m-d') : null,
                    'file_ditolak'    => $filePath,
                    'alasan_ditolak'  => $request->alasan_ditolak,
                ]
            );

            if ($filePath) { 
                $uploaded = $request->file('file_ditolak');
                $detail->arsipFiles()->create([
                    'nama_arsip'       => 'Lampiran Ditolak Bank',
                    'nomor_arsip'      => null,
                    'tanggal_arsip'    => $detail['tanggal_ditolak'],
                    'disk'             => 'public',
                    'file_arsip'       => $filePath,
                    'keterangan_arsip' => 'Lampiran Ditolak Bank',
                    'original_name'    => $uploaded?->getClientOriginalName(),
                    'mime_type'        => $uploaded?->getClientMimeType(),
                    'file_size'        => $uploaded?->getSize(),
                    'uploaded_by'      => optional($request->user())->id,
                ]);
            }

            $timeline = BookingTimeline::updateOrCreate(
                [
                    'booking_id'      => $booking->id,
                    'status_code'     => 6,
                    'statusable_type' => BookingStatus6DitolakBank::class,
                ],
                [
                    'statusable_id' => $detail->id,
                    'notes'         => $request->catatan_analisa,
                    'changed_by'    => auth()->id(),
                    'changed_at'    => now(),
                ]
            );

            if ($request->action === 'save') {

                $timeline->update(['is_current' => '']);
            }

            if ($request->action === 'set') {
                // $parts = [];
                // if (!empty($detail->tanggal_sp3k)) {
                //     $parts[] = 'Tanggal: '.$detail->tanggal_sp3k;
                // }
                // if (!empty($detail->nama_bank_analisa)) {
                //     $parts[] = 'Bank: '.$detail->nama_bank_analisa;
                // }

                $label = "Ditolak Bank";
                if (!empty($detail->tanggal_ditolak)) {
                    $label .= '<strong>'."<br>Tanggal: {$detail->tanggal_ditolak}".'</strong>';
                }
                // if (!empty($detail->nama_bank_analisa)) {
                //     $label .= '<strong>'."<br>Bank: {$detail->nama_bank_analisa}".'</strong>';
                // }

                $booking->update(['status_pengajuan' => $label]);

                BookingTimeline::where('booking_id', $booking->id)->update(['is_current' => false]);

                $timeline->update(['is_current' => true]);
            }

            DB::commit();
            sweetalert()->success($request->action === 'set'
                ? 'Status berhasil diubah ke Ditolak Bank.'
                : 'Data Ditolak Bank berhasil disimpan.');
            return  redirect()->route('booking/list/page');

        } catch (\Exception $e) {
            DB::rollBack();
            sweetalert()->error('Gagal menyimpan data: '.$e->getMessage());
            return back()->withInput();
        }
    }

    public function storeMundur(Request $request, $booking_id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_mundur' => 'nullable|string|max:255',
            'alasan_mundur' => 'nullable|string',
            'action'      => 'nullable|in:save,set',
        ]);
        if ($validator->fails()) {
            sweetalert()->error('Validasi gagal! Mohon lengkapi data.');
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $booking = BookingKavling::findOrFail($booking_id);

            $detail = BookingStatus7Mundur::updateOrCreate(
                ['booking_id' => $booking->id],
                [
                    'tanggal_mundur' => $request->tanggal_mundur ? Carbon::createFromFormat('d/m/Y', $request->tanggal_mundur)->format('Y-m-d') : null,
                    'alasan_mundur' => $request->alasan_mundur,
                ]
            );

            $timeline = BookingTimeline::updateOrCreate(
                [
                    'booking_id'      => $booking->id,
                    'status_code'     => 7,
                    'statusable_type' => BookingStatus7Mundur::class,
                ],
                [
                    'statusable_id' => $detail->id,
                    'notes'         => $request->alasan_mundur,
                    'changed_by'    => auth()->id(),
                    'changed_at'    => now(),
                ]
            );

            if ($request->action === 'save') {

                $timeline->update(['is_current' => '']);
            }

            if ($request->action === 'set') {
                // $parts = [];
                // if (!empty($detail->tanggal_mundur)) {
                //     $parts[] = 'Tgl: '.$detail->tanggal_mundur;
                // }
                // if (!empty($detail->alasan_mundur)) {
                //     $parts[] = 'Alasan: '.$detail->alasan_mundur;
                // }

                $label = "Mundur";
                if (!empty($detail->tanggal_mundur)) {
                    $label .= '<strong>'."<br>Tanggal: {$detail->tanggal_mundur}".'</strong>';
                }
                // if (!empty($detail->alasan_mundur)) {
                //     $label .= "<br>Alasan: {$detail->alasan_mundur}";
                // }

                $booking->update(['status_pengajuan' => $label]);

                BookingTimeline::where('booking_id', $booking->id)->update(['is_current' => false]);

                $timeline->update(['is_current' => true]);
            }

            DB::commit();
            sweetalert()->success($request->action === 'set'
                ? 'Status berhasil diubah ke Mundur.'
                : 'Data Mundur berhasil disimpan.');
            return  redirect()->route('booking/list/page');

        } catch (\Exception $e) {
            DB::rollBack();
            sweetalert()->error('Gagal menyimpan data: '.$e->getMessage());
            return back()->withInput();
        }
    }

    // public function show(BookingKavling $booking) 
    // {
    //     return view('marketing.perumahan.kavling.statusbookingaddnew', compact('booking'));
    // }

    public function editSPR(BookingKavling $booking, $id)
    {
        $updateSPR = SuratPemesananRumah::findOrFail($id);
        $kota = DB::table('kota')
            ->select('id', 'nama')
            ->union(
                DB::table('provinsi')->select('id', 'nama')
            )
            ->orderBy('nama')
            ->get();

        // if (empty($booking->nomor_booking)) {
        //     $tanggal = $booking->tanggal_booking ?? Carbon::now('Asia/Jakarta')->toDateString();
        //     $booking->tanggal_booking = $tanggal;
        //     $booking->nomor_booking   = BookingKavling::generateNomorBooking($tanggal);
        //     $booking->save();
        // }

        // $nomorPreview = 'SPR' . substr($booking->nomor_booking, 2);

        return view('marketing.perumahan.kavling.sprupdate', compact('updateSPR','kota'));
    }

    // public function kavlingAddSpr(BookingKavling $booking)
    // {
    //     $jenisBiaya = DB::table('jenis_biaya_konsumen')->orderBy('urutan')->get();
    //     $spr = $booking->generateNomorSPR();
    //     $jenisBiayaByNama = DB::table('jenis_biaya_konsumen')->pluck('id', 'nama');
    //     $jenisDokumen = DB::table('jenis_dokumen_persyaratan')->orderBy('urutan')->get();
    //     $jenisByNama = DB::table('jenis_dokumen_persyaratan')->pluck('id', 'nama');

    //     $ruleByBiaya = [
    //         'Cash Keras' => [
    //             'Booking Fee',
    //             'Biaya Administrasi',
    //             'Uang Muka',
    //             'Biaya Kelebihan Tanah',
    //             'Biaya Penambahan Bangunan',
    //             'Biaya Lainnya',
    //             'Total Penjualan Cash',
    //         ],
    //         'Cash Bertahap' => [
    //             'Booking Fee',
    //             'Biaya Administrasi',
    //             'Uang Muka',
    //             'Biaya Kelebihan Tanah',
    //             'Biaya Penambahan Bangunan',
    //             'Biaya Lainnya',
    //             'Cicilan Cash (Bertahap)',
    //         ],
    //         'KPR' => [
    //             'Booking Fee',
    //             'Uang Muka',
    //             'Biaya Kelebihan Tanah',
    //             'Biaya Penambahan Bangunan',
    //             'Biaya Lainnya',
    //             'Biaya Akad Kredit',
    //             'Biaya Penambahan Fasilitas',
    //             'Penerimaan KPR dari Bank',
    //         ],
    //     ];

    //     $showIdsByBiaya = [];
    //     foreach ($ruleByBiaya as $metode => $namaList) {
    //         $ids = [];
    //         foreach ($namaList as $nama) {
    //             if (isset($jenisBiayaByNama[$nama])) $ids[] = (int) $jenisBiayaByNama[$nama];
    //         }
    //         $showIdsByBiaya[$metode] = $ids;
    //     }

    //     $ruleByMetode = [
    //         'Cash Keras' => [
    //             'Surat Perjanjian Cash Bertahap',
    //             'Kartu Tanda Penduduk (KTP)',
    //             'Kartu Keluarga (KK)',
    //             'Pas Photo 3x4',
    //         ],
    //         'Cash Bertahap' => [
    //             'Surat Perjanjian Cash Bertahap',
    //             'Kartu Tanda Penduduk (KTP)',
    //             'Kartu Keluarga (KK)',
    //             'Pas Photo 3x4',
    //         ],
    //         'KPR' => [
    //             'SBOM',
    //             'Kartu Tanda Penduduk (KTP)',
    //             'Kartu Keluarga (KK)',
    //             'Pas Photo 3x4',
    //             'FC Buku Tabungan',
    //             'NPWP',
    //             'Slip Gaji',
    //             'Surat Keterangan Kerja',
    //             'Rekening Koran',
    //             'Surat Keterangan Belum Memiliki Rumah',
    //             'Surat Keterangan Usaha (Wiraswasta)',
    //             'Neraca Keuangan (Wirausaha)',
    //         ],
    //     ];

    //     $showIdsByMetode = [];
    //     foreach ($ruleByMetode as $metode => $namaList) {
    //         $ids = [];
    //         foreach ($namaList as $nama) {
    //             if (isset($jenisByNama[$nama])) $ids[] = (int) $jenisByNama[$nama];
    //         }
    //         $showIdsByMetode[$metode] = $ids;
    //     }
        
    //     $cluster = DB::table('cluster')
    //         ->leftJoin('kapling','kapling.cluster_id','=','cluster.id')
    //         ->select(
    //             'cluster.id as cluster_id',
    //             'cluster.nama_cluster',
    //             'kapling.id as kapling_id',
    //             'kapling.blok_kapling',
    //             'kapling.nomor_unit_kapling'
    //         )
    //         ->orderBy('cluster.nama_cluster')
    //         ->orderBy('kapling.blok_kapling')
    //         ->get()
    //         ->groupBy('cluster_id');
    //     $konsumen = DB::table('konsumen')->get();
    //     $rap_rab = DB::table('rap_rab')->get();

    //     $today = Carbon::now('Asia/Jakarta')->toDateString();
    //     $nomorPreview = BookingKavling::generateNomorSPR($today);

    //     return view('marketing.perumahan.kavling.spraddnew', compact('jenisDokumen','jenisBiaya', 'cluster', 'konsumen', 'rap_rab', 'nomorPreview', 'showIdsByMetode', 'showIdsByBiaya'));
    // }

    public function edit($id)
    {
        $updateKavling = Kapling::with('activeBooking')->findOrFail($id);
        $isBooked = $updateKavling->is_booked;

        $cluster = DB::table('cluster')->get();
        $rap_rab = DB::table('rap_rab')->where('tipe_model', 'Kapling')->get();

        $detail = DB::table('kapling as kapling')
            ->leftJoin('cluster as cluster', 'cluster.id', '=', 'kapling.cluster_id')
            ->where('kapling.id', $id)
            ->select('kapling.nomor_unit_kapling', 'kapling.blok_kapling', 'kapling.cluster_id', 'cluster.nama_cluster')
            ->first();

            $arsip = $updateKavling->arsip()->get()->map(function($a){
                return [
                    'id'               => $a->id,
                    'nama_arsip'       => $a->nama_arsip,
                    'nomor_arsip'      => $a->nomor_arsip,
                    'tanggal_arsip'    => $a->tanggal_arsip ? $a->tanggal_arsip->format('Y-m-d') : null,
                    'keterangan_arsip' => $a->keterangan_arsip,
                    'original_name'    => $a->original_name,
                    'file_url'         => $a->file_arsip ? asset('storage/'.$a->file_arsip) : null,
                    'file_label'       => 'Ganti File',
                ];
            });

        return view('marketing.perumahan.kavling.kavlingupdate', compact('updateKavling', 'cluster', 'rap_rab', 'detail', 'arsip','isBooked'));
    }

    public function editBooking($id)
    {
        $updateBooking = BookingKavling::findOrFail($id);
        $cluster = DB::table('cluster')
            ->leftJoin('kapling','kapling.cluster_id','=','cluster.id')
            ->select(
                'cluster.id as cluster_id',
                'cluster.nama_cluster',
                'kapling.id as kapling_id',
                'kapling.blok_kapling',
                'kapling.nomor_unit_kapling'
            )
            ->orderBy('cluster.nama_cluster')
            ->orderBy('kapling.blok_kapling')
            ->get()
            ->groupBy('cluster_id');
        $konsumen = DB::table('konsumen')->get();
        $rap_rab = DB::table('rap_rab')->get();

        $jenisBiaya = DB::table('jenis_biaya_konsumen')->orderBy('urutan')->get();
        $jenisBiayaByNama = DB::table('jenis_biaya_konsumen')->pluck('id', 'nama');
        $jenisDokumen = DB::table('jenis_dokumen_persyaratan')->orderBy('urutan')->get();
        $jenisByNama = DB::table('jenis_dokumen_persyaratan')->pluck('id', 'nama');

        $ruleByBiaya = [
            'Cash Keras' => [
                'Booking Fee',
                'Biaya Administrasi',
                'Uang Muka',
                'Biaya Kelebihan Tanah',
                'Biaya Penambahan Bangunan',
                'Biaya Lainnya',
                'Total Penjualan Cash',
            ],
            'Cash Bertahap' => [
                'Booking Fee',
                'Biaya Administrasi',
                'Uang Muka',
                'Biaya Kelebihan Tanah',
                'Biaya Penambahan Bangunan',
                'Biaya Lainnya',
                'Cicilan Cash (Bertahap)',
            ],
            'KPR' => [
                'Booking Fee',
                'Uang Muka',
                'Biaya Kelebihan Tanah',
                'Biaya Penambahan Bangunan',
                'Biaya Lainnya',
                'Biaya Akad Kredit',
                'Biaya Penambahan Fasilitas',
                'Penerimaan KPR dari Bank',
            ],
        ];

        $showIdsByBiaya = [];
        foreach ($ruleByBiaya as $metode => $namaList) {
            $ids = [];
            foreach ($namaList as $nama) {
                if (isset($jenisBiayaByNama[$nama])) $ids[] = (int) $jenisBiayaByNama[$nama];
            }
            $showIdsByBiaya[$metode] = $ids;
        }

        $ruleByMetode = [
            'Cash Keras' => [
                'Surat Perjanjian Cash Bertahap',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
                'Pas Photo 3x4',
            ],
            'Cash Bertahap' => [
                'Surat Perjanjian Cash Bertahap',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
                'Pas Photo 3x4',
            ],
            'KPR' => [
                'SBOM',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
                'Pas Photo 3x4',
                'FC Buku Tabungan',
                'NPWP',
                'Slip Gaji',
                'Surat Keterangan Kerja',
                'Rekening Koran',
                'Surat Keterangan Belum Memiliki Rumah',
                'Surat Keterangan Usaha (Wiraswasta)',
                'Neraca Keuangan (Wirausaha)',
            ],
        ];

        $showIdsByMetode = [];
        foreach ($ruleByMetode as $metode => $namaList) {
            $ids = [];
            foreach ($namaList as $nama) {
                if (isset($jenisByNama[$nama])) $ids[] = (int) $jenisByNama[$nama];
            }
            $showIdsByMetode[$metode] = $ids;
        }

        $selectedKaplingId = old('kapling_id', $updateBooking->kapling_id);
        $tanggalBooking = $updateBooking->tanggal_booking ? Carbon::parse($updateBooking->tanggal_booking)->format('d/m/Y') : null;

        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $nomorPreview = BookingKavling::generateNomorBooking($today);

            // $arsip = $updateKavling->arsip()->get()->map(function($a){
            //     return [
            //         'id'               => $a->id,
            //         'nama_arsip'       => $a->nama_arsip,
            //         'nomor_arsip'      => $a->nomor_arsip,
            //         'tanggal_arsip'    => $a->tanggal_arsip ? $a->tanggal_arsip->format('Y-m-d') : null,
            //         'keterangan_arsip' => $a->keterangan_arsip,
            //         'original_name'    => $a->original_name,
            //         'file_url'         => $a->file_arsip ? asset('storage/'.$a->file_arsip) : null,
            //         'file_label'       => 'Ganti File',
            //     ];
            // });

        $filesByJenis = DokumenBooking::with('files')
            ->where('booking_id', $updateBooking->id)
            ->get()
            ->mapWithKeys(function ($d) {
                $items = $d->files->map(function ($f) {
                    return [
                        'id'            => $f->id,
                        'original_name' => $f->original_name,
                        'mime'          => $f->mime_type,
                        'size'          => $f->file_size,
                        'url'           => $f->file_arsip ? asset('storage/'.$f->file_arsip) : null,
                    ];
                })->all();

                return [$d->jenis_dokumen_persyaratan_id => $items];
            });


            // $arsip = $updateKavling->arsip()->get()->map(function($a){
            //     return [
            //         'id'               => $a->id,
            //         'nama_arsip'       => $a->nama_arsip,
            //         'nomor_arsip'      => $a->nomor_arsip,
            //         'tanggal_arsip'    => $a->tanggal_arsip ? $a->tanggal_arsip->format('Y-m-d') : null,
            //         'keterangan_arsip' => $a->keterangan_arsip,
            //         'original_name'    => $a->original_name,
            //         'file_url'         => $a->file_arsip ? Storage::url($a->file_arsip) : null,
            //         'file_label'       => 'Ganti File',
            //     ];
            // });

            $costs = BiayaBooking::with('jadwalBiayaBooking')
                ->where('booking_id', $updateBooking->id)
                ->get()
                ->map(function ($biaya) {
                    $biaya->setRelation('schedules', $biaya->jadwalBiayaBooking);
                    return $biaya;
                });
            $updateBooking->setRelation('costs', $costs);
            $booking = $updateBooking;

        return view('marketing.perumahan.kavling.kavlingbookingupdate', compact('updateBooking', 'cluster', 'konsumen', 'rap_rab', 'nomorPreview', 'selectedKaplingId', 'tanggalBooking','jenisDokumen','jenisBiaya', 'showIdsByMetode','filesByJenis','booking', 'showIdsByBiaya'));
    }

    // public function deleteFile(ArsipFile $file)
    // {
    //     if ($file->file_arsip && Storage::disk($file->disk)->exists($file->file_arsip)) {
    //         Storage::disk($file->disk)->delete($file->file_arsip);
    //     }
    //     $file->delete();
    //     sweetalert()->success('File berhasil dihapus.');
    //     return redirect()->back();
    // }

    public function deleteFile(ArsipFile $file)
    {
        try {
            $disk      = $file->disk ?? config('filesystems.default', 'public');
            $path      = $file->file_arsip;
            $parent    = $file->arsipmultimenu;
            $parentDir = $path ? dirname($path) : null;

            if ($path && Storage::disk($disk)->exists($path)) {
                Storage::disk($disk)->delete($path);
            }

            $file->delete();

            if ($parent instanceof DokumenBooking && $parent->files()->count() === 0) {
                $parent->delete();
            }

            if ($parentDir && empty(Storage::disk($disk)->files($parentDir)) && empty(Storage::disk($disk)->directories($parentDir))) {
                Storage::disk($disk)->deleteDirectory($parentDir);
            }

            sweetalert()->success('File berhasil dihapus.');
        } catch (\Throwable $e) {
            sweetalert()->warning('Gagal menghapus file: '.$e->getMessage());
        }

        return back();
    }

    public function detailBooking($id)
    {
        $detailBooking = BookingKavling::with('konsumen:id,nama_1,booking_fee')
            ->select('id','konsumen_id','metode_pembayaran','nomor_booking')
            ->findOrFail($id);

        $cluster = DB::table('cluster')
            ->leftJoin('konsumen','konsumen.cluster_id','=','cluster.id')
            ->select(
                'cluster.id as cluster_id',
                'cluster.nama_cluster',
                'konsumen.id as konsumen_id',
                'konsumen.nama_1',
                'konsumen.booking_fee'
            )
            ->orderBy('cluster.nama_cluster')
            ->orderBy('konsumen.nama_1')
            ->get()
            ->groupBy('cluster_id');

        $konsumen = (object)[
            'metode_pembayaran' => $detailBooking->metode_pembayaran,
            'nomor_booking'     => $detailBooking->nomor_booking,
            'konsumen_id'       => $detailBooking->konsumen_id,
            'nama_1'     => $detailBooking->konsumen?->nama_1,
            'booking_fee'       => $detailBooking->konsumen?->booking_fee,
        ];


        $rap_rab = DB::table('rap_rab')->get();

        $selectedKaplingId = old('kapling_id', $detailBooking->kapling_id);
        $tanggalBooking = $detailBooking->tanggal_booking ? Carbon::parse($detailBooking->tanggal_booking)->format('d/m/Y') : null;

        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $nomorPreview = BookingKavling::generateNomorBooking($today);

        // $jenisDokumen = DB::table('jenis_dokumen_persyaratan')
        //     ->select('id','nama','urutan')
        //     ->orderBy('urutan')
        //     ->get();

        $dokumenList = DokumenBooking::with(['files' => function ($q) {
                $q->orderByDesc('created_at');
            }])
            ->where('booking_id', $detailBooking->id)
            ->get();

        $dokumenByJenis = $dokumenList->keyBy('jenis_dokumen_persyaratan_id');

        $jenisBiaya = DB::table('jenis_biaya_konsumen')->orderBy('urutan')->get();
        $jenisDokumen = DB::table('jenis_dokumen_persyaratan')->orderBy('urutan')->get();
        $jenisByNama = DB::table('jenis_dokumen_persyaratan')->pluck('id', 'nama');

        $ruleByMetode = [
            'Cash Keras' => [
                'Surat Perjanjian Cash Bertahap',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
                'Pas Photo 3x4',
            ],
            'Cash Bertahap' => [
                'Surat Perjanjian Cash Bertahap',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
                'Pas Photo 3x4',
            ],
            'KPR' => [
                'SBOM',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
                'Pas Photo 3x4',
                'FC Buku Tabungan',
                'NPWP',
                'Slip Gaji',
                'Surat Keterangan Kerja',
                'Rekening Koran',
                'Surat Keterangan Belum Memiliki Rumah',
                'Surat Keterangan Usaha (Wiraswasta)',
                'Neraca Keuangan (Wirausaha)',
            ],
        ];

        $showIdsByMetode = [];
        foreach ($ruleByMetode as $metode => $namaList) {
            $ids = [];
            foreach ($namaList as $nama) {
                if (isset($jenisByNama[$nama])) $ids[] = (int) $jenisByNama[$nama];
            }
            $showIdsByMetode[$metode] = $ids;
        }

        $selectedMetode = $detailBooking->metode_pembayaran;
        if ($selectedMetode && isset($showIdsByMetode[$selectedMetode])) {
            $jenisDokumen = $jenisDokumen->whereIn('id', $showIdsByMetode[$selectedMetode]);
        }

        $dokumenByJenis = DokumenBooking::where('booking_id', $detailBooking->id)
            ->with('files')
            ->get()
            ->keyBy('jenis_dokumen_persyaratan_id');

            // $arsip = $updateKavling->arsip()->get()->map(function($a){
            //     return [
            //         'id'               => $a->id,
            //         'nama_arsip'       => $a->nama_arsip,
            //         'nomor_arsip'      => $a->nomor_arsip,
            //         'tanggal_arsip'    => $a->tanggal_arsip ? $a->tanggal_arsip->format('Y-m-d') : null,
            //         'keterangan_arsip' => $a->keterangan_arsip,
            //         'original_name'    => $a->original_name,
            //         'file_url'         => $a->file_arsip ? asset('storage/'.$a->file_arsip) : null,
            //         'file_label'       => 'Ganti File',
            //     ];
            // });

            $biayaRows = BiayaBooking::with(['jenisBiayaBooking:id,kode,nama'])
                ->where('booking_id', $detailBooking->id)
                ->get();

            $codeToProp = [
                'BF'   => 'booking_fee',
                'UM'   => 'uang_muka',
                'ADM'  => 'biaya_administrasi',
                'AKAD' => 'biaya_akad_kredit',
                'KLT'  => 'biaya_kelebihan_tanah',
                'PENB' => 'biaya_penambahan_bangunan',
                'LAIN' => 'biaya_lainnya',
                'FAS'  => 'biaya_penambahan_fasilitas',
                'KPR'  => 'penerimaan_kpr',
                'TPC'  => 'total_penjualan_cash',
                'CIC'  => 'cicilan_cash',
            ];

            $costDefaults = array_fill_keys(array_values($codeToProp), 0);

            $costFilled = [];
            foreach ($biayaRows as $row) {
                $kode = $row->jenisBiayaBooking?->kode;
                if (!$kode) continue;

                $prop = $codeToProp[$kode] ?? null;
                if (!$prop) continue;

                $val = (int) preg_replace('/[^\d]/', '', (string) $row->nominal_biaya);
                $costFilled[$prop] = $val;
            }


            $costs = (object) array_merge($costDefaults, $costFilled);

        return view('marketing.perumahan.kavling.detailbooking', compact('detailBooking', 'cluster', 'konsumen', 'rap_rab', 'nomorPreview', 'selectedKaplingId', 'tanggalBooking','jenisDokumen', 'dokumenByJenis', 'showIdsByMetode', 'costs'));
    }

    public function detailKonsumen($id)
    {
        $booking = BookingKavling::with([
            'konsumen:id,jenis_kelamin_id,status_pengajuan_id,provinsi_code,kota_code,kelurahan_code,kecamatan_code,provinsi_code_1,kota_code_1,kelurahan_code_1,kecamatan_code_1,pekerjaan_1_id,nama_1,npwp_1,tanggal_lahir_1,tempat_lahir_1,email,nik_1,no_hp_1,alamat_konsumen,alamat_1,cluster_id,booking_fee',
            'konsumen.gender:id,nama',
            'konsumen.status_pengajuan:id,nama',
            'konsumen.province:code,name',
            'konsumen.city:code,name',
            'konsumen.district:code,name',
            'konsumen.village:code,name',
            'konsumen.pekerjaan:id,nama',
            'kapling:id,cluster_id,blok_kapling,nomor_unit_kapling,luas_tanah,luas_bangunan,harga_kapling',
            'kapling.cluster:id,nama_cluster',
        ])->findOrFail($id);


        $konsumen = $booking->konsumen;
        $provinceSelected = $konsumen->provinsi_code  ? Province::find($konsumen->provinsi_code, ['name']) : null;
        $citySelected     = $konsumen->kota_code      ? City::find($konsumen->kota_code, ['name']) : null;
        $districtSelected = $konsumen->kecamatan_code ? District::find($konsumen->kecamatan_code, ['code','name']) : null;
        $villageSelected  = $konsumen->kelurahan_code ? Village::find($konsumen->kelurahan_code, ['code','name']) : null;
        // $booking->provinsi_code = Province::where('code', $booking->provinsi_code)->first(['code','name']);
        // $citySelected     = $booking->kota_code ? City::where('code', $booking->kota_code)->first(['code','name']) : null;
        // $districtSelected = $booking->kecamatan_code ? District::where('code', $booking->kecamatan_code)->first(['code','name']) : null;
        // $villageSelected  = $booking->kelurahan_code ? Village::where('code', $booking->kelurahan_code)->first(['code','name']) : null;

        $tanggalSppForForm = $booking->tanggal_booking
            ? Carbon::parse($booking->tanggal_booking)->format('d/m/Y')
            : null;

        $tanggalSppHuman = $booking->tanggal_booking
            ? Carbon::parse($booking->tanggal_booking)->locale('id')->isoFormat('dddd, D MMMM Y')
            : null;

        $cluster = DB::table('cluster')
            ->leftJoin('konsumen','konsumen.cluster_id','=','cluster.id')
            ->select(
                'cluster.id as cluster_id',
                'cluster.nama_cluster',
                'konsumen.id as konsumen_id',
                'konsumen.nama_1',
                'konsumen.booking_fee'
            )
            ->orderBy('cluster.nama_cluster')
            ->orderBy('konsumen.nama_1')
            ->get()
            ->groupBy('cluster_id');

        $konsumen = (object)[
            'metode_pembayaran' => $booking->metode_pembayaran,
            'nomor_booking'     => $booking->nomor_booking,
            'konsumen_id'       => $booking->konsumen_id,
            'nama_1'     => $booking->konsumen?->nama_1,
            'booking_fee'       => $booking->konsumen?->booking_fee,
        ];


        $rap_rab = DB::table('rap_rab')->get();

        $selectedKaplingId = old('kapling_id', $booking->kapling_id);
        $tanggalBooking = $booking->tanggal_booking ? Carbon::parse($booking->tanggal_booking)->format('d/m/Y') : null;

        $today = Carbon::now('Asia/Jakarta')->toDateString();
        $nomorPreview = BookingKavling::generateNomorBooking($today);

        // $jenisDokumen = DB::table('jenis_dokumen_persyaratan')
        //     ->select('id','nama','urutan')
        //     ->orderBy('urutan')
        //     ->get();

        $dokumenList = DokumenBooking::with(['files' => function ($q) {
                $q->orderByDesc('created_at');
            }])
            ->where('booking_id', $booking->id)
            ->get();

        $dokumenByJenis = $dokumenList->keyBy('jenis_dokumen_persyaratan_id');

        $jenisBiaya = DB::table('jenis_biaya_konsumen')->orderBy('urutan')->get();
        $jenisDokumen = DB::table('jenis_dokumen_persyaratan')->orderBy('urutan')->get();
        $jenisByNama = DB::table('jenis_dokumen_persyaratan')->pluck('id', 'nama');

        $ruleByMetode = [
            'Cash Keras' => [
                'Surat Perjanjian Cash Bertahap',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
                'Pas Photo 3x4',
            ],
            'Cash Bertahap' => [
                'Surat Perjanjian Cash Bertahap',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
                'Pas Photo 3x4',
            ],
            'KPR' => [
                'SBOM',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
                'Pas Photo 3x4',
                'FC Buku Tabungan',
                'NPWP',
                'Slip Gaji',
                'Surat Keterangan Kerja',
                'Rekening Koran',
                'Surat Keterangan Belum Memiliki Rumah',
                'Surat Keterangan Usaha (Wiraswasta)',
                'Neraca Keuangan (Wirausaha)',
            ],
        ];

        $showIdsByMetode = [];
        foreach ($ruleByMetode as $metode => $namaList) {
            $ids = [];
            foreach ($namaList as $nama) {
                if (isset($jenisByNama[$nama])) $ids[] = (int) $jenisByNama[$nama];
            }
            $showIdsByMetode[$metode] = $ids;
        }

        $selectedMetode = $booking->metode_pembayaran;
        if ($selectedMetode && isset($showIdsByMetode[$selectedMetode])) {
            $jenisDokumen = $jenisDokumen->whereIn('id', $showIdsByMetode[$selectedMetode]);
        }

        $dokumenByJenis = DokumenBooking::where('booking_id', $booking->id)
            ->with('files')
            ->get()
            ->keyBy('jenis_dokumen_persyaratan_id');

            // $arsip = $updateKavling->arsip()->get()->map(function($a){
            //     return [
            //         'id'               => $a->id,
            //         'nama_arsip'       => $a->nama_arsip,
            //         'nomor_arsip'      => $a->nomor_arsip,
            //         'tanggal_arsip'    => $a->tanggal_arsip ? $a->tanggal_arsip->format('Y-m-d') : null,
            //         'keterangan_arsip' => $a->keterangan_arsip,
            //         'original_name'    => $a->original_name,
            //         'file_url'         => $a->file_arsip ? asset('storage/'.$a->file_arsip) : null,
            //         'file_label'       => 'Ganti File',
            //     ];
            // });

        return view('marketing.perumahan.kavling.detailkonsumen', compact('booking', 'cluster', 'konsumen', 'rap_rab', 'nomorPreview', 'selectedKaplingId', 'tanggalBooking','jenisDokumen', 'dokumenByJenis', 'showIdsByMetode', 'tanggalSppForForm', 'tanggalSppHuman', 'provinceSelected','citySelected', 'districtSelected', 'villageSelected'));
    }

    public function updateSPR(Request $request, $id)
    {
        $rules = [
            'booking_id'         => 'required|exists:booking_kavling,id',
            'nomor_spr'          => 'nullable|string|max:255',
            'tanggal_pemesanan'  => 'required|string|max:255',
            'lokasi_pemesanan'   => 'required|string|max:255',
            'deskripsi'          => 'nullable|string',
        ];
        $messages = [
            'booking_id.required'        => 'Booking ID is required.',
            'tanggal_pemesanan.required' => 'Tanggal pemesanan is required.',
            'lokasi_pemesanan.required'  => 'Lokasi pemesanan is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $data    = $validator->validated();
            $spr     = SuratPemesananRumah::findOrFail($id);
            $booking = BookingKavling::findOrFail($data['booking_id']);

            $nomorSpr = $spr->nomor_spr;
            if (empty($nomorSpr)) {
                $nomorSpr = !empty($data['nomor_spr'])
                    ? $data['nomor_spr']
                    : ('SPR' . substr($booking->nomor_booking, 2));
            }

            $spr->booking_id         = $booking->id;
            $spr->nomor_spr          = $nomorSpr;
            $spr->tanggal_pemesanan  = $data['tanggal_pemesanan'];
            $spr->lokasi_pemesanan   = $data['lokasi_pemesanan'];
            $spr->deskripsi          = $data['deskripsi'] ?? null;
            $spr->save();

            if ($booking->spr_id != $spr->id) {
                $booking->spr_id = $spr->id;
                $booking->save();
            }

            DB::commit();
            sweetalert()->success('SPR berhasil diperbarui.');
            return redirect()->route('booking/list/page');

        } catch (\Throwable $e) {
            DB::rollBack();
            sweetalert()->error('Update Gagal: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function updateBooking(Request $request, $id)
    {
        $rules =  [
            'kapling_id' => 'required|exists:kapling,id',
            'konsumen_id' => 'required|exists:konsumen,id',
            'tanggal_booking' => 'nullable|string|max:255',
            'metode_pembayaran' => 'required|string|max:255',
            'nomor_spr' => 'nullable|string|max:255',
            'status_pengajuan' => 'nullable|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $data = $validator->validated();
            
            if (!empty($data['tanggal_booking'])) {
                $data['tanggal_booking'] = Carbon::createFromFormat('d/m/Y', $data['tanggal_booking'])->format('Y-m-d');
            }
            
            $BookingKavling = BookingKavling::findOrFail($id);
            $BookingKavling->fill($data);
            $BookingKavling->save();

            $costs = (array) $request->input('costs', []);

            $moneyToNumeric = function ($value) {
                if ($value === null) return null;
                $digits = preg_replace('/[^\d]/', '', (string) $value);
                return $digits === '' ? null : $digits;
            };

            $parseDateDMY = function ($value) {
                if (empty($value)) return null;
                try {
                    return Carbon::parse($value)->format('Y-m-d');
                } catch (\Throwable $e) {
                    return $value;
                }
            };

            foreach ($costs as $jenisId => $payload) {
                $amountRaw   = $payload['amount']   ?? null;
                $discountRaw = $payload['discount'] ?? null;
                $useDiscount = !empty($payload['use_discount']);
                $useSchedule   = !empty($payload['use_schedule']);
                $schedules   = (isset($payload['schedules']) && is_array($payload['schedules']))
                                ? $payload['schedules'] : [];

                $amount   = $moneyToNumeric($amountRaw);
                $discount = $moneyToNumeric($discountRaw);

                $hasSchedules = count(array_filter($schedules, function ($row) {
                    return !empty($row['due_date']) || !empty($row['amount']);
                })) > 0;

                if (is_null($amount) && is_null($discount) && !$hasSchedules) {
                    continue;
                }

                $biaya = BiayaBooking::updateOrCreate(
                    [
                        'booking_id'     => (int) $BookingKavling->id,
                        'jenis_biaya_id' => (int) $jenisId,
                    ],
                    [
                        'use_jadwal'     => $useSchedule,
                        'nominal_biaya'  => $amount,
                        'use_diskon'     => $useDiscount,
                        'nominal_diskon' => $useDiscount ? $discount : null,
                    ]
                );

                JadwalBiayaBooking::where('biaya_booking_id', $biaya->id)->delete();

                $urut = 1;
                foreach ($schedules as $row) {
                    $due = $parseDateDMY($row['due_date'] ?? null);
                    $amt = $moneyToNumeric($row['amount'] ?? null);

                    if (empty($due) && is_null($amt)) continue;

                    JadwalBiayaBooking::create([
                        'biaya_booking_id'   => $biaya->id,
                        'urutan'             => $urut++,
                        'tanggal_bayar'      => $due,
                        'nominal_pembayaran' => $amt,
                    ]);
                }
            }

            $disk     = config('filesystems.default', 'public');
            $bookingId = (int) $BookingKavling->id;
            $baseDir  = "arsip/booking/{$bookingId}";

            $max = (int) $request->input('arsip_counter', 0);
            for ($i = 1; $i <= $max; $i++) {
                $jenisId  = $request->input("jenis_dokumen_persyaratan_id_{$i}");
                $uploaded = $request->file("file_arsip_{$i}");

                if (!$uploaded) {
                    continue;
                }

                if (!$jenisId) {
                    DB::rollBack();
                    sweetalert()->warning("Jenis dokumen tidak dikenali pada baris #{$i}.");
                    return redirect()->back()->withInput();
                }

                $ext  = strtolower($uploaded->getClientOriginalExtension());
                $size = $uploaded->getSize();

                if (!in_array($ext, ['pdf','jpg','jpeg','png','doc','docx'])) {
                    DB::rollBack();
                    sweetalert()->warning("Tipe file pada baris #{$i} tidak diperbolehkan. Hanya PDF/JPG/PNG/DOC/DOCX.");
                    return redirect()->back()->withInput();
                }
                if ($size > 20 * 1024 * 1024) {
                    DB::rollBack();
                    sweetalert()->warning("Ukuran file pada baris #{$i} melebihi 20MB.");
                    return redirect()->back()->withInput();
                }

                $dokumen = DokumenBooking::firstOrCreate(
                    [
                        'booking_id' => $bookingId,
                        'jenis_dokumen_persyaratan_id' => $jenisId,
                    ],
                    [
                        'is_submitted' => false,
                        'submitted_at' => null,
                    ]
                );

                $subdir   = "{$baseDir}/jenis/{$jenisId}";
                $ext      = $uploaded->getClientOriginalExtension();
                $filename = now()->format('Ymd_His') . '_' . Str::random(8) . ($ext ? ".{$ext}" : '');
                $path     = $uploaded->storeAs($subdir, $filename, $disk);

                $dokumen->files()->create([
                    'disk'           => $disk,
                    'file_arsip'     => $path,
                    'original_name'  => $uploaded->getClientOriginalName(),
                    'mime_type'      => $uploaded->getMimeType(),
                    'file_size'      => $uploaded->getSize(),
                    'uploaded_by'    => auth()->id(),
                ]);

                $dokumen->is_submitted = true;
                $dokumen->submitted_at = now();
                $dokumen->save();
            }

            DB::commit();
            sweetalert()->success('Update Kavling & Arsip berhasil :)');
            return redirect()->route('booking/list/page');

        } catch (\Throwable $e) {
            DB::rollBack();
            sweetalert()->error('Update Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function updateKavling(Request $request, $id)
    {
        $rules =  [
            'cluster_id'         => 'required|exists:cluster,id',
            'rap_rab_id'         => 'required|exists:rap_rab,id',
            'tipe_model'         => 'nullable|string|max:255',
            'blok_kapling'       => 'required|string|max:255',
            'nomor_unit_kapling' => 'required|string|max:255',
            'jumlah_lantai'      => 'required|string|max:255',
            'luas_tanah'         => 'required|string|max:255',
            'luas_bangunan'      => 'required|string|max:255',
            'harga_kapling'      => 'required|string|max:255',
            'spesifikasi'        => 'required|string|max:255',
            'status_penjualan'   => 'nullable|string|max:255',
            'status_pembangunan' => 'nullable|string|max:255',
        ];

        $message = [
            'cluster_id.required'         => 'Cluster is required.',
            'rap_rab_id.required'         => 'RAP/RAB is required.',
            'blok_kapling.required'       => 'Blok Kavling is required.',
            'nomor_unit_kapling.required' => 'Nomor Unit Kavling is required.',
            'jumlah_lantai.required'      => 'Jumlah Lantai is required.',
            'luas_tanah.required'         => 'Luas Tanah is required.',
            'luas_bangunan.required'      => 'Luas Bangunan is required.',
            'harga_kapling.required'      => 'Harga Kavling is required.',
            'spesifikasi.required'        => 'Spesifikasi is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            sweetalert()->error('Validasi Gagal, Beberapa Input Wajib Belum Terisi!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $kapling = Kapling::findOrFail($id);
            $kapling->update($validator->validated());

            $disk    = config('filesystems.default', 'public');
            $baseDir = "arsip/kapling/{$kapling->id}";

            $ownedIds = $kapling->arsip()->pluck('id')->all();
            $owned    = array_fill_keys($ownedIds, true);

            $max = (int) $request->input('arsip_counter', 0);

            for ($i = 1; $i <= $max; $i++) {
                $idArsip   = $request->input("arsip_id_{$i}");
                $toDelete  = $request->input("arsip_delete_{$i}") === '1';
                $nama      = trim((string) $request->input("nama_arsip_{$i}"));
                $nomor     = trim((string) $request->input("nomor_arsip_{$i}"));
                $tanggal   = $request->input("tanggal_arsip_{$i}");
                $ket       = $request->input("keterangan_arsip_{$i}");
                $uploaded  = $request->file("file_arsip_{$i}");

                if ($uploaded) {
                    $ext = strtolower($uploaded->getClientOriginalExtension());
                    $size = $uploaded->getSize(); 

                    if (!in_array($ext, ['pdf','jpg','jpeg','png','doc','docx'])) {
                        DB::rollBack();
                        sweetalert()->warning("Tipe file pada baris #{$i} tidak diperbolehkan. Hanya PDF/JPG/PNG/DOC/DOCX.");
                        return redirect()->back()->withInput();
                    }

                    if ($size > 20 * 1024 * 1024) {
                        DB::rollBack();
                        sweetalert()->warning("Ukuran file pada baris #{$i} melebihi 20MB.");
                        return redirect()->back()->withInput();
                    }
                }

                if (!$idArsip && !$nama && !$nomor && !$tanggal && !$ket && !$uploaded) {
                    continue;
                }

                if ($idArsip) {
                    if (!isset($owned[$idArsip])) {
                        throw new \RuntimeException("Arsip #{$idArsip} bukan milik Kavling #{$kapling->id}");
                    }
                    $arsip = $kapling->arsip()->whereKey($idArsip)->firstOrFail();

                    if ($toDelete) {
                        if ($arsip->file_arsip && Storage::disk($disk)->exists($arsip->file_arsip)) {
                            Storage::disk($disk)->delete($arsip->file_arsip);
                        }
                        $arsip->delete();
                        continue;
                    }

                    if ($nama === '') {
                        throw new \RuntimeException("Nama arsip wajib diisi pada baris #{$i}.");
                    }

                    $arsip->nama_arsip       = $nama;
                    $arsip->nomor_arsip      = $nomor ?: null;
                    $arsip->tanggal_arsip    = $tanggal ?: null;
                    $arsip->keterangan_arsip = $ket ?: null;

                    if ($uploaded) {
                        $ext      = $uploaded->getClientOriginalExtension();
                        $filename = now()->format('Ymd_His') . '_' . Str::random(8) . ($ext ? ".{$ext}" : '');
                        $path     = $uploaded->storeAs($baseDir, $filename, $disk);

                        if ($arsip->file_arsip && Storage::disk($disk)->exists($arsip->file_arsip)) {
                            Storage::disk($disk)->delete($arsip->file_arsip);
                        }

                        $arsip->file_arsip    = $path;
                        $arsip->original_name = $uploaded->getClientOriginalName();
                        $arsip->mime_type     = $uploaded->getMimeType();
                        $arsip->file_size     = $uploaded->getSize();
                    }

                    $arsip->save();
                    continue;
                }

                if ($toDelete) {
                    continue;
                }
                if ($nama === '') {
                    throw new \RuntimeException("Nama arsip wajib diisi pada baris baru #{$i}.");
                }

                $dataCreate = [
                    'nama_arsip'       => $nama,
                    'nomor_arsip'      => $nomor ?: null,
                    'tanggal_arsip'    => $tanggal ?: null,
                    'keterangan_arsip' => $ket ?: null,
                ];

                if ($uploaded) {
                    $ext      = $uploaded->getClientOriginalExtension();
                    $filename = now()->format('Ymd_His') . '_' . Str::random(8) . ($ext ? ".{$ext}" : '');
                    $path     = $uploaded->storeAs($baseDir, $filename, $disk);

                    $dataCreate['file_arsip']    = $path;
                    $dataCreate['original_name'] = $uploaded->getClientOriginalName();
                    $dataCreate['mime_type']     = $uploaded->getMimeType();
                    $dataCreate['file_size']     = $uploaded->getSize();
                }

                $kapling->arsip()->create($dataCreate);
            }

            DB::commit();
            sweetalert()->success('Update Kavling & Arsip berhasil :)');
            return redirect()->route('kavling/list/page');

        } catch (\Throwable $e) {
            DB::rollBack();
            sweetalert()->error('Update Data Gagal: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function delete(Request $request)
    {
        try {
            $ids = $request->ids;
            Kapling::whereIn('id', $ids)->chunkById(200, function($rows){
                $rows->each->delete();
            });
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('kavling/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function deleteBooking(Request $request)
    {
        try {
            $ids = $request->ids;
            Bookingkavling::whereIn('id', $ids)->chunkById(200, function($rows){
                $rows->each->delete();
            });
            sweetalert()->success('Data berhasil dihapus :)');
            return redirect()->route('booking/list/page');    

        } catch(\Exception $e) {
            DB::rollback();
            sweetalert()->error('Data gagal dihapus :)');
            \Log::error($e->getMessage());
            return redirect()->back();
        }
    }

    public function getKavling(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length          = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $kavlingNamaByClusterFilter = $request->get('cluster_id');
        $columnIndex     = $columnIndex_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];

        $query = DB::table('kapling')
            ->leftJoin('cluster','cluster.id','=','kapling.cluster_id')
            ->select('kapling.*','cluster.nama_cluster');

        if ($kavlingNamaByClusterFilter) {
            $query->where('kapling.cluster_id', 'like', '%' . $kavlingNamaByClusterFilter . '%');
        }

        $totalRecordsWithFilter = $query->count();
        $totalRecords = DB::table('kapling')->count();

        $records = $query
            ->orderBy($columnName, $columnSortOrder)
            ->offset($start)
            ->limit($length)
            ->get();

        $data_arr = [];

        foreach ($records as $key => $record) {

            $checkbox = '<input type="checkbox" class="kavling_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"                  => $checkbox,
                "no"                        => $start + $key + 1,
                "id"                        => $record->id,
                "cluster_id"                => $record->nama_cluster,
                "rap_rab_id"                => $record->rap_rab_id,
                "tipe_model"                => $record->tipe_model,
                "blok_kapling"              => $record->blok_kapling,
                "nomor_unit_kapling"        => $record->nomor_unit_kapling,
                "jumlah_lantai"             => $record->jumlah_lantai,
                "luas_tanah"                => $record->luas_tanah,
                "luas_bangunan"             => $record->luas_bangunan,
                "harga_kapling"             => $record->harga_kapling,
                "spesifikasi"               => $record->spesifikasi,
                "status_penjualan"          => $record->status_penjualan,
                "status_pembangunan"        => $record->status_pembangunan,
            ];
        }

        return response()->json([
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordsWithFilter,
            "data"            => $data_arr
        ])->header('Content-Type', 'application/json');
    }

    // public function getBookingKavling(Request $request)
    // {
    //     $draw            = $request->get('draw');
    //     $start           = $request->get("start");
    //     $length          = $request->get("length");
    //     $columnIndex_arr = $request->get('order');
    //     $columnName_arr  = $request->get('columns');
    //     $order_arr       = $request->get('order');
    //     $kavlingNamaByClusterFilter = $request->get('cluster_id');
    //     $columnIndex     = $columnIndex_arr[0]['column'];
    //     $columnName      = $columnName_arr[$columnIndex]['data'];
    //     $columnSortOrder = $order_arr[0]['dir'];

    //     $query = BookingKavling::with(['konsumen']);
    //     $totalRecords = BookingKavling::count();

    //     if ($kavlingNamaByClusterFilter) {
    //         $query->where('kapling.cluster_id', 'like', '%' . $kavlingNamaByClusterFilter . '%');
    //     }

    //     $totalRecordsWithFilter = $query->count();

    //     $records = $query
    //         ->orderBy($columnName, $columnSortOrder)
    //         ->offset($start)
    //         ->limit($length)
    //         ->get();

    //     $data_arr = [];

    //     foreach ($records as $key => $record) {

    //         $checkbox = '<input type="checkbox" class="bookingkavling_checkbox" value="'.$record->id.'">';

    //         $data_arr[] = [
    //             "checkbox"                  => $checkbox,
    //             "no"                        => $start + $key + 1,
    //             "id"                        => $record->id,
    //             "kapling_id"                => $record->kapling_id,
    //             "konsumen_id"               => $record->konsumen_id,
    //             "konsumen"                  => $record->konsumen?->nama_1,
    //             "nomor_hp"                  => $record->konsumen?->no_hp_1,
    //             "nomor_booking"             => $record->nomor_booking,
    //             "tanggal_booking"           => $record->tanggal_booking,
    //             "metode_pembayaran"         => $record->metode_pembayaran,
    //             "nomor_spr"                 => $record->nomor_spr,
    //             "status_pengajuan"          => $record->status_pengajuan,
    //         ];
    //     }

    //     return response()->json([
    //         "draw"            => intval($draw),
    //         "recordsTotal"    => $totalRecords,
    //         "recordsFiltered" => $totalRecordsWithFilter,
    //         "data"            => $data_arr
    //     ])->header('Content-Type', 'application/json');
    // }

    public function cetak($id)
    {
        $booking = BookingKavling::with([
            'suratPemesananRumah:id,booking_id,nomor_spr,tanggal_pemesanan,lokasi_pemesanan,deskripsi',
            'konsumen:id,jenis_kelamin_id,status_pengajuan_id,provinsi_code,kota_code,kelurahan_code,kecamatan_code,provinsi_code_1,kota_code_1,kelurahan_code_1,kecamatan_code_1,pekerjaan_1_id,nama_1,npwp_1,tanggal_lahir_1,tempat_lahir_1,email,nik_1,no_hp_1,alamat_konsumen,alamat_1,cluster_id,booking_fee',
            'konsumen.gender:id,nama',
            'kapling:id,cluster_id,blok_kapling,nomor_unit_kapling,luas_tanah,luas_bangunan,harga_kapling',
            'kapling.cluster:id,nama_cluster',
        ])->findOrFail($id)->fresh();

        $biayaRows = BiayaBooking::with(['jenisBiayaBooking:id,kode,nama'])
            ->where('booking_id', $booking->id)
            ->get();

        $codeToProp = [
            'BF'   => 'booking_fee',
            'UM'   => 'uang_muka',
            'ADM'  => 'biaya_administrasi',
            'AKAD' => 'biaya_akad_kredit',
            'KLT'  => 'biaya_kelebihan_tanah',
            'PENB' => 'biaya_penambahan_bangunan',
            'LAIN' => 'biaya_lainnya',
            'FAS'  => 'biaya_penambahan_fasilitas',
            'KPR'  => 'penerimaan_kpr',
            'TPC'  => 'total_penjualan_cash',
            'CIC'  => 'cicilan_cash',
        ];

        $costDefaults = array_fill_keys(array_values($codeToProp), 0);

        $costFilled = [];
        foreach ($biayaRows as $row) {
            $kode = $row->jenisBiayaBooking?->kode;
            if (!$kode) continue;

            $prop = $codeToProp[$kode] ?? null;
            if (!$prop) continue;

            $val = (int) preg_replace('/[^\d]/', '', (string) $row->nominal_biaya);
            $costFilled[$prop] = $val;
        }

        $costs = (object) array_merge($costDefaults, $costFilled);

        $tanggalSppForForm = $booking->tanggal_booking
            ? Carbon::parse($booking->tanggal_booking)->format('d/m/Y')
            : null;

        $tanggalSppHuman = $booking->tanggal_booking
            ? Carbon::parse($booking->tanggal_booking)->locale('id')->isoFormat('dddd, D MMMM Y')
            : null;

        $pdf = Pdf::loadView(
            'marketing.perumahan.kavling.pdf',
            compact('booking','tanggalSppForForm','tanggalSppHuman','costs')
        )->setPaper('A4','portrait');

        return $pdf->stream('SPR-'.$booking->suratPemesananRumah->nomor_spr.'.pdf');
    }

    public function cetakKonsumen($id)
    {
        $booking = BookingKavling::with([
            'konsumen:id,jenis_kelamin_id,status_pengajuan_id,provinsi_code,kota_code,kelurahan_code,kecamatan_code,provinsi_code_1,kota_code_1,kelurahan_code_1,kecamatan_code_1,pekerjaan_1_id,nama_1,npwp_1,tanggal_lahir_1,tempat_lahir_1,email,nik_1,no_hp_1,alamat_konsumen,alamat_1,cluster_id,booking_fee',
            'konsumen.gender:id,nama',
            'konsumen.status_pengajuan:id,nama',
            'konsumen.province:code,name',
            'konsumen.city:code,name',
            'konsumen.district:code,name',
            'konsumen.village:code,name',
            'konsumen.pekerjaan:id,nama',
            'kapling:id,cluster_id,blok_kapling,nomor_unit_kapling,luas_tanah,luas_bangunan,harga_kapling',
            'kapling.cluster:id,nama_cluster',
        ])->findOrFail($id)->fresh();


        $konsumen = $booking->konsumen;
        $provinceSelected = $konsumen->provinsi_code  ? Province::find($konsumen->provinsi_code, ['name']) : null;
        $citySelected     = $konsumen->kota_code      ? City::find($konsumen->kota_code, ['name']) : null;
        $districtSelected = $konsumen->kecamatan_code ? District::find($konsumen->kecamatan_code, ['code','name']) : null;
        $villageSelected  = $konsumen->kelurahan_code ? Village::find($konsumen->kelurahan_code, ['code','name']) : null;

        $tanggalSppForForm = $booking->tanggal_booking
            ? Carbon::parse($booking->tanggal_booking)->format('d/m/Y')
            : null;

        $tanggalSppHuman = $booking->tanggal_booking
            ? Carbon::parse($booking->tanggal_booking)->locale('id')->isoFormat('dddd, D MMMM Y')
            : null;

        $pdf = Pdf::loadView('marketing.perumahan.kavling.konsumenpdf', compact('booking','tanggalSppForForm','tanggalSppHuman','konsumen','provinceSelected','citySelected','districtSelected','villageSelected'))->setPaper('A4','portrait');

        return $pdf->stream('Detail Konsumen '.$booking->konsumen->nama_1.'.pdf');
    }

    public function generateSpr(BookingKavling $booking)
    {
        $spr = $booking->generateNomorSPR();
        sweetalert()->success('SPR berhasil dibuat: '.$spr);
        return redirect()->back();
    }

    public function getBookingKavling(Request $request)
    {
        $draw            = $request->get('draw');
        $start           = $request->get("start");
        $length          = $request->get("length");
        $columnIndex_arr = $request->get('order');
        $columnName_arr  = $request->get('columns');
        $order_arr       = $request->get('order');
        $kavlingNamaByClusterFilter = $request->get('cluster_id');
        $columnIndex     = $columnIndex_arr[0]['column'];
        $columnName      = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];
        $kaplingId       = $request->get('kapling_id');

        $query = BookingKavling::query()
            ->with([
                'konsumen:id,nama_1,no_hp_1',
                'kapling:id,cluster_id,blok_kapling,nomor_unit_kapling',
                'kapling.cluster:id,nama_cluster',
                'suratPemesananRumah',
            ]);

        if ($kaplingId) {
            $query->where('kapling_id', $kaplingId);
        }

        $totalRecords = BookingKavling::count();

        if ($kavlingNamaByClusterFilter) {
            $query->where('kapling.cluster_id', 'like', '%' . $kavlingNamaByClusterFilter . '%');
        }

        $totalRecordsWithFilter = $query->count();

        $records = $query
            ->orderBy($columnName, $columnSortOrder)
            ->offset($start)
            ->limit($length)
            ->get();

        $data_arr = [];

        foreach ($records as $key => $record) {
            $clusterNama  = $record->kapling?->cluster?->nama_cluster ?? '-';
            $kaplingLabel = ($record->kapling->blok_kapling ?? '-').' / '.($record->kapling->nomor_unit_kapling ?? '-');

            $sprItem = empty($record->spr_id)
                ? ' <a class="dropdown-item" href="'.route('spr/add/new', $record->id).'">
                        <div class="dropdown-icon"><i class="fas fa-file-alt"></i></div>
                        <span class="dropdown-content">SPR</span>
                    </a>'
                : ' <a class="dropdown-item" href="'.route('spr/edit', $record->spr_id).'">
                        <div class="dropdown-icon"><i class="fas fa-file-alt"></i></div>
                        <span class="dropdown-content">SPR</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="'.url('konsumen/edit/'.$record->konsumen_id).'">
                        <div class="dropdown-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <span class="dropdown-content">Pembayaran & Biaya</span>
                    </a>'
                ;

            $modify = '
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-primary buttonedit-sm konsumen-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Aksi</button>
                        <div class="dropdown-menu">
                            ' . $sprItem . '
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="'.url('booking/detail/'.$record->id).'">
                                <div class="dropdown-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <span class="dropdown-content">    Booking Detail</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="'.url('booking/konsumen/detail/'.$record->id).'">
                                <div class="dropdown-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="dropdown-content">   Customer Detail</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="'.route('booking/status-update/show', $record->id).'">
                                <div class="dropdown-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <span class="dropdown-content">Update Status</span>
                            </a>
                        </div>
                    </div>
                </div>
            ';

            $checkbox = '<input type="checkbox" class="bookingkavling_checkbox" value="'.$record->id.'">';

            $data_arr[] = [
                "checkbox"         => $checkbox,
                "no"               => $start + $key + 1,
                'id'               => $record->id,
                'kapling_id'       => $record->kapling_id,
                'cluster_nama'     => $clusterNama,
                'kapling_label'    => $kaplingLabel,
                'konsumen_id'      => $record->konsumen_id,
                'konsumen'         => $record->konsumen?->nama_1,
                'nomor_hp'         => $record->konsumen?->no_hp_1,
                'nomor_booking'    => $record->nomor_booking,
                'tanggal_booking'  => $record->tanggal_booking,
                'metode_pembayaran'=> $record->metode_pembayaran,
                'spr_id'           => $record->spr_id,
                'suratPemesananRumah' => $record->suratPemesananRumah?->nomor_spr ?? ' - ',
                'status_pengajuan' => $record->status_pengajuan,
                'modify'           => $modify,
            ];
        }

        return response()->json([
            "draw"            => intval($draw),
            "recordsTotal"    => $totalRecords,
            "recordsFiltered" => $totalRecordsWithFilter,
            "data"            => $data_arr
        ])->header('Content-Type', 'application/json');
    }

}
