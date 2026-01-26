<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StavkaPorudzbine extends Model
{
    protected $table = 'stavke_porudzbine';
    protected $primaryKey = 'stavka_id';

    protected $fillable = [
        'stavka_id',
        'porudzbina_id',
        'jelo_id',
        'kolicina',
        'cena',
    ];

    protected $casts = [
        'stavka_id' => 'integer',
        'porudzbina_id' => 'integer',
        'jelo_id' => 'integer',
        'kolicina' => 'integer',
        'cena' => 'decimal:2',
    ];

    public function porudzbina()
    {
        return $this->belongsTo(Porudzbina::class, 'porudzbina_id');
    }

    public function jelo()
    {
        return $this->belongsTo(Jelo::class, 'jelo_id');
    }
}
