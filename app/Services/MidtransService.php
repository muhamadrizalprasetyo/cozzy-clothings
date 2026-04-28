<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Order;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createSnapToken(Order $order): ?string
    {
        // Demo mode: if no server key configured, skip Midtrans
        if (empty(config('midtrans.server_key')) || config('midtrans.server_key') === 'your_midtrans_server_key_here') {
            return 'DEMO_MODE';
        }

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int)$order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->user->name ?? $order->guest_name,
                'email' => $order->user->email ?? $order->guest_email,
                'phone' => $order->user->phone ?? $order->guest_phone,
            ],
            'item_details' => $order->orderItems->map(fn($item) => [
        'id' => $item->product_id,
        'price' => (int)$item->price,
        'quantity' => $item->quantity,
        'name' => substr($item->product->name, 0, 50),
        ])->toArray(),
        ];

        return Snap::getSnapToken($params);
    }
}
