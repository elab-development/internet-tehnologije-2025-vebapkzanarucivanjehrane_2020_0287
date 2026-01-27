<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Porudzbina extends Model
{   
    use HasFactory;
    protected $table = 'porudzbine';
    protected $fillable = [
        'user_id',
        'dostavljac_id',
        'vreme_kreiranja',
        'status',
        'ukupna_cena',
        'adresa_isporuke',
    ];

    protected $casts = [
         'vreme_kreiranja' => 'datetime',
         'ukupna_cena' => 'decimal:2',
    ];
    
   public function korisnik() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function dostavljac() {
        return $this->belongsTo(Dostavljac::class, 'dostavljac_id');
    }

    public function stavkePorudzbine() {
        return $this->hasMany(StavkaPorudzbine::class, 'porudzbina_id');
    }
}

