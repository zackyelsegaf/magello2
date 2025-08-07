<?php

namespace App\Models\BukuBesar;

use App\Models\Akun;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnggaranAkun extends Model
{
    protected $table = 'anggaran_akun';
    protected $guarded = ['id'];

    public function akun(): BelongsTo
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }
}
