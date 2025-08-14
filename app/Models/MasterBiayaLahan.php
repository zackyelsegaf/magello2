<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBiayaLahan extends Model
{
    /** @use HasFactory<\Database\Factories\MasterBiayaLahanFactory> */
    use HasFactory;

    protected $table = 'master_biaya_lahans';

    protected $guarded = ['id'];

    public function akunPerolehan()
    {
        return $this->belongsTo(Akun::class, 'akun_perolehan_id');
    }

    public function akunClosing()
    {
        return $this->belongsTo(Akun::class, 'akun_closing_id');
    }
}
