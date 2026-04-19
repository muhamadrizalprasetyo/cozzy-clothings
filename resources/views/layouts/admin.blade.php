<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cozzy.co | Admin</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            navy: '#0a1128',
                            navylight: '#1c2e5a',
                            blue: '#2563eb',
                            accent: '#3b82f6',
                            bg: '#f8fafc',
                        }
                    }
                }
            }
        }
    </script>
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-brand-bg text-gray-800 font-sans antialiased overflow-hidden selection:bg-brand-blue selection:text-white">

    <div class="flex h-screen w-full relative">
        
        <!-- Sidebar - Deep Gradient & Interactive -->
        <aside class="w-72 bg-gradient-to-b from-brand-navy to-brand-navylight hidden md:flex flex-col z-20 shadow-2xl relative overflow-hidden group/sidebar">
            <div class="absolute top-0 right-0 w-64 h-64 bg-brand-blue rounded-full blur-3xl opacity-10 -translate-y-1/2 translate-x-1/2"></div>
            
            <div class="h-20 flex flex-col justify-center px-8 border-b border-white/5 relative z-10 transition-transform duration-300">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-brand-blue to-cyan-400 flex items-center justify-center shadow-lg shadow-brand-blue/30">
                        <span class="text-white font-bold text-xs">C.</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight text-white">Cozzy.co</h1>
                        <p class="text-[10px] text-gray-400 font-medium">Professional Admin</p>
                    </div>
                </div>
            </div>
            
            <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto custom-scrollbar relative z-10">
                <p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-4">Operations</p>
                
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white shadow-[inset_0_1px_0_rgba(255,255,255,0.1)] border border-white/5 backdrop-blur-md' : 'text-gray-400 hover:text-white hover:bg-white/5' }} font-medium transition-all duration-300 group relative overflow-hidden">
                    @if(request()->routeIs('dashboard'))
                        <i class="ph ph-squares-four text-xl text-cyan-400 group-hover:scale-110 transition-transform duration-300"></i>
                        <span>Dashboard</span>
                        <span class="ml-auto w-1.5 h-1.5 rounded-full bg-cyan-400 shadow-[0_0_8px_rgba(34,211,238,0.8)]"></span>
                    @else
                        <div class="absolute inset-0 w-1 bg-brand-blue left-0 rounded-r-full -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                        <i class="ph ph-squares-four text-xl group-hover:text-brand-blue transition-colors"></i>
                        <span>Dashboard</span>
                    @endif
                </a>
                
                <a href="{{ route('products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('products.index') ? 'bg-white/10 text-white shadow-[inset_0_1px_0_rgba(255,255,255,0.1)] border border-white/5 backdrop-blur-md' : 'text-gray-400 hover:text-white hover:bg-white/5' }} font-medium transition-all duration-300 group relative overflow-hidden">
                    @if(request()->routeIs('products.index'))
                        <i class="ph ph-t-shirt text-xl text-cyan-400 group-hover:scale-110 transition-transform duration-300"></i>
                        <span>Products</span>
                        <span class="ml-auto w-1.5 h-1.5 rounded-full bg-cyan-400 shadow-[0_0_8px_rgba(34,211,238,0.8)]"></span>
                    @else
                        <div class="absolute inset-0 w-1 bg-brand-blue left-0 rounded-r-full -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                        <i class="ph ph-t-shirt text-xl group-hover:text-brand-blue transition-colors"></i>
                        <span>Products</span>
                    @endif
                </a>
                
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 font-medium transition-all duration-300 group relative overflow-hidden">
                    <div class="absolute inset-0 w-1 bg-brand-blue left-0 rounded-r-full -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                    <i class="ph ph-shopping-bag text-xl group-hover:text-brand-blue transition-colors"></i>
                    <span>Orders</span>
                    <span class="ml-auto bg-brand-blue/20 text-brand-accent text-[10px] px-2 py-0.5 rounded-full font-bold group-hover:bg-brand-blue group-hover:text-white transition-colors">15</span>
                </a>
                
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 font-medium transition-all duration-300 group relative overflow-hidden">
                    <div class="absolute inset-0 w-1 bg-brand-blue left-0 rounded-r-full -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                    <i class="ph ph-chat-text text-xl group-hover:text-brand-blue transition-colors"></i>
                    <span>Feedback</span>
                </a>
                
                <p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-4 mt-8 pt-4 border-t border-white/5">System</p>

                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-white/5 font-medium transition-all duration-300 group relative overflow-hidden">
                    <div class="absolute inset-0 w-1 bg-brand-blue left-0 rounded-r-full -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                    <i class="ph ph-gear text-xl group-hover:rotate-90 transition-transform duration-500"></i>
                    <span>Settings</span>
                </a>
            </nav>
            
            <div class="p-5 border-t border-white/5 bg-black/10 relative z-10 backdrop-blur-sm">
                <div class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 cursor-pointer transition-colors border border-transparent hover:border-white/5 group">
                    <div class="w-10 h-10 rounded-full bg-cover bg-center border border-white/20 shadow-md transform group-hover:scale-105 transition-transform" style="background-image: url('https://ui-avatars.com/api/?name=Admin&background=random&color=fff');"></div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold text-white group-hover:text-cyan-300 transition-colors">Admin Rizal</p>
                        <p class="text-xs text-gray-400 font-medium">rizal@cozzy.co</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content (Glassmorphic Header + Interactive body) -->
        <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
            <div class="absolute top-0 right-10 w-[500px] h-[500px] bg-brand-blue rounded-full blur-[120px] opacity-[0.03] -z-10 pointer-events-none"></div>

            <!-- Topbar (Glassmorphic) -->
            <header class="h-20 bg-white/70 backdrop-blur-md flex items-center justify-between px-10 z-10 border-b border-gray-200/60 sticky top-0">
                <div>
                    <h2 class="text-xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-brand-navy to-gray-500 tracking-tight">@yield('header', 'Overview')</h2>
                    <p class="text-xs font-medium text-gray-400 mt-0.5">Welcome back, let's manage your store today.</p>
                </div>
                <div class="flex items-center gap-5">
                    <div class="relative group cursor-pointer w-10 h-10 bg-white rounded-full flex items-center justify-center border border-gray-200 shadow-sm hover:shadow-md hover:border-brand-blue transition-all duration-300">
                        <i class="ph ph-magnifying-glass text-lg text-gray-500 group-hover:text-brand-blue transition-colors"></i>
                    </div>
                    <div class="relative group cursor-pointer w-10 h-10 bg-white rounded-full flex items-center justify-center border border-gray-200 shadow-sm hover:shadow-md hover:border-brand-blue transition-all duration-300">
                        <i class="ph ph-bell text-lg text-gray-500 group-hover:text-brand-blue transition-colors"></i>
                        <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 border-2 border-white rounded-full animate-pulse"></span>
                    </div>
                    <button class="md:hidden w-10 h-10 bg-white rounded-full flex items-center justify-center border border-gray-200 shadow-sm hover:shadow-md transition-all">
                        <i class="ph ph-list text-lg text-gray-500"></i>
                    </button>
                </div>
            </header>

            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto p-6 md:p-10 custom-scrollbar relative z-0">
                <div class="max-w-[1400px] mx-auto">
                    @yield('content')
                </div>
            </div>
        </main>
        
    </div>
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</body>
</html>
