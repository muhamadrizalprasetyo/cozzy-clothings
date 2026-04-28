<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <!-- Breadcrumb -->
        <nav class="mb-8">
            <a href="{{ route('katalog') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-slate-900 transition-colors">
                <i class="ph ph-arrow-left"></i>
                Back to Shop
            </a>
        </nav>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg flex items-center gap-2">
                <i class="ph-bold ph-check-circle"></i>
                <span class="text-sm">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-center gap-2">
                <i class="ph-bold ph-warning-circle"></i>
                <span class="text-sm">{{ session('error') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <!-- Product Image -->
            <div class="bg-slate-100 rounded-xl aspect-[3/4] relative overflow-hidden">
                @if($product->image && file_exists(public_path($product->image)))
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="object-cover w-full h-full">
                @else
                    <div class="absolute inset-0 flex items-center justify-center bg-slate-200">
                        <i class="ph ph-t-shirt text-6xl text-slate-400"></i>
                    </div>
                @endif
                
                @if($product->stock == 0)
                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                        <span class="text-white text-lg font-semibold uppercase tracking-wider">Sold Out</span>
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <div class="flex flex-col">
                <div class="mb-6">
                    <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-4 leading-tight">{{ $product->name }}</h1>
                    <p class="text-3xl font-bold text-slate-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <div class="prose prose-slate mb-8">
                    <p class="text-slate-600 leading-relaxed">{{ $product->description }}</p>
                </div>

                <!-- Stock Info -->
                <div class="flex items-center gap-4 mb-6 text-sm">
                    <div class="flex items-center gap-2">
                        <i class="ph ph-package text-slate-400"></i>
                        <span class="text-slate-600">Stock: <span class="font-medium text-slate-900">{{ $product->stock }}</span></span>
                    </div>
                    @if($product->stock > 0 && $product->stock <= 5)
                        <span class="text-amber-600 font-medium">Low Stock</span>
                    @endif
                </div>
                
                @auth
                    <form action="{{ route('cart.store') }}" method="POST" class="mt-auto">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="flex flex-col sm:flex-row gap-4 mb-4">
                            <div class="flex items-center border border-slate-200 rounded-lg overflow-hidden w-32">
                                <button type="button" onclick="this.parentNode.querySelector('input').stepDown()" class="px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600">
                                    <i class="ph ph-minus"></i>
                                </button>
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full text-center border-none py-2 text-slate-900 font-medium focus:ring-0" required>
                                <button type="button" onclick="this.parentNode.querySelector('input').stepUp()" class="px-3 py-2 bg-slate-50 hover:bg-slate-100 text-slate-600">
                                    <i class="ph ph-plus"></i>
                                </button>
                            </div>
                            
                            <button type="submit" class="flex-1 bg-slate-900 hover:bg-slate-800 text-white font-medium py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2 {{ $product->stock == 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                <i class="ph ph-shopping-cart text-lg"></i>
                                {{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                            </button>
                        </div>
                    </form>
                @else
                    <div class="mt-auto bg-slate-50 rounded-lg p-6 text-center">
                        <p class="text-slate-600 mb-4">Sign in to add this item to your cart</p>
                        <div class="flex gap-3">
                            <a href="{{ route('login') }}" class="flex-1 bg-white border border-slate-200 text-slate-700 font-medium py-2.5 px-4 rounded-lg hover:bg-slate-50 transition-colors">Sign In</a>
                            <a href="{{ route('register') }}" class="flex-1 bg-slate-900 text-white font-medium py-2.5 px-4 rounded-lg hover:bg-slate-800 transition-colors">Create Account</a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
        
        <!-- Reviews Section -->
        <div class="mt-16 pt-8 border-t border-slate-100">
            <h2 class="text-xl font-bold text-slate-900 mb-8">Customer Reviews</h2>
            @livewire('product-comments', ['product' => $product])
        </div>
    </main>
</x-app-layout>
