<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpkDetail extends Model
{
    /** @use HasFactory<\Database\Factories\SpkDetailFactory> */
    use HasFactory;

        protected $table = 'spk_details';

    protected $guarded = ['id'];
}
