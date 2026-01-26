<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dostavljac extends Model
{
    protected $table = 'dostavljaci';

    protected $fillable = [
        'ime',
        'kontakt',
    ];
        protected $casts = [
         'ime' => 'string',
         'kontakt' => 'string',
        ];        
    
    public function porudzbine()
    {
        return $this->hasMany(Porudzbina::class, 'dostavljac_id');
    }   



}
