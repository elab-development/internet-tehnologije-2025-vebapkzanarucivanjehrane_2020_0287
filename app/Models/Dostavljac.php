<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dostavljac extends Model
{
    protected $table = 'dostavljaci';
    protected $primaryKey = 'dostavljac_id';

    protected $fillable = [
        'dostavljac_id',    
        'ime',
        'kontakt',
        'adresa',
    ];
        protected $casts = [
        'dostavljac_id' => 'integer',  
         'ime' => 'string',
         'kontakt' => 'string',
         'adresa' => 'string',
        ];        
    
    public function porudzbina()
    {
        return $this->hasMany(Porudzbina::class, 'dostavljac_id');
    }   



}
