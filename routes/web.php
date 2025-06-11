<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // <-- Agregar esto
use App\Http\Controllers\CancionController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistaController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\VistaPublicaController;

/// Rutas públicas
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return app(VistaPublicaController::class)->index(request());
})->name('inicio');


// Rutas protegidas para administrador
Route::middleware('auth')->group(function () {
    Route::resource('canciones', CancionController::class)
    ->parameters(['canciones' => 'cancion'])
    ->except(['show']);
    Route::resource('albumes', AlbumController::class);
    Route::resource('artistas', ArtistaController::class);
    Route::resource('generos', GeneroController::class);
});
// Mostrar canción individual (pública)
Route::get('/canciones/{cancion}', [CancionController::class, 'show'])->name('cancion.show');
// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
