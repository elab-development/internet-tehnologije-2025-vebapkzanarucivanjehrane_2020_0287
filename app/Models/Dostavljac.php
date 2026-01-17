<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dostavljac extends Model
{
    protected $fillable = [
        'ime',
        'kontakt',
    ];

    public function porudzbine() {
        return $this->hasMany(Porudzbina::class);
    }

}
