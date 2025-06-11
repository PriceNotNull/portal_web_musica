@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">Álbumes</h1>
        <a href="{{ route('albumes.create') }}"
           class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-5 rounded-lg shadow transition duration-200">
            + Crear nuevo álbum
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Imagen</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Artista</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Año</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($albumes as $album)
                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if ($album->imagen)
                            <img src="{{ asset('storage/' . $album->imagen) }}" alt="Imagen del álbum" class="w-20 h-20 object-cover rounded-md">
                        @else
                            <span class="text-gray-400 italic">Sin imagen</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 font-medium">{{ $album->nombre }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">{{ $album->artista->nombre }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">{{ $album->año }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <a href="{{ route('albumes.edit', $album) }}"
                           class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white font-semibold py-1 px-3 rounded-lg mr-2 transition duration-200">
                            Editar
                        </a>
                        <form action="{{ route('albumes.destroy', $album) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro que quieres eliminar este álbum?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded-lg transition duration-200">
                                Eliminar
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
