<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dostavljac extends Model
{
    use HasFactory;
    protected $table = 'dostavljaci';
    protected $fillable = [
        'user_id',
        'ime',
        'kontakt',
        'grad',
        'vozilo',
        'napomena',
    ];

    public function porudzbine() {
        return $this->hasMany(Porudzbina::class);
    }

    //ovime povezujemo dostavljaca sa korisnikom, svaki dostavljac je korisnik sa ulogom 'dostavljac'
    public function user() {
        return $this->belongsTo(User::class);
    }

}
