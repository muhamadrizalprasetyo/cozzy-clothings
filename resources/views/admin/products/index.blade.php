@extends('layouts.admin')

@section('header', 'Products Catalog')

@section('content')
<div class="space-y-8 animate-fade-in pb-10">
    
    <!-- Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white/80 backdrop-blur-md p-6 rounded-2xl border border-gray-200/60 shadow-sm relative overflow-hidden group">
        <div class="absolute inset-0 bg-gradient-to-r from-brand-blue/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="relative z-10">
            <h2 class="text-xl font-bold tracking-tight text-gray-900 border-l-4 border-brand-blue pl-3">Manage Inventory</h2>
            <p class="text-sm text-gray-500 mt-1 pl-4">Add, edit, or remove hoodies and t-shirts.</p>
        </div>
        <div class="relative z-10 flex gap-3 w-full sm:w-auto">
            <div class="relative w-full sm:w-64 group/search">
                <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within/search:text-brand-blue transition-colors"></i>
                <input type="text" placeholder="Search products..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue transition-all">
            </div>
            <button class="bg-gradient-to-br from-brand-blue to-blue-700 hover:from-blue-700 hover:to-indigo-800 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-[0_4px_15px_rgba(37,99,235,0.3)] hover:shadow-[0_6px_20px_rgba(37,99,235,0.5)] hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2 flex-shrink-0">
                <i class="ph ph-plus-bold"></i> Add Product
            </button>
        </div>
    </div>

    <!-- Toolbars / Filters -->
    <div class="flex flex-wrap gap-2">
        <button class="px-4 py-1.5 rounded-full bg-brand-navy text-white text-xs font-bold shadow-md shadow-brand-navy/20 transition-transform hover:scale-105 active:scale-95">All Products</button>
        <button class="px-4 py-1.5 rounded-full bg-white border border-gray-200 text-gray-600 text-xs font-medium hover:border-gray-300 hover:bg-gray-50 transition-all hover:-translate-y-0.5 active:scale-95 shadow-sm">Hoodies</button>
        <button class="px-4 py-1.5 rounded-full bg-white border border-gray-200 text-gray-600 text-xs font-medium hover:border-gray-300 hover:bg-gray-50 transition-all hover:-translate-y-0.5 active:scale-95 shadow-sm">T-Shirts</button>
        <button class="px-4 py-1.5 rounded-full bg-white border border-gray-200 text-gray-600 text-xs font-medium hover:border-gray-300 hover:bg-gray-50 transition-all hover:-translate-y-0.5 active:scale-95 shadow-sm">Out of Stock</button>
        <div class="ml-auto flex items-center gap-2">
            <button class="w-8 h-8 rounded-full bg-white border border-gray-200 hover:border-brand-blue hover:text-brand-blue flex items-center justify-center transition-colors text-gray-500 shadow-sm"><i class="ph ph-funnel"></i></button>
            <button class="w-8 h-8 rounded-full bg-white border border-gray-200 hover:border-brand-blue hover:text-brand-blue flex items-center justify-center transition-colors text-gray-500 shadow-sm"><i class="ph ph-arrows-down-up"></i></button>
        </div>
    </div>

    <!-- Advanced Interactive Product Table -->
    <div class="bg-white/90 backdrop-blur-md rounded-2xl border border-gray-200/60 shadow-sm flex flex-col overflow-visible relative z-10">
        
        <!-- Batch Action Bar (Appears when checked) - simulated visual -->
        <div class="hidden absolute top-0 inset-x-0 h-14 bg-brand-blue rounded-t-2xl z-20 flex items-center justify-between px-6 opacity-0 translate-y-2 transition-all">
            <p class="text-sm font-semibold text-white">2 items selected</p>
            <div class="flex gap-2">
                <button class="text-xs font-bold bg-white/20 hover:bg-white/30 text-white px-3 py-1.5 rounded border border-white/10 transition">Delete</button>
                <button class="text-xs font-bold bg-white text-brand-blue hover:bg-gray-50 px-3 py-1.5 rounded shadow-sm transition">Bulk Edit</button>
            </div>
        </div>

        <div class="overflow-x-auto relative z-10">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-gray-50/80 text-gray-400 text-[10px] font-bold uppercase tracking-widest border-b border-gray-200/60">
                        <th class="px-6 py-4 w-10">
                            <input type="checkbox" class="rounded border-gray-300 text-brand-blue focus:ring-brand-blue/30 w-4 h-4 cursor-pointer">
                        </th>
                        <th class="px-6 py-4">Product Name & Variant</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Status / Visibility</th>
                        <th class="px-6 py-4">Price / Stock</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-gray-100">
                    
                    <!-- Advanced Product Row 1 -->
                    <tr class="group hover:bg-brand-blue/5 transition-colors cursor-default relative">
                        <td class="px-6 py-4">
                            <input type="checkbox" class="rounded border-gray-300 text-brand-blue focus:ring-brand-blue/30 w-4 h-4 cursor-pointer">
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-gray-50 border border-gray-200 p-1 flex items-center justify-center relative overflow-hidden group-hover:border-brand-blue/30 transition-colors shadow-sm">
                                    <i class="ph ph-hoodie text-3xl text-gray-400 group-hover:text-brand-blue transition-colors group-hover:scale-110 duration-500"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 group-hover:text-brand-blue transition-colors text-base cursor-pointer hover:underline">Cozzy Signature Hoodie</h4>
                                    <p class="text-[11px] text-gray-500 font-medium mt-0.5 uppercase tracking-wider">SKU: CZZ-HD-001 <span class="mx-1">&bull;</span> Navy Blue</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100">
                                <i class="ph-fill ph-hoodie"></i> Hoodie
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <!-- Modern Toggle Switch -->
                                <button class="relative inline-flex h-5 w-9 items-center rounded-full bg-brand-blue transition-colors focus:outline-none focus:ring-2 focus:ring-brand-blue/40 focus:ring-offset-2">
                                    <span class="inline-block h-3.5 w-3.5 transform rounded-full bg-white transition-transform translate-x-4 shadow"></span>
                                </button>
                                <span class="text-xs font-semibold text-gray-700">Published</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-0.5">
                                <p class="font-black text-gray-900 tracking-tight text-sm">Rp 450.000</p>
                                <p class="text-[10px] text-green-600 font-bold uppercase tracking-wider">42 in stock <span class="text-gray-400 mx-1 font-medium">| S, M, L, XL</span></p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right relative">
                            <div class="flex items-center justify-end gap-2">
                                <button class="w-8 h-8 rounded flex items-center justify-center text-gray-400 hover:bg-white hover:text-brand-blue hover:shadow-sm border border-transparent hover:border-gray-200 transition-all tooltip" data-tip="Quick Edit"><i class="ph ph-pencil-simple text-lg"></i></button>
                                <button class="w-8 h-8 rounded flex items-center justify-center text-gray-400 hover:bg-white hover:text-brand-blue hover:shadow-sm border border-transparent hover:border-gray-200 transition-all tooltip" data-tip="Duplicate"><i class="ph ph-copy text-lg"></i></button>
                                <button class="w-8 h-8 rounded flex items-center justify-center text-gray-400 hover:bg-white hover:text-red-500 hover:shadow-sm border border-transparent hover:border-gray-200 transition-all tooltip" data-tip="Delete"><i class="ph ph-trash text-lg"></i></button>
                            </div>
                        </td>
                    </tr>

                    <!-- Advanced Product Row 2 -->
                    <tr class="group hover:bg-brand-blue/5 transition-colors cursor-default relative">
                        <td class="px-6 py-4">
                            <input type="checkbox" class="rounded border-gray-300 text-brand-blue focus:ring-brand-blue/30 w-4 h-4 cursor-pointer">
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-xl bg-gray-50 border border-gray-200 p-1 flex items-center justify-center relative overflow-hidden group-hover:border-brand-blue/30 transition-colors shadow-sm">
                                    <i class="ph ph-t-shirt text-3xl text-gray-400 group-hover:text-brand-blue transition-colors group-hover:scale-110 duration-500"></i>
                                    <div class="absolute inset-0 bg-red-500/10"></div>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 group-hover:text-brand-blue transition-colors text-base cursor-pointer hover:underline">Oversized Basic Tee</h4>
                                    <p class="text-[11px] text-gray-500 font-medium mt-0.5 uppercase tracking-wider">SKU: CZZ-TS-045 <span class="mx-1">&bull;</span> Broken White</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold bg-cyan-50 text-cyan-700 border border-cyan-100">
                                <i class="ph-fill ph-t-shirt"></i> T-Shirt
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <button class="relative inline-flex h-5 w-9 items-center rounded-full bg-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2">
                                    <span class="inline-block h-3.5 w-3.5 transform rounded-full bg-white transition-transform translate-x-1 shadow"></span>
                                </button>
                                <span class="text-xs font-semibold text-gray-400">Draft</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-0.5">
                                <p class="font-black text-gray-400 tracking-tight text-sm line-through">Rp 180.000</p>
                                <p class="text-[10px] text-amber-600 font-bold uppercase tracking-wider group-hover:animate-pulse">3 in stock <span class="text-gray-400 mx-1 font-medium">| XL only</span></p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button class="w-8 h-8 rounded flex items-center justify-center text-gray-400 hover:bg-white hover:text-brand-blue hover:shadow-sm border border-transparent hover:border-gray-200 transition-all"><i class="ph ph-pencil-simple text-lg"></i></button>
                                <button class="w-8 h-8 rounded flex items-center justify-center text-gray-400 hover:bg-white hover:text-brand-blue hover:shadow-sm border border-transparent hover:border-gray-200 transition-all"><i class="ph ph-copy text-lg"></i></button>
                                <button class="w-8 h-8 rounded flex items-center justify-center text-gray-400 hover:bg-white hover:text-red-500 hover:shadow-sm border border-transparent hover:border-gray-200 transition-all"><i class="ph ph-trash text-lg"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- Pagination Simulator -->
        <div class="px-6 py-4 border-t border-gray-200/60 bg-gray-50/50 flex items-center justify-between">
            <p class="text-xs text-gray-500 font-medium">Showing <span class="font-bold text-gray-900">1</span> to <span class="font-bold text-gray-900">3</span> of <span class="font-bold text-gray-900">48</span> products</p>
            <div class="flex gap-1">
                <button class="w-8 h-8 rounded border border-gray-200 bg-white text-gray-400 flex items-center justify-center disable"><i class="ph ph-caret-left"></i></button>
                <button class="w-8 h-8 rounded border-none bg-brand-navy text-white font-bold flex items-center justify-center text-xs shadow-md shadow-brand-navy/20">1</button>
                <button class="w-8 h-8 rounded border border-gray-200 bg-white text-gray-600 hover:text-brand-navy hover:bg-gray-50 font-bold flex items-center justify-center text-xs transition">2</button>
                <button class="w-8 h-8 rounded border border-gray-200 bg-white text-gray-600 hover:text-brand-navy hover:bg-gray-50 font-bold flex items-center justify-center text-xs transition">3</button>
                <span class="w-8 h-8 flex items-center justify-center text-gray-400">...</span>
                <button class="w-8 h-8 rounded border border-gray-200 bg-white text-gray-600 hover:text-brand-navy hover:bg-gray-50 flex items-center justify-center transition"><i class="ph ph-caret-right"></i></button>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
