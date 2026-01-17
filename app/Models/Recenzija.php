<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recenzija extends Model
{
        protected $table = 'recenzije';
        protected $fillable = [
            'korisnik_id',
            'restoran_id',
            'ocena',
            'komentar',
        ];

        protected $casts = [
        'ocena' => 'integer',
         ];

         public function korisnik() {
            return $this->belongsTo(User::class);
        }

        public function restoran() {
            return $this->belongsTo(Restoran::class);
        }   
}
