<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Porudzbina extends Model
{
    protected $table = 'porudzbine';

    protected $fillable = [
        'dostavljac_id',
        'korisnik_id',
        'vreme_kreiranja',
        'status',
        'ukupna_cena',
        'adresa_isporuke',
    ];

    protected $casts = [
        'vreme_kreiranja' => 'datetime',
        'status' => 'string',
        'ukupna_cena' => 'decimal:2',
    ];

    public function dostavljac()
    {
        return $this->belongsTo(Dostavljac::class);
    }

    public function stavke()
    {
        return $this->hasMany(StavkaPorudzbine::class, 'porudzbina_id');
    }

    public function korisnik()
    {
        return $this->belongsTo(User::class, 'korisnik_id');
    }
}
