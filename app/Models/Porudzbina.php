<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Porudzbina extends Model
{
    protected $fillable = [
        'porudzbina_id',
        'vreme_kreiranja',
        'status',
        'ukupna_cena',
    ];

        protected $casts = [
         'vreme_kreiranja' => 'datetime',
         'ukupna_cena' => 'decimal:2',
    ];
}

