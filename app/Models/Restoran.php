<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restoran extends Model
{

    protected $table = 'restorani';
    protected $fillable = [
        'naziv',
        'lokacija',
        'aktivan'
    ];

    protected $casts = [
        'aktivan' => 'boolean'
    ];

    public function jela() {
        return $this->hasMany(Jelo::class);
    }

    public function recenzije() {
        return $this->hasMany(Recenzija::class);
    }
}
