<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Porudzbina extends Model
{
    protected $fillable = [
        'korisnik_id',
        'vreme_kreiranja',
        'status',
        'ukupna_cena',
    ];

    protected $casts = [
         'vreme_kreiranja' => 'datetime',
         'ukupna_cena' => 'decimal:2',
    ];
    
   public function korisnik() {
        return $this->belongsTo(User::class, 'korisnik_id');
    }

    public function dostavljac() {
        return $this->belongsTo(Dostavljac::class, 'dostavljac_id');
    }

    public function stavkePorudzbine() {
        return $this->hasMany(StavkaPorudzbine::class);
    }
}

