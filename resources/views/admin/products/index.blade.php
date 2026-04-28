@extends('layouts.admin')

@section('header', 'Products Catalog')

@section('content')
<div class="space-y-8 animate-fade-in pb-10">
    
    <!-- Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-cozzy-800 p-6 rounded-2xl border border-cozzy-700 shadow-xl relative overflow-hidden group">
        <div class="relative z-10">
            <h2 class="text-xl font-bold tracking-tight text-white border-l-4 border-cozzy-accent pl-3 uppercase">Inventory</h2>
            <p class="text-sm text-gray-500 mt-1 pl-4">Manage your apparel collection.</p>
        </div>
        <div class="relative z-10 flex gap-3 w-full sm:w-auto">
            <form action="{{ route('products.index') }}" method="GET" class="relative w-full sm:w-64 group/search">
                <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 group-focus-within/search:text-cozzy-accent transition-colors"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search collection..." class="w-full pl-10 pr-4 py-2.5 bg-cozzy-900 border border-cozzy-700 text-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-cozzy-accent/20">
            </form>
            <a href="{{ route('products.create') }}" class="bg-cozzy-accent hover:bg-gray-200 text-cozzy-900 px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg transition-all duration-300 flex items-center gap-2 flex-shrink-0 active:scale-95">
                <i class="ph ph-plus-bold"></i> Add Product
            </a>
        </div>
    </div>

    <!-- Advanced Interactive Product Table -->
    <div class="bg-cozzy-800 rounded-2xl border border-cozzy-700 shadow-xl overflow-hidden relative">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-cozzy-900/50 text-gray-400 text-[10px] font-bold uppercase tracking-widest border-b border-cozzy-700">
                        <th class="px-6 py-4 w-10">#</th>
                        <th class="px-6 py-4">Product Variant</th>
                        <th class="px-6 py-4">Visibility</th>
                        <th class="px-6 py-4">Price / Stock</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-cozzy-700">
                    @forelse($products as $product)
                    <tr class="group hover:bg-white/5 transition-colors cursor-default">
                        <td class="px-6 py-4 text-gray-500 font-bold">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-cozzy-900 border border-cozzy-700 p-1 flex items-center justify-center overflow-hidden group-hover:border-cozzy-accent transition-colors shadow-inner text-gray-600">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="object-cover w-full h-full rounded-lg">
                                    @else
                                        <i class="ph ph-t-shirt text-3xl"></i>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-bold text-white group-hover:text-cozzy-accent transition-colors text-base">{{ $product->name }}</h4>
                                    <p class="text-[10px] text-gray-500 font-medium tracking-widest uppercase">{{ $product->slug }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-2 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $product->is_active ? 'bg-green-500/10 text-green-500' : 'bg-gray-500/10 text-gray-500' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $product->is_active ? 'bg-green-400' : 'bg-gray-500' }}"></span>
                                {{ $product->is_active ? 'Public' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-black text-cozzy-accent tracking-tighter text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-[10px] {{ $product->stock < 5 ? 'text-red-500 animate-pulse' : 'text-gray-500' }} font-bold uppercase tracking-wider">{{ $product->stock }} in stock</p>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2 text-gray-500">
                                <a href="{{ route('products.edit', $product->id) }}" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-white/10 hover:text-cozzy-accent transition-all border border-transparent hover:border-cozzy-700">
                                    <i class="ph ph-pencil-simple text-xl"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-white/10 hover:text-red-500 transition-all border border-transparent hover:border-cozzy-700">
                                        <i class="ph ph-trash text-xl"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center text-gray-500 flex-col gap-4">
                            <i class="ph ph-mask-sad text-5xl"></i>
                            <p class="font-bold mt-2 italic">Product list is empty.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
        <div class="px-6 py-4 border-t border-cozzy-700 bg-cozzy-900/30">
            {{ $products->appends(['search' => request('search')])->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
