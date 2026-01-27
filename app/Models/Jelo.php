<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Restoran;
use App\Models\StavkaPorudzbine;

class Jelo extends Model
{
    protected $table = 'jela';
    use HasFactory;
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
