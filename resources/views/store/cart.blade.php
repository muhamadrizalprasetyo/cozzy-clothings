<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-slate-900">Shopping Cart</h1>
            <a href="{{ route('katalog') }}" class="text-sm text-slate-500 hover:text-slate-900 transition-colors flex items-center gap-1">
                <i class="ph ph-arrow-left"></i>
                Continue Shopping
            </a>
        </div>

        @if($cartItems->isEmpty())
            <div class="bg-white rounded-xl border border-slate-200 p-12 text-center">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ph ph-shopping-cart text-3xl text-slate-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">Your cart is empty</h3>
                <p class="text-slate-500 text-sm mb-6">Looks like you haven't added anything yet.</p>
                <a href="{{ route('katalog') }}" class="inline-flex items-center gap-2 bg-slate-900 text-white font-medium py-2.5 px-6 rounded-lg hover:bg-slate-800 transition-colors">
                    Start Shopping
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cartItems as $item)
                    <div class="bg-white rounded-xl border border-slate-200 p-4 flex gap-4">
                        <!-- Product Image -->
                        <div class="w-24 h-24 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                            @if($item->product->image && file_exists(public_path($item->product->image)))
                                <img src="{{ asset($item->product->image) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="ph ph-t-shirt text-2xl text-slate-400"></i>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Product Info -->
                        <div class="flex-1 flex flex-col justify-between">
                            <div>
                                <h4 class="font-medium text-slate-900">{{ $item->product->name }}</h4>
                                <p class="text-slate-600 font-medium">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <!-- Quantity Update -->
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <div class="flex items-center border border-slate-200 rounded-lg overflow-hidden">
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-12 text-center border-none py-1.5 text-sm focus:ring-0">
                                        <button type="submit" class="px-2 py-1.5 bg-slate-50 hover:bg-slate-100 text-slate-600 text-xs border-l border-slate-200">
                                            Update
                                        </button>
                                    </div>
                                </form>
                                
                                <!-- Subtotal -->
                                <p class="font-semibold text-slate-900">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        
                        <!-- Remove Button -->
                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="self-start">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors" onclick="return confirm('Remove this item?')">
                                <i class="ph ph-trash text-lg"></i>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl border border-slate-200 p-6 sticky top-24">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Order Summary</h3>
                        
                        <div class="space-y-3 mb-4 pb-4 border-b border-slate-100">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-600">Subtotal</span>
                                <span class="text-slate-900 font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-600">Shipping</span>
                                <span class="text-emerald-600 font-medium">Free</span>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center mb-6">
                            <span class="font-semibold text-slate-900">Total</span>
                            <span class="text-xl font-bold text-slate-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="block w-full bg-slate-900 hover:bg-slate-800 text-white font-medium py-3 px-4 rounded-lg text-center transition-colors">
                            Proceed to Checkout
                        </a>
                        
                        <p class="text-center text-xs text-slate-400 mt-4">
                            Cozzy Cash will be used for payment
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </main>
</x-app-layout>
