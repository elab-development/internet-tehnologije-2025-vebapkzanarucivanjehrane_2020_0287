<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restoran extends Model
{
    protected $table = 'restorani';
    protected $primaryKey = 'restoran_id';

    protected $fillable = [
        'restoran_id',
        'naziv',
        'lokacija',
        'aktivan',
    ];

    protected $casts = [
        'restoran_id' => 'integer',
        'naziv' => 'string',
        'adresa' => 'string',
        'kontakt' => 'string',
    ];
    public function jela(){
        return $this->hasMany(Jelo::class, 'restoran_id');
    } 
  
    public function recenzija(): HasMany
    {
        return $this->hasMany(Recenzija::class, 'restoran_id');
    }

}
