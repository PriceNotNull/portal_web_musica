@extends('layouts.app')

@section('header')
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-8 text-gray-900 dark:text-gray-100">
                <h1 class="text-3xl font-extrabold mb-10 text-center text-gray-800 dark:text-gray-100">
                    Bienvenido al Panel de Administración
                </h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                    <a href="{{ route('artistas.index') }}" class="flex flex-col items-center bg-indigo-100 hover:bg-indigo-200 dark:bg-indigo-600 dark:hover:bg-indigo-700 text-indigo-800 dark:text-white font-semibold py-6 px-4 rounded-xl shadow transition duration-200">
                        🎤
                        <span class="mt-2">CRUD Artistas</span>
                    </a>

                    <a href="{{ route('canciones.index') }}" class="flex flex-col items-center bg-green-100 hover:bg-green-200 dark:bg-green-600 dark:hover:bg-green-700 text-green-800 dark:text-white font-semibold py-6 px-4 rounded-xl shadow transition duration-200">
                        🎶
                        <span class="mt-2">CRUD Canciones</span>
                    </a>

                    <a href="{{ route('albumes.index') }}" class="flex flex-col items-center bg-purple-100 hover:bg-purple-200 dark:bg-purple-600 dark:hover:bg-purple-700 text-purple-800 dark:text-white font-semibold py-6 px-4 rounded-xl shadow transition duration-200">
                        💿
                        <span class="mt-2">CRUD Álbumes</span>
                    </a>

                    <a href="{{ route('generos.index') }}" class="flex flex-col items-center bg-pink-100 hover:bg-pink-200 dark:bg-pink-600 dark:hover:bg-pink-700 text-pink-800 dark:text-white font-semibold py-6 px-4 rounded-xl shadow transition duration-200">
                        🎧
                        <span class="mt-2">CRUD Géneros</span>
                    </a>
                </div>

                <form method="POST" action="{{ route('logout') }}" class="text-center">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-lg transition duration-200 shadow">
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
