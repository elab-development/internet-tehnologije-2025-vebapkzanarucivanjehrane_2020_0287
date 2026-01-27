<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Porudzbina extends Model
{
    protected $table = 'porudzbine';
    use HasFactory;
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
