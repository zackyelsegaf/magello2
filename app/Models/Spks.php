<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spks extends Model
{
    /** @use HasFactory<\Database\Factories\SpksFactory> */
    use HasFactory;

    protected $table = 'spks';
    protected $guarded = ['id'];

    const TIPE_INTERNAL = 1;
    const TIPE_SUBCON   = 2;

    const PEMBAYARAN_TERMIN = 1;
    const PEMBAYARAN_FULL   = 2;

    public function pekerja()
    {
        return $this->belongsTo(Pekerja::class);
    }

    public function siklusPembayaran()
    {
        return $this->belongsTo(SiklusPembayaran::class);
    }

    public function spp()
    {
        return $this->belongsTo(SuratPerintahPembangunan::class, 'spp_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function isSubcon(): bool
    {
        return $this->tipe === self::TIPE_SUBCON;
    }

    public function isInternal(): bool
    {
        return $this->tipe === self::TIPE_INTERNAL;
    }

    public function getTipeLabelAttribute()
    {
        return match ($this->tipe) {
            self::TIPE_INTERNAL => 'INTERNAL',
            self::TIPE_SUBCON => 'SUBCON',
            default => 'UNKNOWN',
        };
    }

    public function getTipePembayaranSubconLabelAttribute()
    {
        return match ($this->tipe_pembayaran_subcon) {
            self::PEMBAYARAN_TERMIN => 'Termin',
            self::PEMBAYARAN_FULL => 'Full Financing',
            default => null,
        };
    }
}
