<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artista;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function index()
    {
        $albumes = Album::with('artista')->get();
        return view('albumes.index', compact('albumes'));
    }

    public function create()
    {
        $artistas = Artista::all();
        return view('albumes.create', compact('artistas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'año' => 'required|integer|min:1900|max:' . now()->year,
            'artista_id' => 'required|exists:artistas,id',
            'imagen' => 'nullable|image'
        ]);

        $data = $request->only(['nombre', 'año', 'artista_id']);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('albumes', 'public');
        }

        Album::create($data);
        return redirect()->route('albumes.index')->with('success', 'Álbum creado con éxito.');
    }

    public function edit(Album $albume)
    {
        $artistas = Artista::all();
        return view('albumes.edit', compact('albume', 'artistas'));
    }

    public function update(Request $request, Album $albume)
    {
        $request->validate([
            'nombre' => 'required',
            'año' => 'required|integer|min:1900|max:' . now()->year,
            'artista_id' => 'required|exists:artistas,id',
            'imagen' => 'nullable|image'
        ]);

        $data = $request->only(['nombre', 'año', 'artista_id']);

        if ($request->hasFile('imagen')) {
            if ($albume->imagen) {
                Storage::disk('public')->delete($albume->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('albumes', 'public');
        }

        $albume->update($data);
        return redirect()->route('albumes.index')->with('success', 'Álbum actualizado.');
    }

    public function destroy(Album $albume)
    {
        if ($albume->imagen) {
            Storage::disk('public')->delete($albume->imagen);
        }

        $albume->delete();
        return redirect()->route('albumes.index')->with('success', 'Álbum eliminado.');
    }
}