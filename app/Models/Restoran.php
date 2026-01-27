<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Jelo;
use App\Models\Recenzija;

class Restoran extends Model
{
    use HasFactory;
    protected $table = 'restorani';
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
