<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-900">Checkout</h1>
            <p class="text-slate-500 text-sm mt-1">Complete your order details below</p>
        </div>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column - Form -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Shipping Information -->
                    <div class="bg-white rounded-xl border border-slate-200 p-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4 flex items-center gap-2">
                            <i class="ph ph-truck text-slate-500"></i>
                            Shipping Information
                        </h2>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">WhatsApp Number</label>
                                <input id="phone" name="phone" type="text" class="w-full border-slate-200 rounded-lg focus:ring-slate-500 focus:border-slate-500" value="{{ old('phone', $user->phone) }}" placeholder="08123456789" required>
                                <x-input-error :messages="$errors->get('phone')" class="mt-1" />
                            </div>

                            <div>
                                <label for="shipping_address" class="block text-sm font-medium text-slate-700 mb-1.5">Shipping Address</label>
                                <textarea id="shipping_address" name="shipping_address" rows="3" class="w-full border-slate-200 rounded-lg focus:ring-slate-500 focus:border-slate-500 resize-none" placeholder="Full address including street, city, and postal code..." required>{{ old('shipping_address', $user->address) }}</textarea>
                                <x-input-error :messages="$errors->get('shipping_address')" class="mt-1" />
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="bg-white rounded-xl border border-slate-200 p-6">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Order Items</h2>
                        <div class="space-y-4">
                            @foreach($cartItems as $item)
                                <div class="flex gap-4 py-3 border-b border-slate-100 last:border-0">
                                    <div class="w-16 h-16 rounded-lg bg-slate-100 overflow-hidden flex-shrink-0">
                                        @if($item->product->image && file_exists(public_path($item->product->image)))
                                            <img src="{{ asset($item->product->image) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <i class="ph ph-t-shirt text-slate-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="font-medium text-slate-900 text-sm">{{ $item->product->name }}</h4>
                                        <p class="text-slate-500 text-sm">Qty: {{ $item->quantity }}</p>
                                        <p class="font-semibold text-slate-900 text-sm">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Column - Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl border border-slate-200 p-6 sticky top-24">
                        <h2 class="text-lg font-semibold text-slate-900 mb-4">Order Summary</h2>
                        
                        <!-- Cozzy Cash Balance -->
                        <div class="bg-emerald-50 rounded-lg p-3 mb-4 flex items-center gap-3">
                            <i class="ph ph-coins text-emerald-600 text-xl"></i>
                            <div>
                                <p class="text-xs text-emerald-600 font-medium">Your Balance</p>
                                <p class="font-semibold text-slate-900">Rp {{ number_format($user->balance, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="space-y-2 mb-4 pb-4 border-b border-slate-100">
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

                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-3 px-4 rounded-lg transition-colors flex items-center justify-center gap-2">
                            <i class="ph ph-coins text-lg"></i>
                            Pay with Cozzy Cash
                        </button>
                        
                        @if($user->balance < $total)
                            <p class="text-center text-xs text-red-600 mt-3">
                                Insufficient balance. Please top up your Cozzy Cash.
                            </p>
                        @else
                            <p class="text-center text-xs text-slate-400 mt-3">
                                Balance will be deducted automatically
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </main>
</x-app-layout>
