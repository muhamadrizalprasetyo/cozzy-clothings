<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $order->order_number }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; line-height: 1.6; color: #333; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; }
        .header { display: flex; justify-content: space-between; border-bottom: 2px solid #eee; padding-bottom: 20px; }
        .company-info h1 { margin: 0; color: #000; font-size: 28px; }
        .invoice-details { text-align: right; }
        .section { margin-top: 30px; }
        .section-title { font-weight: bold; border-bottom: 1px solid #eee; margin-bottom: 10px; padding-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background: #f9f9f9; text-align: left; padding: 10px; border-bottom: 2px solid #eee; }
        td { padding: 10px; border-bottom: 1px solid #eee; }
        .total-section { margin-top: 30px; text-align: right; }
        .total-section table { width: auto; margin-left: auto; }
        .total-section td { border: none; padding: 5px 10px; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #999; }
        .badge { padding: 5px 10px; border-radius: 5px; font-weight: bold; background: #eee; }
        .badge-success { background: #d4edda; color: #155724; }
    </style>
</head>
<body>
    <div class="invoice-box">
        <table style="border:none;">
            <tr>
                <td style="border:none; width: 50%;">
                    <h1>COZZY.CO</h1>
                    <p>
                        Street Wear Marketplace<br>
                        Jakarta, Indonesia<br>
                        WA: 0812-3456-789
                    </p>
                </td>
                <td style="border:none; text-align: right;">
                    <h2 style="margin-bottom: 5px;">INVOICE</h2>
                    <p>
                        #{{ $order->order_number }}<br>
                        Date: {{ $order->created_at->format('d M Y') }}<br>
                        Status: <span class="badge badge-success">{{ strtoupper($order->status) }}</span>
                    </p>
                </td>
            </tr>
        </table>

        <div class="section">
            <div class="section-title">BILLING & SHIPPING</div>
            <p>
                <strong>{{ $order->user->name ?? $order->guest_name }}</strong><br>
                {{ $order->user->email ?? $order->guest_email }}<br>
                {{ $order->user->phone ?? $order->guest_phone }}<br>
                {{ $order->shipping_address ?? $order->guest_address }}
            </p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Item Description</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td style="text-align: right;">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <table style="border:none;">
                <tr>
                    <td>Subtotal:</td>
                    <td style="text-align: right;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Shipping:</td>
                    <td style="text-align: right;">Rp 0</td>
                </tr>
                <tr style="font-size: 18px; font-weight: bold;">
                    <td>Grand Total:</td>
                    <td style="text-align: right; border-top: 2px solid #333;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Thank you for shopping with Cozzy.co!</p>
            <p>This is a computer generated invoice and no signature is required.</p>
        </div>
    </div>
</body>
</html>
