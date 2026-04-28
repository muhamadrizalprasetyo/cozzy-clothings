<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ===== USERS =====
        User::create([
            'name' => 'Admin Cozzy',
            'email' => 'admin@cozzy.com',
            'password' => bcrypt('password'),
            'phone' => '08123456789',
            'is_admin' => true,
        ]);

        User::create([
            'name' => 'Pembeli Test',
            'email' => 'buyer@cozzy.com',
            'password' => bcrypt('password'),
            'phone' => '08987654321',
            'address' => 'Jl. Testing No. 1, Jakarta',
            'is_admin' => false,
        ]);

        // ===== PRODUCTS =====
        // Hoodie - menggunakan gambar dari folder hoodies
        Product::create([
            'name' => 'Cozzy Oversize Hoodie - Midnight Black',
            'slug' => 'cozzy-oversize-hoodie-midnight-black',
            'description' => 'Hoodie premium dengan bahan cotton fleece 330gsm yang sangat nyaman dan adem.',
            'price' => 249000,
            'stock' => 50,
            'image' => 'img/products/hoodies/hd cozzy.JPG',
            'is_active' => true,
        ]);

        // T-Shirts - menggunakan gambar dari folder tshirts
        Product::create([
            'name' => 'Dont Text Your Ex Tee',
            'slug' => 'dont-text-your-ex-tee',
            'description' => 'Kaos statement dengan desain unik dan catchy. Cocok untuk casual wear.',
            'price' => 159000,
            'stock' => 25,
            'image' => 'img/products/tshirts/ts dont text your ex.JPG',
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'I Love Jawa Tee',
            'slug' => 'i-love-jawa-tee',
            'description' => 'Kaos kebanggaan Jawa dengan desain modern dan stylish.',
            'price' => 149000,
            'stock' => 3, // Low stock for testing
            'image' => 'img/products/tshirts/ts i love jawa.JPG',
            'is_active' => true,
        ]);

        Product::create([
            'name' => 'Selena Gomez Tee',
            'slug' => 'selena-gomez-tee',
            'description' => 'Kaos premium dengan desain eksklusif. Limited edition.',
            'price' => 179000,
            'stock' => 15,
            'image' => 'img/products/tshirts/ts selena gomez.JPG',
            'is_active' => true,
        ]);

        // Produk tanpa gambar untuk testing
        Product::create([
            'name' => 'Cozzy Cargo Pants - Olive',
            'slug' => 'cozzy-cargo-pants-olive',
            'description' => 'Celana cargo dengan material twill premium. Tahan lama dan stylish.',
            'price' => 299000,
            'stock' => 0, // Out of stock for testing
            'image' => null,
            'is_active' => true,
        ]);
    }
}
