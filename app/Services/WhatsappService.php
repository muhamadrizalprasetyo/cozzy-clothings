<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappService
{
    protected string $apiUrl;
    protected string $token;

    public function __construct()
    {
        $this->apiUrl = config('services.fonnte.url', 'https://api.fonnte.com/send');
        $this->token = config('services.fonnte.token');
    }

    /**
     * Kirim notifikasi saat status → Shipped
     */
    public function sendShippedNotification(Order $order): bool
    {
        $phone = $order->user->phone ?? $order->guest_phone;
        $name = $order->user->name ?? $order->guest_name;
        $message = $this->buildShippedMessage($order, $name);

        return $this->send($phone, $message);
    }

    /**
     * Kirim konfirmasi pembayaran + link PDF invoice
     */
    public function sendPaymentConfirmation(Order $order, string $invoiceUrl): bool
    {
        $phone = $order->user->phone ?? $order->guest_phone;
        $name = $order->user->name ?? $order->guest_name;

        $message = "✅ *PEMBAYARAN BERHASIL*\n\n"
            . "Halo {$name},\n"
            . "Pembayaran untuk pesanan *{$order->order_number}* telah dikonfirmasi.\n\n"
            . "💰 Total: Rp " . number_format($order->total_price, 0, ',', '.') . "\n\n"
            . "📄 Download Invoice:\n{$invoiceUrl}\n\n"
            . "Pesanan Anda segera diproses! 🎉\n"
            . "— *Cozzy.co*";

        return $this->send($phone, $message);
    }

    private function buildShippedMessage(Order $order, string $name): string
    {
        return "📦 *PESANAN DIKIRIM*\n\n"
            . "Halo {$name},\n"
            . "Pesanan *{$order->order_number}* telah dikirim!\n\n"
            . "🚚 Kurir: {$order->courier}\n"
            . "📋 No. Resi: {$order->tracking_number}\n\n"
            . "Terima kasih sudah belanja di *Cozzy.co*! 🛍️";
    }

    private function send(string $phone, string $message): bool
    {
        if (empty($phone) || empty($this->token)) {
            Log::warning('WA send skipped: missing phone or token.');
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->post($this->apiUrl, [
                'target' => $phone,
                'message' => $message,
            ]);

            Log::info('WA sent', ['phone' => $phone, 'status' => $response->status()]);
            return $response->successful();
        }
        catch (\Exception $e) {
            Log::error('WA send failed', ['error' => $e->getMessage()]);
            return false;
        }
    }
}
