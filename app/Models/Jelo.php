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
        'cena' => 'decimal:2'
   ];

   public function restoran() {
        return $this->belongsTo(Restoran::class);
    }

    public function stavkePorudzbine() {
        return $this->hasMany(StavkaPorudzbine::class, 'jelo_id');
    }
}
