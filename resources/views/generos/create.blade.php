@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow mt-10">
    <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Crear Género</h1>

    @if($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-700 rounded shadow">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('generos.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre:</label>
            <input 
                type="text" 
                name="nombre" 
                id="nombre"
                value="{{ old('nombre') }}" 
                required
                class="w-full px-3 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-gray-200"
            >
        </div>

        <div class="flex items-center space-x-4">
            <button type="submit" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded shadow transition duration-200">
                Guardar
            </button>
            <a href="{{ route('generos.index') }}" 
                class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 font-semibold">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
