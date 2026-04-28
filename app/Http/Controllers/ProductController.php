<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Storefront: Landing Page Katalog
    public function index()
    {
        $products = Product::where('is_active', true)->latest()->get();
        return view('store.catalog', compact('products'));
    }

    // Storefront: Detail Produk
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('store.product-detail', compact('product'));
    }

    // ================= ADMIN AREA =================

    // 1. Daftar Produk + Searching (Task 1)
    public function adminIndex(Request $request)
    {
        $search = $request->input('search');

        $products = Product::query()
            ->when($search, function ($query) use ($search) {
            return $query->where('name', 'LIKE', "%{$search}%")
            ->orWhere('slug', 'LIKE', "%{$search}%");
        })
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    // 2. Halaman Create (Task 3)
    public function create()
    {
        return view('admin.products.create');
    }

    // 3. Simpan Produk Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $imagePath,
            'is_active' => true,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan ke katalog!');
    }

    // 4. Halaman Edit (Task 4)
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    // 5. Update Produk
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . $product->id,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ];

        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Informasi produk berhasil diperbarui.');
    }

    // 6. Delete (Task 2)
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk telah dihapus dari sistem.');
    }
}