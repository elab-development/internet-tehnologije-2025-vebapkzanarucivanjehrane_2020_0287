<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recenzija extends Model
{
        protected $fillable = [
            'korisnik_id',
            'restoran_id',
            'ocena',
            'komentar',
        ];

        protected $casts = [
        'ocena' => 'integer',
         ];
}
