@extends('layouts.admin')

@section('header', 'Add New Product')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 animate-fade-in pb-10">
    <div class="bg-cozzy-800 p-8 rounded-3xl border border-cozzy-700 shadow-xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-cozzy-accent/30 to-transparent"></div>
        
        <div class="mb-8 border-l-4 border-cozzy-accent pl-4">
            <h2 class="text-2xl font-black text-white tracking-tight uppercase">New Content</h2>
            <p class="text-sm text-gray-500 font-medium">Add a new item to your store shelf.</p>
        </div>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Product Title</label>
                    <input type="text" name="name" class="w-full bg-cozzy-900 border border-cozzy-700 text-white rounded-2xl px-5 py-4 text-sm focus:outline-none focus:border-cozzy-accent transition-all" placeholder="e.g. Cozzy T-Shirt v1" required>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Pricing (Rp)</label>
                    <input type="number" name="price" class="w-full bg-cozzy-900 border border-cozzy-700 text-white rounded-2xl px-5 py-4 text-sm focus:outline-none focus:border-cozzy-accent transition-all" placeholder="249000" required>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Full Description</label>
                <textarea name="description" rows="4" class="w-full bg-cozzy-900 border border-cozzy-700 text-white rounded-2xl px-5 py-4 text-sm focus:outline-none focus:border-cozzy-accent transition-all" placeholder="Describe the material, fit, and style..." required></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Inventory Level</label>
                    <input type="number" name="stock" class="w-full bg-cozzy-900 border border-cozzy-700 text-white rounded-2xl px-5 py-4 text-sm focus:outline-none focus:border-cozzy-accent transition-all" placeholder="10" required>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Cover Image</label>
                    <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-cozzy-900 file:text-gray-400 hover:file:text-white transition-all cursor-pointer">
                </div>
            </div>

            <div class="pt-8 flex gap-4">
                <a href="{{ route('products.index') }}" class="flex-1 bg-cozzy-900 hover:bg-black text-gray-400 hover:text-white text-center font-bold py-4 rounded-2xl transition-all border border-cozzy-700 uppercase text-xs tracking-widest">Discard</a>
                <button type="submit" class="flex-[2] bg-cozzy-accent hover:bg-white text-cozzy-900 font-black py-4 rounded-2xl transition-all shadow-xl shadow-white/5 active:scale-95 uppercase text-xs tracking-widest">Publish Product</button>
            </div>
        </form>
    </div>
</div>
@endsection
