<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Pesanan #') }}{{ $order->order_number }}
            </h2>
            <a href="{{ route('orders.index') }}" class="text-sm text-gray-600 hover:text-gray-900 flex items-center">
                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Main Order Info -->
                <div class="md:col-span-2 space-y-6">
                    <!-- Items -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4">Produk yang Dibeli</h3>
                        <div class="divide-y divide-gray-100">
                            @foreach($order->orderItems as $item)
                                <div class="py-4 flex items-center justify-between">
                                    <div class="flex items-center">
                                        @if($item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}" class="h-16 w-16 rounded object-cover mr-4">
                                        @endif
                                        <div>
                                            <div class="font-bold text-gray-900">{{ $item->product->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                    <div class="font-bold">
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-6 pt-6 border-t flex justify-between items-center">
                            <span class="text-lg text-gray-600 font-semibold">Total Pesanan</span>
                            <span class="text-2xl font-bold text-indigo-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-6">Status Pesanan (Timeline)</h3>
                        <div class="relative">
                            <!-- Vertical Line -->
                            <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-100"></div>
                            
                            <div class="space-y-8">
                                @forelse($order->histories as $history)
                                    <div class="relative flex items-start ml-10">
                                        <div class="absolute -left-10 mt-1 h-8 w-8 rounded-full border-4 border-white bg-indigo-600 flex items-center justify-center shadow-sm">
                                            <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-gray-900">{{ $history->status }}</div>
                                            <div class="text-xs text-gray-500 mb-1">{{ $history->created_at->format('d M Y, H:i') }}</div>
                                            <div class="text-sm text-gray-600 bg-gray-50 rounded p-2">{{ $history->description }}</div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-500 italic pl-10">Belum ada riwayat status.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Metadata -->
                <div class="md:col-span-1 space-y-6">
                    <!-- Delivery Info -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4">Informasi Pengiriman</h3>
                        <div class="space-y-3 text-sm">
                            <div>
                                <div class="text-gray-500 uppercase text-xs font-bold">Status</div>
                                <div class="font-bold text-indigo-600 text-lg">{{ $order->status }}</div>
                            </div>
                            <div>
                                <div class="text-gray-500 uppercase text-xs font-bold">Nomor Resi / Kurir</div>
                                @if($order->tracking_number)
                                    <div class="font-bold">{{ $order->courier }} - {{ $order->tracking_number }}</div>
                                @else
                                    <div class="text-gray-400 italic">Belum dikirim</div>
                                @endif
                            </div>
                            <div>
                                <div class="text-gray-500 uppercase text-xs font-bold">Alamat Pengiriman</div>
                                <div class="text-gray-900 font-medium whitespace-pre-wrap">{{ $order->shipping_address }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3 class="text-lg font-bold mb-4">Informasi Pembayaran</h3>
                        <div class="space-y-3 text-sm">
                            <div>
                                <div class="text-gray-500 uppercase text-xs font-bold">Metode Pembayaran</div>
                                <div class="font-bold">Digital Payment (Midtrans)</div>
                            </div>
                            <div>
                                <div class="text-gray-500 uppercase text-xs font-bold">Waktu Bayar</div>
                                <div class="font-bold">{{ $order->paid_at ? $order->paid_at->format('d M Y, H:i') : '-' }}</div>
                            </div>
                            @if($order->status === 'Pending' && $order->snap_token)
                                <div class="pt-4">
                                    <a href="{{ route('checkout.index') }}" class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700">
                                        Bayar Sekarang
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
