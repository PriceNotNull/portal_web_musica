@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow mt-10">
    <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Canciones</h1>

    <a href="{{ route('canciones.create') }}"
       class="inline-block mb-4 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-5 rounded shadow transition duration-200">
        + Crear nueva canción
    </a>

    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Álbum</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Duración</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Enlace preview</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($canciones as $cancion)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $cancion->nombre }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $cancion->album->nombre ?? 'Sin álbum' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $cancion->duracion }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-blue-600 dark:text-blue-400">
                            @if ($cancion->enlace_preview)
                                <a href="{{ $cancion->enlace_preview }}" target="_blank" class="underline hover:text-blue-800 dark:hover:text-blue-600">Ver</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('canciones.edit', $cancion) }}"
                               class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-semibold py-1 px-3 rounded shadow mr-2 transition duration-200">
                                Editar
                            </a>
                            <form action="{{ route('canciones.destroy', $cancion) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white text-sm font-semibold py-1 px-3 rounded shadow transition duration-200">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $canciones->links() }}
    </div>
</div>
@endsection
