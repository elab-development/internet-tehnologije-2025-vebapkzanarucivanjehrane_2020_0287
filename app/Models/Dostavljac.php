<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dostavljac extends Model
{
    use HasFactory;
    protected $table = 'dostavljaci';
    protected $fillable = [
        'ime',
        'kontakt',
    ];

    public function porudzbine() {
        return $this->hasMany(Porudzbina::class);
    }

}
