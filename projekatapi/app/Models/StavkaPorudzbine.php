<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StavkaPorudzbine extends Model
{
    use HasFactory;
    protected $table = 'stavke_porudzbine';
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

    public function porudzbina() {
        return $this->belongsTo(Porudzbina::class, 'porudzbina_id');
    }

    public function jelo() {
        return $this->belongsTo(Jelo::class, 'jelo_id');
    }
}
