<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnggaranAkun extends Model
{
    /** @use HasFactory<\Database\Factories\AnggaranAkunFactory> */
    use HasFactory;

    protected $table = 'anggaran_akuns';
    protected $guarded = ['id'];

    public function akun(): BelongsTo
    {
        return $this->belongsTo(Akun::class, 'akun_id');
    }
}
