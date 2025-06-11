<?php

namespace App\Http\Controllers;

use App\Models\Artista;
use App\Models\Genero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtistaController extends Controller
{
    public function index()
    {
        $artistas = Artista::with('genero')->get();
        return view('artistas.index', compact('artistas'));
    }

    public function create()
    {
        $generos = Genero::all();
        return view('artistas.create', compact('generos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'genero_id' => 'required|exists:generos,id',
            'bio' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('artistas', 'public');
        }

        Artista::create($data);

        return redirect()->route('artistas.index')->with('success', 'Artista creado con éxito.');
    }

    public function edit(Artista $artista)
    {
        $generos = Genero::all();
        return view('artistas.edit', compact('artista', 'generos'));
    }

    public function update(Request $request, Artista $artista)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'genero_id' => 'required|exists:generos,id',
            'bio' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('imagen')) {
            if ($artista->imagen) {
                Storage::disk('public')->delete($artista->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('artistas', 'public');
        }

        $artista->update($data);

        return redirect()->route('artistas.index')->with('success', 'Artista actualizado con éxito.');
    }

    public function destroy(Artista $artista)
    {
        if ($artista->imagen) {
            Storage::disk('public')->delete($artista->imagen);
        }

        $artista->delete();

        return redirect()->route('artistas.index')->with('success', 'Artista eliminado.');
    }
}
