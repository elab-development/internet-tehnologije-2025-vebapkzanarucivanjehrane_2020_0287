<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jelo extends Model
{
    protected $table = 'jela';

    protected $fillable = [
        'restoran_id',
        'naziv',
        'opis',
        'cena',
    ];

    protected $casts = [
        'naziv' => 'string',
        'opis' => 'string',
        'cena' => 'decimal:2',
        'restoran_id' => 'integer',
    ];
   
    public function restoran(): BelongsTo
    {
        return $this->belongsTo(Restoran::class, 'restoran_id');
    }
    
    public function stavke()
    {
        return $this->hasMany(StavkaPorudzbine::class, 'jelo_id');
    }
}
