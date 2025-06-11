@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 bg-white dark:bg-gray-800 rounded-lg shadow">
    <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Lista de Artistas</h1>

    <a href="{{ route('artistas.create') }}" 
       class="inline-block mb-6 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
        ➕ Nuevo Artista
    </a>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full table-auto border-collapse border border-gray-200 dark:border-gray-700">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Nombre</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Género</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Imagen</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Bio</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-900 dark:text-gray-100">
                @foreach ($artistas as $artista)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $artista->nombre }}</td>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ $artista->genero->nombre }}</td>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">
                        @if ($artista->imagen)
                            <img src="{{ asset('storage/' . $artista->imagen) }}" alt="Imagen del artista" class="w-20 rounded">
                        @else
                            <span class="text-gray-500 dark:text-gray-400">No imagen</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2">{{ Str::limit($artista->bio, 50) }}</td>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 space-x-2">
                        <a href="{{ route('artistas.edit', $artista) }}"
                            class="inline-block bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-1 px-3 rounded shadow transition duration-200">
                            ✏️ Editar
                        </a>
                        <form action="{{ route('artistas.destroy', $artista) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar artista?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded shadow transition duration-200">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
