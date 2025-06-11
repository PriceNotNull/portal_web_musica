@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-lg shadow mt-10">
    <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Crear Artista</h1>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded shadow">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('artistas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div>
            <label for="nombre" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
        </div>

        <div>
            <label for="genero_id" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Género:</label>
            <select id="genero_id" name="genero_id"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100" required>
                <option value="">-- Selecciona un género --</option>
                @foreach ($generos as $genero)
                    <option value="{{ $genero->id }}" {{ old('genero_id') == $genero->id ? 'selected' : '' }}>
                        {{ $genero->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="bio" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Biografía:</label>
            <textarea id="bio" name="bio" rows="4"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100"
                required>{{ old('bio') }}</textarea>
        </div>

        <div>
            <label for="imagen" class="block text-gray-700 dark:text-gray-300 font-semibold mb-1">Imagen:</label>
            <input type="file" id="imagen" name="imagen"
                class="w-full text-gray-700 dark:text-gray-300">
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded shadow transition duration-200">
                Guardar
            </button>
            <a href="{{ route('artistas.index') }}"
                class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-6 rounded shadow transition duration-200 flex items-center justify-center">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
