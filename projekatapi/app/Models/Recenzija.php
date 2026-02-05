<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recenzija extends Model
{
        use HasFactory;
        protected $table = 'recenzije';
        protected $fillable = [
            'user_id',
            'restoran_id',
            'ocena',
            'komentar',
        ];

        protected $casts = [
        'ocena' => 'integer',
         ];

         public function korisnik() {
            return $this->belongsTo(User::class,'user_id');
        }

        public function restoran() {
            return $this->belongsTo(Restoran::class);
        }   
}
