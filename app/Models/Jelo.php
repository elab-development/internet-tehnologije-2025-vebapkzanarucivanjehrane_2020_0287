<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jelo extends Model
{
   protected $fillable = [
        'restoran_id',
        'naziv',
        'opis',
        'cena',
    ]; 

   protected $casts = [
        'cena' => 'decimal:2'
   ];
}
