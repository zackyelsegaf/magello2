<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\SuratPerintahKerjaInternal;


class SuratPerintahKerjaInternalListFee extends Model
{
    use HasFactory;

    protected $table = 'spk_list_fee';
    protected $guarded = ['id'];
    // protected $fillable = [
    //     'spk_id',
    //     'nominal_perjanjian',
    //     'nama_kapling',
    //     'pekerjaan',
    //     'nama_termin',
    //     'persen_pekerjaan',
    //     'persen_pembayaran',
    //     'nilai_termin',
    //     'total_persentase_pembayaran',
    //     'total_nilai_termin',
    //     'grand_total_persentase_pembayaran',
    //     'grand_total_nilai_termin',
    //     'upah',
    //     'retensi'
    // ];

    public function spk()
    {
        return $this->belongsTo(SuratPerintahKerjaInternal::class, 'spk_id', 'id');
    }
}
