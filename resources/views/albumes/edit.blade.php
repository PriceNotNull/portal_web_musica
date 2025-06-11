@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 bg-white dark:bg-gray-800 rounded-lg shadow">
    <h1 class="text-3xl font-bold mb-8 text-gray-900 dark:text-gray-100">Editar Álbum</h1>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg shadow">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('albumes.update', $albume) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $albume->nombre) }}" required
                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label for="artista_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Artista</label>
            <select name="artista_id" id="artista_id" required
                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @foreach ($artistas as $artista)
                    <option value="{{ $artista->id }}" @if(old('artista_id', $albume->artista_id) == $artista->id) selected @endif>
                        {{ $artista->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="año" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Año</label>
            <input type="number" name="año" id="año" value="{{ old('año', $albume->año) }}" required
                class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Imagen actual:</label>
            @if ($albume->imagen)
                <img src="{{ asset('storage/' . $albume->imagen) }}" alt="Imagen del álbum" class="w-24 rounded-md shadow">
            @else
                <p class="text-gray-500 dark:text-gray-400">Sin imagen</p>
            @endif
        </div>

        <div>
            <label for="imagen" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cambiar Imagen</label>
            <input type="file" name="imagen" id="imagen"
                class="mt-1 block w-full text-gray-900 dark:text-gray-100 file:border file:border-gray-300 dark:file:border-gray-600 file:rounded file:px-3 file:py-2 file:bg-gray-100 dark:file:bg-gray-700 file:text-gray-700 dark:file:text-gray-300 file:cursor-pointer">
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-200">
                Actualizar
            </button>
            <a href="{{ route('albumes.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-200">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
