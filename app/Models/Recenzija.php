<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Recenzija extends Model
{
    protected $table = 'recenzije';
    use HasFactory;
    protected $fillable = [
        'korisnik_id',
        'restoran_id',
        'ocena',
        'komentar',
    ];

    protected $casts = [
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
