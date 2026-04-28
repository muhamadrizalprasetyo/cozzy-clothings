<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - Cozzy</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS (CDN for previewing without npm) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        cozzy: {
                            900: '#0f0f11', // Deep sleek dark
                            800: '#18181b', // Card dark
                            700: '#27272a', // Border dark
                            accent: '#ffffff', // Clean white accent
                        }
                    }
                }
            }
        }
    </script>
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-cozzy-900 text-gray-200 font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside class="w-64 bg-cozzy-800 border-r border-cozzy-700 hidden md:flex flex-col shadow-2xl z-20">
            <div class="h-16 flex items-center justify-center border-b border-cozzy-700">
                <h1 class="text-2xl font-bold tracking-widest text-cozzy-accent uppercase">Cozzy.</h1>
            </div>
            
            <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto custom-scrollbar">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-cozzy-accent text-cozzy-900' : 'text-gray-400 hover:text-cozzy-accent hover:bg-cozzy-700' }} font-medium transition-all duration-200">
                    <i class="ph ph-squares-four text-xl"></i>
                    Dashboard
                </a>
                <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('products.*') ? 'bg-cozzy-accent text-cozzy-900' : 'text-gray-400 hover:text-cozzy-accent hover:bg-cozzy-700' }} font-medium transition-all duration-200">
                    <i class="ph ph-t-shirt text-xl"></i>
                    Products
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.orders.*') ? 'bg-cozzy-accent text-cozzy-900' : 'text-gray-400 hover:text-cozzy-accent hover:bg-cozzy-700' }} font-medium transition-all duration-200">
                    <i class="ph ph-shopping-bag text-xl"></i>
                    Orders
                </a>
                <a href="{{ route('admin.comments.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.comments.*') ? 'bg-cozzy-accent text-cozzy-900' : 'text-gray-400 hover:text-cozzy-accent hover:bg-cozzy-700' }} font-medium transition-all duration-200">
                    <i class="ph ph-chat-circle-dots text-xl"></i>
                    Comments
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-cozzy-accent text-cozzy-900' : 'text-gray-400 hover:text-cozzy-accent hover:bg-cozzy-700' }} font-medium transition-all duration-200">
                    <i class="ph ph-gear text-xl"></i>
                    Settings
                </a>
            </nav>
            
            <div class="p-4 border-t border-cozzy-700">
                <div class="flex items-center gap-3 px-4 py-3">
                    <div class="w-10 h-10 rounded-full bg-cozzy-700 flex items-center justify-center border border-gray-600">
                        <i class="ph ph-user text-xl text-cozzy-accent"></i>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-cozzy-accent">Admin Rizal</p>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="text-xs text-gray-500 cursor-pointer hover:text-red-400 transition">Log out</button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden">
            <!-- Topbar -->
            <header class="h-16 bg-cozzy-800/80 backdrop-blur-md border-b border-cozzy-700 flex items-center justify-between px-8 z-10">
                <h2 class="text-xl font-semibold text-cozzy-accent">@yield('header', 'Overview')</h2>
                <div class="flex items-center gap-4">
                    <button class="text-gray-400 hover:text-cozzy-accent transition">
                        <i class="ph ph-bell text-2xl"></i>
                    </button>
                    <!-- Mobile Menu Button -->
                    <button class="md:hidden text-gray-400 hover:text-cozzy-accent transition">
                        <i class="ph ph-list text-2xl"></i>
                    </button>
                </div>
            </header>

            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto p-4 md:p-8 bg-cozzy-900 custom-scrollbar">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-500 rounded-xl text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-500 rounded-xl text-sm">
                        {{ session('error') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
        
    </div>
    <style>
        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #27272a;
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #3f3f46;
        }
    </style>
</body>
</html>
