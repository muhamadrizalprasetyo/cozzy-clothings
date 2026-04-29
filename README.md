<div align="center">

<img src="logo.JPG" alt="Cozzy Logo" width="180" style="margin-bottom: 20px;">

**Premium Clothing Distro Platform with Virtual Wallet Integration**

[![Laravel](https://img.shields.io/badge/Laravel_10-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP_8.1-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)

</div>

---

## Tentang Proyek
**Cozzy** adalah platform e-commerce yang dirancang khusus untuk memenuhi kebutuhan operasional distro pakaian premium. Sistem ini menonjolkan desain *user interface* yang minimalis serta mengimplementasikan simulasi transaksi mandiri (E-Wallet) tanpa bergantung pada *payment gateway* eksternal.

---

## Fitur Unggulan (Komprehensif)

Sistem ini dibagi menjadi dua modul utama dengan fungsionalitas penuh:

### Modul Pengguna (User Storefront)
* **Cozzy Cash (Virtual Wallet)**: Sistem E-Wallet terintegrasi di mana setiap pengguna baru otomatis mendapatkan saldo *dummy* sebesar **Rp 1.000.000** untuk transaksi instan.
* **Dynamic Cart Engine**: Sistem keranjang belanja dengan *real-time badge notification* di *sticky navbar*.
* **Seamless & Secure Checkout**: Proses pembayaran menggunakan validasi saldo otomatis. Menerapkan perlindungan **Atomic Database Transactions** (`DB::beginTransaction()`) untuk mencegah anomali data stok dan saldo saat transaksi bersamaan.
* **Order Tracking & History**: Halaman "My Orders" untuk melacak status pesanan (Pending, Paid, Shipped, Completed) lengkap dengan *invoice* visual.
* **Responsive Premium UI**: Antarmuka *mobile-friendly* yang dibangun murni dengan Tailwind CSS, menampilkan katalog produk (T-shirt & Hoodie) dengan tata letak minimalis dan elegan.

### Modul Administrator (Admin Dashboard)
* **Centralized Dashboard**: Panel kontrol utama untuk memantau ringkasan pesanan, pendapatan, dan metrik toko lainnya.
* **Product Management (CRUD)**: Fungsionalitas penuh untuk menambah, mengedit, dan menghapus data produk, lengkap dengan pemetaan *path* gambar terstruktur (`public/img/products/`).
* **Order Fulfillment Management**: Fitur pemrosesan pesanan terpusat untuk memverifikasi transaksi pelanggan.
* **Batch Action (Bulk Shipped)**: Fitur efisiensi operasional tingkat lanjut yang memungkinkan admin memperbarui status puluhan pesanan menjadi "Shipped" secara bersamaan melalui sistem *checkbox*.
* **Automated Notification Gateway** *(Placeholder)*: Alur logika sistem yang sudah disiapkan untuk mengirimkan notifikasi resi otomatis via API WhatsApp ketika pesanan dikirim.
