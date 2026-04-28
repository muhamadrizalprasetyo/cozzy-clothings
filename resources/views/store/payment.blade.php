<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12">
                <div class="mb-8">
                    <svg class="mx-auto h-16 w-16 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                    <h2 class="mt-4 text-3xl font-extrabold text-gray-900 leading-tight">Satu Langkah Lagi!</h2>
                    <p class="mt-2 text-gray-600">Klik tombol di bawah untuk menyelesaikan pembayaran via Midtrans.</p>
                </div>

                <div class="space-y-4">
                    <div class="text-2xl font-bold text-gray-900">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                    <div class="text-sm text-gray-500 italic">No. Pesanan: {{ $order->order_number }}</div>

                    <div class="mt-8">
                        <button id="pay-button" class="inline-flex items-center px-12 py-4 bg-indigo-600 border border-transparent rounded-md font-bold text-lg text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 transition ease-in-out duration-150 shadow-lg">
                            Bayar Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap Script -->
    @if(config('midtrans.is_production'))
        <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    @else
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    @endif

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result){
                    window.location.href = "{{ route('orders.index') }}";
                },
                onPending: function(result){
                    window.location.href = "{{ route('orders.index') }}";
                },
                onError: function(result){
                    alert("Pembayaran gagal!");
                }
            });
        };
    </script>
</x-app-layout>
