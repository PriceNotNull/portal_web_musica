<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cancion;
use App\Models\Artista;
use App\Models\Album;
use App\Models\Genero;

class VistaPublicaController extends Controller
{
    public function index(Request $request)
    {
        $filtroGenero = $request->input('genero');
        $busqueda = $request->input('q');

        $canciones = Cancion::with('album.artista.genero')
            ->when($filtroGenero, function ($query, $generoId) {
                $query->whereHas('album.artista', function ($q) use ($generoId) {
                    $q->where('genero_id', $generoId);
                });
            })
            ->when($busqueda, function ($query, $busqueda) {
                $query->where(function ($q) use ($busqueda) {
                    $q->where('nombre', 'like', '%' . $busqueda . '%')
                    ->orWhereHas('album.artista', function ($q2) use ($busqueda) {
                        $q2->where('nombre', 'like', '%' . $busqueda . '%');
                    });
                });
            })
            ->latest()
            ->paginate(12);

        return view('usuario.inicio', [
            'canciones' => $canciones,
            'generos' => \App\Models\Genero::all(),
            'generoActivo' => $filtroGenero,
            'busqueda' => $busqueda,
        ]);
    }
    public function show(Cancion $cancion)
    {
        $cancion->load('album.artista.genero');
        return view('usuario.detalle', compact('cancion'));
    }
}