<nav x-data="{ open: false }" class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo - COZZY Text -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('katalog') }}" class="text-2xl font-bold text-slate-900 tracking-tight">
                        COZZY
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:ml-8 sm:flex">
                    <a href="{{ route('katalog') }}" class="px-3 py-2 text-sm font-medium {{ request()->routeIs('katalog') ? 'text-slate-900' : 'text-slate-500 hover:text-slate-700' }}">
                        Shop
                    </a>
                    <a href="{{ route('about') }}" class="px-3 py-2 text-sm font-medium {{ request()->routeIs('about') ? 'text-slate-900' : 'text-slate-500 hover:text-slate-700' }}">
                        About
                    </a>
                    @auth
                        <a href="{{ route('orders.index') }}" class="px-3 py-2 text-sm font-medium {{ request()->routeIs('orders.index') ? 'text-slate-900' : 'text-slate-500 hover:text-slate-700' }}">
                            Orders
                        </a>
                    @endauth
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-3">
                @auth
                    <!-- Cozzy Cash Balance - Premium Badge -->
                    <div class="hidden md:flex items-center gap-2 bg-emerald-50 px-3 py-1.5 rounded-lg border border-emerald-100">
                        <i class="ph ph-coins text-emerald-600"></i>
                        <span class="text-xs text-emerald-700 font-medium">Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</span>
                    </div>

                    <!-- Cart Link -->
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-slate-500 hover:text-slate-700 transition-colors">
                        <i class="ph ph-shopping-cart text-xl"></i>
                        @livewire('cart-badge')
                    </a>

                    <!-- User Dropdown -->
                    <div class="ml-2 relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-2 p-2 text-slate-500 hover:text-slate-700 transition-colors">
                                    <i class="ph ph-user text-xl"></i>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <div class="px-4 py-2 border-b border-slate-100">
                                    <p class="text-sm font-medium text-slate-900">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-slate-500">Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</p>
                                </div>
                                
                                @if(Auth::user()->is_admin)
                                    <x-dropdown-link :href="route('admin.dashboard')">
                                        Admin
                                    </x-dropdown-link>
                                @endif
                                
                                <x-dropdown-link :href="route('profile.edit')">
                                    Profile
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        Logout
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900 px-3 py-2">Sign In</a>
                    <a href="{{ route('register') }}" class="bg-slate-900 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-slate-800 transition-colors">Create Account</a>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none transition-colors">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-slate-100">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('katalog') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('katalog') ? 'border-slate-900 text-slate-900 bg-slate-50' : 'border-transparent text-slate-600 hover:text-slate-800 hover:bg-slate-50' }} text-base font-medium">
                Shop
            </a>
            <a href="{{ route('about') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('about') ? 'border-slate-900 text-slate-900 bg-slate-50' : 'border-transparent text-slate-600 hover:text-slate-800 hover:bg-slate-50' }} text-base font-medium">
                About
            </a>
            @auth
                <a href="{{ route('orders.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('orders.index') ? 'border-slate-900 text-slate-900 bg-slate-50' : 'border-transparent text-slate-600 hover:text-slate-800 hover:bg-slate-50' }} text-base font-medium">
                    Orders
                </a>
                <a href="{{ route('cart.index') }}" class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('cart.index') ? 'border-slate-900 text-slate-900 bg-slate-50' : 'border-transparent text-slate-600 hover:text-slate-800 hover:bg-slate-50' }} text-base font-medium">
                    Cart
                </a>
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-4 border-t border-slate-200">
            @auth
                <div class="px-4 flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center">
                        <i class="ph ph-user text-xl"></i>
                    </div>
                    <div>
                        <div class="font-medium text-slate-900">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-emerald-600 font-medium">Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</div>
                    </div>
                </div>

                <div class="space-y-1">
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-slate-600 hover:text-slate-800 hover:bg-slate-50 text-base font-medium">
                            Admin
                        </a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-slate-600 hover:text-slate-800 hover:bg-slate-50 text-base font-medium">
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left pl-3 pr-4 py-2 border-l-4 border-transparent text-slate-600 hover:text-slate-800 hover:bg-slate-50 text-base font-medium">
                            Logout
                        </button>
                    </form>
                </div>
            @else
                <div class="px-4 py-2 space-y-2">
                    <a href="{{ route('login') }}" class="block text-center w-full py-2.5 font-medium text-slate-600 border border-slate-200 rounded-lg hover:bg-slate-50">Sign In</a>
                    <a href="{{ route('register') }}" class="block text-center w-full py-2.5 font-medium bg-slate-900 text-white rounded-lg hover:bg-slate-800">Create Account</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
<!-- Include Icons -->
<script src="https://unpkg.com/@phosphor-icons/web"></script>
