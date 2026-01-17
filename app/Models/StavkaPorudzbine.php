<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StavkaPorudzbine extends Model
{
   protected $fillable = [
          'porudzbina_id',
          'jelo_id',
          'kolicina',
          'cena',
   ]; 

   protected $casts = [
        'cena' => 'decimal:2',
        'kolicina' => 'integer',
    ];
}
