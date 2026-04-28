<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MidtransCallbackController;
use App\Http\Controllers\ProfileController;

// ================= ADMIN LOGIN =================
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// ================= STOREFRONT (GUEST) ==================
Route::get('/', [ProductController::class , 'index'])->name('katalog');
Route::get('/product/{slug}', [ProductController::class , 'show'])->name('product.detail');
Route::get('/about', function () {
    return view('store.about');
})->name('about');

// ================= AUTHENTICATED USER ==================
Route::middleware('auth')->group(function () {
    // 1. Cart
    Route::get('/cart', [CartController::class , 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class , 'store'])->name('cart.store');
    Route::patch('/cart/{id}', [CartController::class , 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class , 'destroy'])->name('cart.destroy');

    // 2. Checkout
    Route::get('/checkout', [CheckoutController::class , 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class , 'process'])->name('checkout.process');

    // 3. Orders (Renamed to my-orders as requested)
    Route::get('/my-orders', [OrderController::class , 'index'])->name('orders.index');
    Route::get('/my-orders/{id}', [OrderController::class , 'show'])->name('orders.show');
    Route::get('/invoice/{id}', [OrderController::class , 'downloadInvoice'])->name('invoice.download');

    // 4. Profile
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
});

// ================= MIDTRANS CALLBACK (PUBLIC) =================
Route::post('/midtrans/callback', [MidtransCallbackController::class , 'handle'])->name('midtrans.callback');

// ================= ADMIN PANELS (AUTH) =================
Route::middleware(['auth:admin', 'admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class , 'dashboard'])->name('admin.dashboard');

    // Orders
    Route::get('/orders', [AdminController::class , 'orders'])->name('admin.orders.index');
    Route::patch('/order/{id}/update-status', [AdminController::class , 'updateOrderStatus'])->name('admin.order.updateStatus');
    Route::post('/orders/bulk-update', [AdminController::class , 'bulkUpdateStatus'])->name('admin.orders.bulkUpdate');

    // Products CRUD
    Route::get('/products', [ProductController::class , 'adminIndex'])->name('products.index');
    Route::get('/products/create', [ProductController::class , 'create'])->name('products.create');
    Route::post('/products', [ProductController::class , 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class , 'edit'])->name('products.edit');
    Route::patch('/products/{id}', [ProductController::class , 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class , 'destroy'])->name('products.destroy');
    Route::post('/products/{id}/toggle', [AdminController::class , 'toggleProduct'])->name('admin.products.toggle');

    // Comments
    Route::get('/comments', [AdminController::class , 'comments'])->name('admin.comments.index');
    Route::patch('/comment/{id}/approve', [AdminController::class , 'approveComment'])->name('admin.comment.approve');
    Route::delete('/comment/{id}', [AdminController::class , 'destroyComment'])->name('admin.comment.destroy');

    // Settings
    Route::get('/settings', [AdminController::class , 'settings'])->name('admin.settings.index');
    Route::patch('/settings', [AdminController::class , 'updateSettings'])->name('admin.settings.update');
});

require __DIR__ . '/auth.php';
