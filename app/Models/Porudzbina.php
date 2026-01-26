<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Porudzbina extends Model
{
    protected $table = 'porudzbine';
    protected $primaryKey = 'porudzbina_id';

    protected $fillable = [
        'porudzbina_id',
        'dostavljac_id',
        'vreme_kreiranja',
        'status',
        'ukupna_cena',
    ];

    protected $casts = [
        'porudzbina_id' => 'integer',
        'dostavljac_id' => 'integer',
        'vreme_kreiranja' => 'datetime',
        'status' => 'string',
        'ukupna_cena' => 'decimal:2',
    ];

    public function dostavljac()
    {
        return $this->belongsTo(Dostavljac::class, 'dostavljac_id');
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
