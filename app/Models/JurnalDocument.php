<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalDocument extends Model
{
    /** @use HasFactory<\Database\Factories\JurnalDocumentFactory> */
    use HasFactory;

    protected $table = 'jurnal_documents';
    protected $guarded = ['id'];

     public function journal()
    {
        return $this->belongsTo(Jurnal::class);
    }
}
