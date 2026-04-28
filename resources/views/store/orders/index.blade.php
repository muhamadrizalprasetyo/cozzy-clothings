<x-app-layout>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">My Orders</h1>
                <p class="text-slate-500 text-sm mt-1">Track and manage your orders</p>
            </div>
            <a href="{{ route('katalog') }}" class="text-sm text-slate-600 hover:text-slate-900 font-medium">
                Continue Shopping
            </a>
        </div>

        @if($orders->isEmpty())
            <div class="bg-white rounded-xl border border-slate-200 p-12 text-center">
                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="ph ph-shopping-bag text-2xl text-slate-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">No orders yet</h3>
                <p class="text-slate-500 text-sm mb-4">Start shopping to see your orders here.</p>
                <a href="{{ route('katalog') }}" class="inline-flex items-center gap-2 bg-slate-900 text-white font-medium py-2.5 px-5 rounded-lg hover:bg-slate-800 transition-colors">
                    Browse Products
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach($orders as $order)
                <div class="bg-white rounded-xl border border-slate-200 p-6">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <!-- Order Info -->
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0">
                                <i class="ph ph-package text-slate-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-slate-900">#{{ $order->order_number }}</h4>
                                <p class="text-sm text-slate-500">{{ $order->created_at->format('d M Y') }}</p>
                            </div>
                        </div>

                        <!-- Status & Payment -->
                        <div class="flex flex-wrap items-center gap-4">
                            @php
                                $statusClasses = match($order->status) {
                                    'Paid' => 'bg-emerald-100 text-emerald-700',
                                    'Shipped' => 'bg-blue-100 text-blue-700',
                                    'Completed' => 'bg-slate-100 text-slate-700',
                                    'Cancelled' => 'bg-red-100 text-red-700',
                                    default => 'bg-amber-100 text-amber-700'
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $statusClasses }}">
                                {{ $order->status }}
                            </span>
                            
                            @if($order->payment_method === 'cozzy_cash' && $order->payment_status === 'paid')
                                <span class="flex items-center gap-1 text-xs text-emerald-600 font-medium">
                                    <i class="ph ph-coins"></i>
                                    Cozzy Cash
                                </span>
                            @endif
                        </div>

                        <!-- Amount -->
                        <div class="text-left md:text-right">
                            <p class="text-sm text-slate-500">Total</p>
                            <p class="font-bold text-slate-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-2">
                            <a href="{{ route('orders.show', $order->id) }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-medium rounded-lg transition-colors">
                                View
                            </a>
                            @if(in_array($order->status, ['Paid', 'Shipped', 'Completed']))
                                <a href="{{ route('invoice.download', $order->id) }}" class="px-4 py-2 border border-slate-200 hover:bg-slate-50 text-slate-700 text-sm font-medium rounded-lg transition-colors">
                                    Invoice
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @endif
    </main>
</x-app-layout>
