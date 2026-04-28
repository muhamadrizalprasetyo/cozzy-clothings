<?php

namespace App\Services;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class InvoiceService
{
    /**
     * Generate PDF invoice, simpan ke storage, return public URL
     */
    public function generate(Order $order): string
    {
        $order->load(['user', 'orderItems.product']);

        $pdf = Pdf::loadView('pdf.invoice', compact('order'))
            ->setPaper('a4', 'portrait');

        $filename = "invoices/INV-{$order->order_number}.pdf";
        Storage::disk('public')->put($filename, $pdf->output());

        return asset("storage/{$filename}");
    }
}
