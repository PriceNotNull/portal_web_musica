<?php

namespace App\Http\Controllers;

use App\Models\Cancion;
use App\Models\Album;
use Illuminate\Http\Request;

class CancionController extends Controller
{
    public function index()
    {
        // Obtener todas las canciones con su álbum para mostrar el nombre del álbum
        $canciones = Cancion::with('album')->paginate(10);
        return view('canciones.index', compact('canciones'));
    }

    public function create()
    {
        // Obtener todos los álbumes para el select
        $albumes = Album::all();
        return view('canciones.create', compact('albumes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'albumes_id' => 'required|exists:albumes,id',
            'duracion' => ['required', 'regex:/^\d{2}:\d{2}$/'], // formato mm:ss
            'enlace_preview' => 'nullable|url',
        ]);

        Cancion::create($request->all());

        return redirect()->route('canciones.index')->with('success', 'Canción creada correctamente');
    }

    public function edit(Cancion $cancion)
    {
        $albumes = Album::all();
        return view('canciones.edit', compact('cancion', 'albumes'));
    }

    public function update(Request $request, Cancion $cancion)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'albumes_id' => 'required|exists:albumes,id',
            'duracion' => ['required', 'regex:/^\d{2}:\d{2}$/'],
            'enlace_preview' => 'nullable|url',
        ]);

        $cancion->update($request->all());

        return redirect()->route('canciones.index')->with('success', 'Canción actualizada correctamente');
    }

    public function destroy(Cancion $cancion)
    {
        $cancion->delete();
        return redirect()->route('canciones.index')->with('success', 'Canción eliminada correctamente');
    }
    public function show($id)
    {
        $cancion = Cancion::with('album.artista.genero')->findOrFail($id);
        return view('usuario.detalle', compact('cancion'));
    }
}