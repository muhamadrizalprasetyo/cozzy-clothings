<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get()
            ->filter(function ($item) {
            return $item->product !== null;
        });

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('store.cart', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $existingCart = Cart::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($existingCart) {
            $newQty = $existingCart->quantity + $request->quantity;
            if ($product->stock < $newQty) {
                return back()->with('error', 'Stok tidak mencukupi untuk jumlah total di keranjang.');
            }
            $existingCart->update(['quantity' => $newQty]);
        }
        else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('user_id', auth()->id())->findOrFail($id);
        $product = $cart->product;

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $cart->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Keranjang diperbarui.');
    }

    public function destroy($id)
    {
        Cart::where('user_id', auth()->id())->findOrFail($id)->delete();
        return back()->with('success', 'Item dihapus dari keranjang.');
    }
}
