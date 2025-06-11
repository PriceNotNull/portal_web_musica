@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow">
    {{-- Imagen del Álbum --}}
    <div class="text-center mb-6">
        <img src="{{ asset('storage/' . $cancion->album->imagen) }}" alt="Álbum"
            class="mx-auto w-64 h-64 object-cover rounded shadow">
    </div>

    {{-- Información del Álbum --}}
    <div class="text-center mb-6">
        <h1 class="text-2xl font-bold">{{ $cancion->album->nombre }}</h1>
        <p class="text-gray-500">{{ $cancion->album->año }} • {{ $cancion->album->artista->genero->nombre }}</p>
    </div>

    {{-- Artista --}}
    <div class="flex items-start gap-6 mb-6">
        <img src="{{ asset('storage/' . $cancion->album->artista->imagen) }}" alt="Artista"
            class="w-32 h-32 object-cover rounded-full border shadow">
        <div>
            <h2 class="text-xl font-semibold">{{ $cancion->album->artista->nombre }}</h2>
            <p id="bio" class="text-gray-600 mt-2 line-clamp-3 transition-all duration-300">
                {{ $cancion->album->artista->biografia }}
            </p>
            <button id="toggleBio" class="mt-2 text-blue-600 text-sm hover:underline">Ver más</button>
        </div>
    </div>

    {{-- Canción --}}
    <div class="mb-6">
        <h3 class="text-xl font-semibold">Canción: {{ $cancion->nombre }}</h3>
        <p>Duración: {{ $cancion->duracion }}</p>
    </div>

    {{-- Enlace de preview --}}
    @if($cancion->enlace_preview)
    <div class="mb-4">
        <a href="{{ $cancion->enlace_preview }}" target="_blank" class="text-blue-600 hover:underline">
            Escuchar 🎵
        </a>
    </div>
    @endif

    <a href="{{ route('inicio') }}" class="text-gray-500 hover:text-gray-800 text-sm">&larr; Volver</a>
</div>

{{-- Estilos de línea clamp --}}
<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

{{-- Script para ver más / ver menos --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const bio = document.getElementById('bio');
    const toggleBtn = document.getElementById('toggleBio');

    if (bio && toggleBtn) {
        toggleBtn.addEventListener('click', () => {
            bio.classList.toggle('line-clamp-3');
            toggleBtn.textContent = bio.classList.contains('line-clamp-3') ? 'Ver más' : 'Ver menos';
        });
    }
});
</script>

@endsection