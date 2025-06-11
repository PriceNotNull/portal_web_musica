@extends('layouts.app')

@section('header')
@endsection

@section('content')
<div class="container mx-auto px-4 min-h-screen">

    {{-- Filtro de género como dropdown --}}
    <div class="mb-4 max-w-sm">
        <label for="genero-select" class="block mb-1 font-semibold text-gray-700">Filtrar por género:</label>
        <form method="GET" action="{{ route('inicio') }}">
            <select id="genero-select" name="genero" onchange="this.form.submit()"
                class="w-full border border-gray-300 rounded px-3 py-2">
                <option value="" {{ request('genero') ? '' : 'selected' }}>Todas</option>
                @foreach ($generos as $genero)
                <option value="{{ $genero->id }}" {{ request('genero') == $genero->id ? 'selected' : '' }}>
                    {{ $genero->nombre }}
                </option>
                @endforeach
            </select>
        </form>
    </div>

    {{-- Barra de Búsqueda --}}
    <form method="GET" action="{{ route('inicio') }}"
        class="mb-6 flex flex-wrap gap-2 items-center justify-end max-w-sm">
        <input type="text" name="q" placeholder="Buscar canción o artista..." value="{{ request('q') }}"
            class="border border-gray-300 rounded px-4 py-2 w-full sm:w-64">
        {{-- Mantener filtro género en el formulario de búsqueda --}}
        @if (request('genero'))
        <input type="hidden" name="genero" value="{{ request('genero') }}">
        @endif
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Buscar
        </button>
    </form>

    {{-- Grid de canciones --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($canciones as $cancion)
        <div class="bg-white shadow rounded overflow-hidden">
            <a href="{{ route('cancion.show', $cancion->id) }}">
                @if ($cancion->album->imagen)
                <img src="{{ asset('storage/' . $cancion->album->imagen) }}" alt="Imagen del álbum"
                    class="w-full h-48 object-cover hover:opacity-80 transition duration-200">
                @else
                <div
                    class="w-full h-48 bg-gray-300 flex items-center justify-center text-gray-600 hover:opacity-80 transition duration-200">
                    Sin imagen
                </div>
                @endif
            </a>
            <div class="p-3">
                <h3 class="text-center font-semibold">{{ $cancion->nombre }}</h3>
            </div>
        </div>
        @empty
        <p class="col-span-4 text-center text-gray-600">No se encontraron canciones.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $canciones->appends(['genero' => request('genero'), 'q' => request('q')])->links() }}
    </div>
</div>

@endsection