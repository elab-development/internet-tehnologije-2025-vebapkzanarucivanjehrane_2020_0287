<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restoran extends Model
{
    protected $table = 'restorani';
    protected $primaryKey = 'restoran_id';

    protected $fillable = [
        'naziv',
        'lokacija',
        'aktivan',
    ];

    protected $casts = [
        'naziv' => 'string',
        'lokacija' => 'string',
        'aktivan' => 'boolean',
    ];
    public function jela(){
        return $this->hasMany(Jelo::class);
    } 
  
    public function recenzije(): HasMany
    {
        return $this->hasMany(Recenzija::class);
    }

}
