<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recenzija extends Model
{
    protected $table = 'recenzije';
    protected $primaryKey = 'recenzija_id';

    protected $fillable = [
        'korisnik_id',
        'restoran_id',
        'ocena',
        'komentar',
    ];

    protected $casts = [
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
