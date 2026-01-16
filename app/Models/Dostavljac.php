<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dostavljac extends Model
{
    protected $fillable = [
        'dostavljac_id',
        'ime',
        'kontakt',
    ];

}
