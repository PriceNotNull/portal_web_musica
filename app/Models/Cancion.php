<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cancion extends Model
{
    use HasFactory;

    protected $table = 'canciones';

    protected $fillable = ['nombre', 'albumes_id', 'duracion', 'enlace_preview'];

    // Relación: Canción pertenece a un Álbum
    public function album()
    {
        return $this->belongsTo(Album::class, 'albumes_id');
    }
}
