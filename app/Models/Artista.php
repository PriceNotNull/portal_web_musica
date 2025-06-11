<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'imagen', 'bio', 'genero_id'];

    public function genero()
    {
        return $this->belongsTo(Genero::class);
    }
    public function getBiografiaAttribute()
    {
        return $this->bio;
    }

}