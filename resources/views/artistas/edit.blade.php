@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow mt-10">
    <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Editar Artista</h1>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded shadow">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('artistas.update', $artista) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="nombre" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $artista->nombre) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
        </div>

        <div>
            <label for="genero_id" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Género:</label>
            <select id="genero_id" name="genero_id"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                @foreach ($generos as $genero)
                    <option value="{{ $genero->id }}" {{ (old('genero_id', $artista->genero_id) == $genero->id) ? 'selected' : '' }}>
                        {{ $genero->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="bio" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Biografía:</label>
            <textarea id="bio" name="bio" rows="4"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>{{ old('bio', $artista->bio) }}</textarea>
        </div>

        <div>
            <label class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Imagen actual:</label>
            @if ($artista->imagen)
                <img src="{{ asset('storage/' . $artista->imagen) }}" alt="Imagen del artista" class="mb-4 rounded shadow w-32 h-auto">
            @else
                <p class="text-gray-500 dark:text-gray-400 mb-4">No hay imagen</p>
            @endif
            <label for="imagen" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Cambiar Imagen:</label>
            <input type="file" id="imagen" name="imagen" class="w-full text-gray-700 dark:text-gray-300">
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded shadow transition duration-200">
                Actualizar
            </button>
            <a href="{{ route('artistas.index') }}"
                class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded shadow transition duration-200 flex items-center justify-center">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
