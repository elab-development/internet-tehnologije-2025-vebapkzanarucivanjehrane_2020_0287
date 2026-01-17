<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restoran extends Model
{
    protected $fillable = [
        'korisnik_id',
        'lokacija',
        'aktivan',
        'naziv'
    ];

    protected $casts = [
        'aktivan' => 'boolean'
    ];
}
