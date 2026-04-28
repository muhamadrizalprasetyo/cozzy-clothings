<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\OrderHistory;
use App\Services\MidtransService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class CheckoutController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('katalog')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('store.checkout', compact('cartItems', 'total', 'user'));
    }

    public function process(Request $request)
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('katalog')->with('error', 'Keranjang belanja Anda kosong.');
        }

        $request->validate([
            'shipping_address' => 'required|string',
            'phone' => 'required|string|max:20',
        ]);

        // Update user phone if changed
        if ($request->phone !== $user->phone) {
            $user->update(['phone' => $request->phone]);
        }

        DB::beginTransaction();

        try {
            // Lock user row for balance update
            $lockedUser = User::where('id', $user->id)->lockForUpdate()->first();
            
            $orderNumber = Order::generateOrderNumber();
            $totalPrice = 0;

            // Calculate total price first
            foreach ($cartItems as $item) {
                $totalPrice += $item->product->price * $item->quantity;
            }

            // Check if user has enough balance
            if ($lockedUser->balance < $totalPrice) {
                throw new Exception('Saldo Cozzy Cash tidak mencukupi. Saldo Anda: Rp ' . number_format($lockedUser->balance, 0, ',', '.'));
            }

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => $orderNumber,
                'shipping_address' => $request->shipping_address,
                'total_price' => $totalPrice,
                'status' => 'Paid',
                'payment_status' => 'paid',
                'payment_method' => 'cozzy_cash',
            ]);

            // Process order items and stock reduction
            foreach ($cartItems as $item) {
                // Pessimistic Locking for product
                $product = Product::where('id', $item->product_id)->lockForUpdate()->firstOrFail();

                if ($product->stock < $item->quantity) {
                    throw new Exception("Stok produk {$product->name} tidak mencukupi.");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'price' => $product->price,
                ]);

                $product->decrement('stock', $item->quantity);
            }

            // Deduct user balance
            $lockedUser->decrement('balance', $totalPrice);

            // Create Order History
            OrderHistory::create([
                'order_id' => $order->id,
                'status' => 'Paid',
                'description' => 'Pembayaran berhasil menggunakan Cozzy Cash. Saldo terpotong: Rp ' . number_format($totalPrice, 0, ',', '.'),
                'actor' => 'system',
            ]);

            OrderHistory::create([
                'order_id' => $order->id,
                'status' => 'Processing',
                'description' => 'Pesanan sedang diproses.',
                'actor' => 'system',
            ]);

            // Clear Cart
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            $remainingBalance = $lockedUser->balance - $totalPrice;
            $message = 'Pesanan berhasil! Dibayar dengan Cozzy Cash. Sisa saldo: Rp ' . number_format($remainingBalance, 0, ',', '.');

            return redirect()->route('orders.index')->with('success', $message);

        }
        catch (Exception $e) {
            DB::rollBack();
            Log::error('Checkout Process Failed: ' . $e->getMessage());

            return back()->with('error', $e->getMessage());
        }
    }
}