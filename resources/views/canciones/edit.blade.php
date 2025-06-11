@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow mt-10">
    <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Editar Canción</h1>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded shadow">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('canciones.update', $cancion) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Nombre</label>
            <input type="text" name="nombre" 
                value="{{ old('nombre', $cancion->nombre) }}" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
        </div>

        <div>
            <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Álbum</label>
            <select name="albumes_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                @foreach ($albumes as $album)
                    <option value="{{ $album->id }}" {{ (old('albumes_id', $cancion->albumes_id) == $album->id) ? 'selected' : '' }}>
                        {{ $album->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Duración (mm:ss)</label>
            <input type="text" name="duracion" placeholder="03:25" 
                value="{{ old('duracion', $cancion->duracion) }}" required pattern="\d{2}:\d{2}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
        </div>

        <div>
            <label class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Enlace preview (YouTube, SoundCloud, etc.)</label>
            <input type="url" name="enlace_preview" 
                value="{{ old('enlace_preview', $cancion->enlace_preview) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded shadow transition duration-200">
                Actualizar
            </button>
            <a href="{{ route('canciones.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded shadow transition duration-200">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
