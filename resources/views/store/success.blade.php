<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success - Cozzy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <style>
        body { font-family: 'Outfit', sans-serif; background-color: #fafafa; }
    </style>
</head>
<body class="antialiased text-gray-800 flex items-center justify-center min-h-screen">

    <div class="max-w-md w-full bg-white p-8 rounded-[2rem] shadow-xl text-center border border-gray-100">
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 text-green-500">
            <i class="ph-fill ph-check-circle text-5xl"></i>
        </div>
        
        <h2 class="text-3xl font-black text-gray-900 mb-2">Pesanan Berhasil!</h2>
        <p class="text-sm text-gray-500 mb-8">Terima kasih, <span class="font-bold text-gray-800">{{ $order->user->name ?? $order->guest_name }}</span>! Pesanan Anda telah berhasil dibuat.</p>
        
        <div class="bg-gray-50 rounded-2xl p-6 text-left mb-8 border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xs font-bold text-gray-400 uppercase">Detail Pesanan</span>
                <span class="text-xs font-black text-blue-600 bg-blue-50 px-2 py-1 rounded">#{{ $order->order_number }}</span>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Total Pembayaran</span>
                    <span class="text-sm font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Alamat Pengiriman</span>
                    <span class="text-sm font-bold text-gray-900 text-right w-1/2 line-clamp-2">{{ $order->shipping_address ?? $order->guest_address }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-sm text-gray-600">Status</span>
                    <span class="text-sm font-bold text-orange-600">{{ $order->status }}</span>
                </div>
            </div>
        </div>
        
        <a href="{{ route('orders.index') }}" class="inline-block w-full bg-gray-900 hover:bg-black text-white font-bold py-4 rounded-xl transition-all shadow-lg hover:shadow-xl hover:shadow-gray-900/20 mb-3">
            Lihat Pesanan Saya
        </a>
        <a href="{{ route('katalog') }}" class="inline-block w-full text-gray-500 font-bold py-2 text-sm hover:text-gray-900 transition-colors">
            Kembali ke Katalog
        </a>
    </div>

</body>
</html>
