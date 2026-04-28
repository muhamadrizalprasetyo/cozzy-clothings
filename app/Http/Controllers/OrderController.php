<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('store.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('user_id', auth()->id())
            ->with(['orderItems.product', 'histories'])
            ->findOrFail($id);

        return view('store.orders.show', compact('order'));
    }

    public function downloadInvoice($id)
    {
        $order = Order::where('user_id', auth()->id())->findOrFail($id);
        $filename = "invoices/INV-{$order->order_number}.pdf";

        if (!Storage::disk('public')->exists($filename)) {
            return back()->with('error', 'Invoice belum tersedia atau sedang diproses.');
        }

        return Storage::disk('public')->download($filename);
    }
}
