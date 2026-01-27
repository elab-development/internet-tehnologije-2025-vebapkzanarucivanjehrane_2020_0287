<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Dostavljac extends Model
{
    use HasFactory;
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
