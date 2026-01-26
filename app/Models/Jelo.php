<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jelo extends Model
{
    protected $table = 'jela';
    protected $primaryKey = 'jelo_id';

    protected $fillable = [
        'jelo_id',
        'restoran_id',
        'naziv',
        'opis',
        'cena',
    ];

    protected $casts = [
        'jelo_id' => 'integer',
        'naziv' => 'string',
        'opis' => 'string',
        'cena' => 'decimal:2',
        'restoran_id' => 'integer',
    ];
   
    public function restoran(): BelongsTo
    {
        return $this->belongsTo(Restoran::class, 'restoran_id');
    }
    
}
