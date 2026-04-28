<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderHistory;
use App\Services\InvoiceService;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MidtransCallbackController extends Controller
{
    public function handle(Request $request, InvoiceService $invoiceService, WhatsappService $waService)
    {
        $serverKey = config('midtrans.server_key');
        $signatureKey = hash('sha512',
            $request->order_id . $request->status_code .
            $request->gross_amount . $serverKey
        );

        if ($signatureKey !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $order = Order::where('midtrans_order_id', $request->order_id)->firstOrFail();

        if (in_array($request->transaction_status, ['capture', 'settlement'])) {
            DB::transaction(function () use ($order, $invoiceService, $waService) {
                // Update Order
                $order->update([
                    'status' => 'Paid',
                    'paid_at' => now()
                ]);

                // Create History
                OrderHistory::create([
                    'order_id' => $order->id,
                    'status' => 'Paid',
                    'description' => 'Pembayaran berhasil dikonfirmasi oleh Midtrans.',
                    'actor' => 'midtrans'
                ]);

                // Generate Invoice and Send WA
                try {
                    $invoiceUrl = $invoiceService->generate($order);
                    $waService->sendPaymentConfirmation($order, $invoiceUrl);
                }
                catch (\Exception $e) {
                    Log::error('Callback Post-processing Error: ' . $e->getMessage());
                }
            });
        }
        elseif (in_array($request->transaction_status, ['expire', 'deny', 'cancel'])) {
            DB::transaction(function () use ($order) {
                $order->update(['status' => 'Cancelled']);

                // Rollback Stock
                foreach ($order->orderItems as $item) {
                    $item->product->increment('stock', $item->quantity);
                }

                OrderHistory::create([
                    'order_id' => $order->id,
                    'status' => 'Cancelled',
                    'description' => 'Pesanan dibatalkan otomatis (Expired/Denied/Cancelled).',
                    'actor' => 'midtrans'
                ]);
            });
        }

        return response()->json(['message' => 'OK']);
    }
}
