<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <!-- Page Content -->
            <main>
            <header class="bg-white shadow py-4">
                <div class="container mx-auto px-4 flex justify-between items-center">
                    <a href ="{{route('home')}}" class="text-2xl font-bold text-gray-800">Loja Online</h1>
                    <a href="{{ route('carrinho') }}"
                       class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                        Ir para o Carrinho
                    </a>
                </div>
            </header>
            <main>
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
    </body>
</html>
