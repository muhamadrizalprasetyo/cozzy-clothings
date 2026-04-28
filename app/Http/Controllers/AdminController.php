<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Admin;
use Illuminate\Support\Str;

use App\Models\OrderHistory;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    /**
     * Bulk Update Order Status — Atomic Transaction
     */
    public function bulkUpdateStatus(Request $request, WhatsappService $waService)
    {
        $request->validate([
            'order_ids' => 'required|array|min:1',
            'order_ids.*' => 'exists:orders,id',
            'status' => 'required|in:Pending,Paid,Packing,Shipped,Completed',
            'courier' => 'nullable|required_if:status,Shipped|string',
            'tracking_number' => 'nullable|required_if:status,Shipped|string',
        ]);

        $updated = 0;

        DB::beginTransaction();
        try {
            $orders = Order::whereIn('id', $request->order_ids)->lockForUpdate()->get();

            foreach ($orders as $order) {
                $data = ['status' => $request->status];

                if ($request->status === 'Shipped') {
                    $data['courier'] = $request->courier;
                    $data['tracking_number'] = $request->tracking_number;
                    $data['shipped_at'] = now();
                }
                elseif ($request->status === 'Completed') {
                    $data['completed_at'] = now();
                }

                $order->update($data);

                OrderHistory::create([
                    'order_id' => $order->id,
                    'status' => $request->status,
                    'description' => "Status diubah ke {$request->status} oleh Admin.",
                    'actor' => 'admin',
                ]);

                // Kirim WA otomatis saat Shipped
                if ($request->status === 'Shipped') {
                    $waService->sendShippedNotification($order->load('user'));
                }

                $updated++;
            }

            DB::commit();
            return back()->with('success', "{$updated} pesanan berhasil diupdate ke status {$request->status}.");

        }
        catch (\Exception $e) {
            DB::rollBack();
            Log::error('Bulk update failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    // ================= 1. DASHBOARD =================

    public function dashboard()
    {
        $totalRevenue = Order::where('status', 'Completed')->sum('total_price');
        $totalOrdersCount = Order::count();
        $totalUsersCount = \App\Models\User::count();
        $productsLiveCount = Product::where('is_active', true)->count();
        $pendingFeedbackCount = Comment::where('is_approved', false)->count();

        $lowStockProducts = Product::where('stock', '<', 5)->get();
        $recentTransactions = Order::with('user')->latest()->take(10)->get();
        $liveFeedbacks = Comment::with('product')->where('is_approved', false)->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalRevenue', 'totalOrdersCount', 'totalUsersCount', 'productsLiveCount',
            'pendingFeedbackCount', 'lowStockProducts', 'recentTransactions', 'liveFeedbacks'
        ));
    }

    // ================= 2. ORDER MANAGEMENT =================
    public function orders()
    {
        $orders = Order::with('user')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:Pending,Paid,Packing,Shipped,Completed,Cancelled']);
        $order = Order::findOrFail($id);

        $data = ['status' => $request->status];
        if ($request->status === 'Shipped') {
            $data['shipped_at'] = now();
        }
        elseif ($request->status === 'Completed') {
            $data['completed_at'] = now();
        }

        $order->update($data);

        OrderHistory::create([
            'order_id' => $order->id,
            'status' => $request->status,
            'description' => "Status diubah ke {$request->status} oleh Admin.",
            'actor' => 'admin',
        ]);

        return back()->with('success', 'Status pesanan berhasil diupdate!');
    }

    // ================= 3. PRODUCT MANAGEMENT =================
    public function products()
    {
        $products = Product::latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_active' => true,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan.');
    }

    public function updateProduct(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0'
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . $product->id,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        return back()->with('success', 'Produk berhasil diupdate.');
    }

    public function destroyProduct($id)
    {
        Product::findOrFail($id)->delete();
        return back()->with('success', 'Produk berhasil dihapus.');
    }

    public function toggleProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->is_active = !$product->is_active;
        $product->save();

        return response()->json(['success' => true, 'is_active' => $product->is_active]);
    }

    // ================= 4. COMMENT MODERATION =================
    public function comments()
    {
        $comments = Comment::with('product')->latest()->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }

    public function approveComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->is_approved = true;
        $comment->save();

        return back()->with('success', 'Komentar disetujui.');
    }

    public function destroyComment($id)
    {
        Comment::findOrFail($id)->delete();
        return back()->with('success', 'Komentar dihapus.');
    }

    // ================= 5. SETTINGS =================
    public function settings()
    {
        $admin = Admin::first();
        if (!$admin) {
            $admin = Admin::create([
                'name' => 'Super Admin',
                'email' => 'admin@cozzy.com',
                'password' => bcrypt('password'),
                'shop_name' => 'Cozzy.co',
                'contact_wa' => '08123456789'
            ]);
        }
        return view('admin.settings.index', compact('admin'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'contact_wa' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255'
        ]);

        $admin = Admin::first();
        $admin->update($request->only('shop_name', 'contact_wa', 'name', 'email'));

        if ($request->filled('password')) {
            $admin->update(['password' => bcrypt($request->password)]);
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}
