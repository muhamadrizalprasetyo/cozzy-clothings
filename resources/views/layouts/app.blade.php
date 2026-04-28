<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'COZZY') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
        <script src="https://unpkg.com/@phosphor-icons/web"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <style>
            body { 
                font-family: 'Plus Jakarta Sans', sans-serif; 
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }
            .animate-fade-in {
                animation: fadeIn 0.5s ease-out forwards;
            }
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
        </style>
    </head>
    <body class="antialiased text-gray-900 bg-[#fafafa]">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @if(session('success'))
                    <div class="max-w-7xl mx-auto px-6 mt-6">
                        <div class="bg-green-500 text-white px-6 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg shadow-green-100">
                            <i class="ph-bold ph-check-circle text-2xl"></i>
                            {{ session('success') }}
                        </div>
                    </div>
                @endif
                @if(session('error'))
                    <div class="max-w-7xl mx-auto px-6 mt-6">
                        <div class="bg-red-500 text-white px-6 py-4 rounded-2xl font-bold flex items-center gap-3 shadow-lg shadow-red-100">
                            <i class="ph-bold ph-warning-circle text-2xl"></i>
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
    </body>
</html>
