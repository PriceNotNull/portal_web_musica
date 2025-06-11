<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @yield('header')

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
    </div>
</body>

<!-- Footer -->
<footer class="bg-gray-900 text-white mt-10 py-6">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center text-sm">
        <div class="mb-4 md:mb-0 text-center md:text-left">
            <p>Desarrollado por <span class="font-semibold">José María Price Gutiérrez</span></p>
            <p>Email: <a href="mailto:pgj2025760@est.univalle.edu"
                    class="underline hover:text-green-400">pgj2025760@est.univalle.edu</a></p>
            <p>GitHub: <a href="https://github.com/PriceNotNull" class="underline hover:text-green-400"
                    target="_blank">PriceNotNull</a></p>
        </div>
        <div class="text-center md:text-right">
            <p>&copy; {{ date('Y') }} Todos los derechos reservados.</p>
        </div>
    </div>
</footer>


</html>