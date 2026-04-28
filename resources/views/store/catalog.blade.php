<x-app-layout>
    <!-- Success Message -->
    @if(session('success'))
        <div class="fixed top-24 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md px-4">
            <div class="bg-emerald-500 text-white px-6 py-4 rounded-xl font-medium flex items-center gap-3 shadow-xl shadow-emerald-100">
                <i class="ph-bold ph-check-circle text-xl"></i>
                <span class="text-sm">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-24 left-1/2 transform -translate-x-1/2 z-50 w-full max-w-md px-4">
            <div class="bg-red-500 text-white px-6 py-4 rounded-xl font-medium flex items-center gap-3 shadow-xl shadow-red-100">
                <i class="ph-bold ph-warning-circle text-xl"></i>
                <span class="text-sm">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Hero Section - Premium Minimalist -->
    <section class="bg-slate-50 border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <div class="text-center max-w-2xl mx-auto">
                <p class="text-slate-500 text-sm uppercase tracking-[0.2em] mb-4 font-medium">Premium Clothing Distro</p>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 mb-6 tracking-tight">COZZY</h1>
                <p class="text-slate-600 text-lg leading-relaxed">Elevate your style with our curated collection of premium streetwear. Quality meets comfort.</p>
            </div>
        </div>
    </section>

    <!-- Catalog Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-8 pb-4 border-b border-slate-100">
            <div>
                <h2 class="text-xl font-bold text-slate-900">All Products</h2>
                <p class="text-slate-500 text-sm mt-1">{{ $products->count() }} items available</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-slate-400 text-sm">Sort by:</span>
                <select class="text-sm border-slate-200 rounded-lg text-slate-700 focus:ring-slate-500 focus:border-slate-500">
                    <option>Featured</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                    <option>Newest</option>
                </select>
            </div>
        </div>

        <!-- Product Grid - Premium Cards -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
            @foreach($products as $item)
            <div class="group bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-slate-100 overflow-hidden">
                <!-- Image Container -->
                <a href="{{ route('product.detail', $item->slug) }}" class="block relative">
                    <div class="relative bg-slate-100 aspect-[3/4] overflow-hidden">
                        @if($item->image && file_exists(public_path($item->image)))
                            <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center bg-slate-200">
                                <i class="ph ph-t-shirt text-4xl text-slate-400"></i>
                            </div>
                        @endif
                        
                        <!-- Stock Badge -->
                        @if($item->stock == 0)
                            <div class="absolute inset-0 bg-black/60 flex items-center justify-center">
                                <span class="text-white text-sm font-semibold uppercase tracking-wider">Sold Out</span>
                            </div>
                        @elseif($item->stock <= 5)
                            <div class="absolute top-3 left-3">
                                <span class="bg-amber-500 text-white text-[10px] font-bold uppercase tracking-wider px-2 py-1 rounded">Low Stock</span>
                            </div>
                        @endif
                    </div>
                </a>
                
                <!-- Product Info -->
                <div class="p-4">
                    <a href="{{ route('product.detail', $item->slug) }}" class="block">
                        <h3 class="text-sm font-semibold text-slate-900 mb-1 line-clamp-2 leading-tight group-hover:text-slate-700 transition-colors">{{ $item->name }}</h3>
                    </a>
                    <p class="text-lg font-bold text-slate-900 mb-3">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                    
                    <!-- Add to Cart Button -->
                    @auth
                        @if($item->stock > 0)
                            <form action="{{ route('cart.store') }}" method="POST" class="w-full">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white text-sm font-medium py-2.5 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                                    <i class="ph ph-shopping-cart text-lg"></i>
                                    Add to Cart
                                </button>
                            </form>
                        @else
                            <button disabled class="w-full bg-slate-200 text-slate-400 text-sm font-medium py-2.5 px-4 rounded-lg cursor-not-allowed">
                                Out of Stock
                            </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block w-full bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium py-2.5 px-4 rounded-lg transition-colors text-center">
                            Login to Buy
                        </a>
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
