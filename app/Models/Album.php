<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'albumes';

    protected $fillable = ['nombre', 'artista_id', 'año', 'imagen'];

    // Relación: Álbum pertenece a un Artista
    public function artista()
    {
        return $this->belongsTo(Artista::class);
    }

    // Relación: Álbum tiene muchas canciones
    public function canciones()
    {
        return $this->hasMany(Cancion::class, 'albumes_id');
    }
}
