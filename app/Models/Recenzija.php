<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recenzija extends Model
{
    protected $table = 'recenzije';
    protected $primaryKey = 'recenzija_id';

    protected $fillable = [
        'recenzija_id',
        'korisnik_id',
        'restoran_id',
        'ocena',
        'komentar',
    ];

    protected $casts = [
        'recenzija_id' => 'integer',
        'korisnik_id' => 'integer',
        'restoran_id' => 'integer',
        'ocena' => 'integer',
        'komentar' => 'string',
    ];

    public function korisnik()
    {
        return $this->belongsTo(User::class, 'korisnik_id');
    }

    public function restoran()
    {
        return $this->belongsTo(Restoran::class, 'restoran_id');
    }
}
