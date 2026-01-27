<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class StavkaPorudzbine extends Model
{
    use HasFactory;
    protected $table = 'stavke';
    protected $fillable = [
        'porudzbina_id',
        'jelo_id',
        'kolicina',
        'cena',
    ];

    protected $casts = [
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
