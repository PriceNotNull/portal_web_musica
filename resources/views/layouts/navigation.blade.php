<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700 p-4">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
        {{-- Logo + Título --}}
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-8 w-8">
            <h1 class="text-xl font-semibold text-gray-800 dark:text-white">
                Bienvenido a Mi Portal Musical
            </h1>
        </div>

        {{-- Botón de login --}}
        @guest
        <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            Iniciar sesión
        </a>
        @endguest
    </div>
</nav>
