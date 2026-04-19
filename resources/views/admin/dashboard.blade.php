@extends('layouts.admin')

@section('header', 'Dashboard')

@section('content')
<div class="space-y-8 animate-fade-in pb-10">
    
    <!-- Hero Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Interactive Card 1 w/ Sparkline -->
        <div class="group relative bg-white p-6 rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-xl hover:shadow-brand-blue/5 transition-all duration-500 overflow-hidden cursor-pointer flex flex-col justify-between h-[160px]">
            <div class="absolute inset-0 bg-gradient-to-br from-brand-blue/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Total Revenue</h3>
                    <p class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600 tracking-tight group-hover:scale-[1.02] transform transition-transform origin-left">Rp 24.5M</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200/60 flex items-center justify-center text-gray-500 group-hover:bg-brand-blue group-hover:text-white group-hover:border-brand-blue transition-all duration-300 shadow-sm">
                    <i class="ph ph-currency-dollar text-xl group-hover:animate-bounce-short"></i>
                </div>
            </div>

            <!-- CSS Mini Chart (Bars) -->
            <div class="relative z-10 mt-4 flex items-end justify-between h-10 gap-1 w-full opacity-60 group-hover:opacity-100 transition-opacity">
                <!-- Bar 1 --> <div class="w-full bg-blue-100 rounded-t-sm h-[30%] group-hover:bg-brand-blue/20 transition-colors delay-75"></div>
                <!-- Bar 2 --> <div class="w-full bg-blue-200 rounded-t-sm h-[50%] group-hover:bg-brand-blue/40 transition-colors delay-100"></div>
                <!-- Bar 3 --> <div class="w-full bg-blue-100 rounded-t-sm h-[40%] group-hover:bg-brand-blue/30 transition-colors delay-150"></div>
                <!-- Bar 4 --> <div class="w-full bg-blue-300 rounded-t-sm h-[70%] group-hover:bg-brand-blue/60 transition-colors delay-200"></div>
                <!-- Bar 5 --> <div class="w-full bg-blue-100 rounded-t-sm h-[40%] group-hover:bg-brand-blue/30 transition-colors delay-300"></div>
                <!-- Bar 6 --> <div class="w-full bg-blue-400 rounded-t-sm h-[90%] group-hover:bg-brand-blue/80 transition-colors delay-500"></div>
                <!-- Bar 7 --> <div class="w-full bg-blue-500 rounded-t-sm h-[100%] group-hover:bg-brand-blue transition-colors shadow-[0_0_8px_rgba(37,99,235,0.4)] delay-700 relative">
                    <span class="absolute -top-6 left-1/2 -translate-x-1/2 text-[9px] font-bold text-brand-blue bg-white px-1.5 py-0.5 rounded shadow-sm opacity-0 group-hover:opacity-100 transition-opacity delay-700">+12%</span>
                </div>
            </div>
        </div>

        <!-- Interactive Card 2 w/ Line Chart -->
        <div class="group relative bg-white p-6 rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-xl hover:shadow-brand-blue/5 transition-all duration-500 overflow-hidden cursor-pointer flex flex-col justify-between h-[160px]">
             <div class="absolute inset-0 bg-gradient-to-br from-brand-blue/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
             <div class="relative z-10 flex items-start justify-between">
                <div>
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Guest Orders</h3>
                    <p class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600 tracking-tight group-hover:scale-[1.02] transform transition-transform origin-left">152</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200/60 flex items-center justify-center text-gray-500 group-hover:bg-brand-blue group-hover:text-white group-hover:border-brand-blue transition-all duration-300 shadow-sm">
                    <i class="ph ph-shopping-bag text-xl group-hover:animate-bounce-short"></i>
                </div>
            </div>
            
            <div class="relative z-10 flex items-center mt-6">
                <div class="flex-1 w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-green-300 to-green-500 rounded-full w-[0%] group-hover:w-[75%] transition-all duration-1000 ease-out"></div>
                </div>
                <span class="ml-3 text-xs font-bold text-green-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-500">+8.2%</span>
            </div>
        </div>

        <!-- Interactive Card 3 w/ Stock Indicator -->
        <div class="group relative bg-white p-6 rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-xl hover:shadow-brand-blue/5 transition-all duration-500 overflow-hidden cursor-pointer flex flex-col justify-between h-[160px]">
            <div class="absolute inset-0 bg-gradient-to-br from-brand-blue/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Products Live</h3>
                    <p class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600 tracking-tight group-hover:scale-[1.02] transform transition-transform origin-left">48</p>
                </div>
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200/60 flex items-center justify-center text-gray-500 group-hover:bg-brand-blue group-hover:text-white group-hover:border-brand-blue transition-all duration-300 shadow-sm">
                    <i class="ph ph-t-shirt text-xl group-hover:animate-bounce-short"></i>
                </div>
            </div>
            
            <div class="relative z-10 flex gap-2 mt-6">
                <!-- Data metrics -->
                <div class="flex-1 border border-gray-100 bg-gray-50 rounded-lg p-2 flex flex-col items-center justify-center group-hover:border-gray-200 group-hover:bg-white transition-colors">
                    <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider">Hoodies</p>
                    <p class="text-sm font-black text-gray-800">20</p>
                </div>
                <div class="flex-1 border border-gray-100 bg-gray-50 rounded-lg p-2 flex flex-col items-center justify-center group-hover:border-gray-200 group-hover:bg-white transition-colors">
                    <p class="text-[10px] text-gray-400 font-semibold uppercase tracking-wider">T-Shirts</p>
                    <p class="text-sm font-black text-gray-800">28</p>
                </div>
            </div>
        </div>

        <!-- Interactive Card 4 w/ Alert -->
        <div class="group relative bg-white p-6 rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-xl hover:shadow-amber-500/5 transition-all duration-500 overflow-hidden cursor-pointer flex flex-col justify-between h-[160px]">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-50/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            
            <div class="relative z-10 flex items-start justify-between">
                <div>
                    <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-widest mb-1">Pending Feedback</h3>
                    <p class="text-3xl font-black text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-600 tracking-tight group-hover:scale-[1.02] transform transition-transform origin-left">24</p>
                </div>
                <div class="relative w-10 h-10 rounded-xl bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200/60 flex items-center justify-center text-gray-500 group-hover:bg-amber-500 group-hover:text-white group-hover:border-amber-500 transition-all duration-300 shadow-sm">
                    <i class="ph ph-chat-text text-xl group-hover:animate-bounce-short"></i>
                    <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white animate-ping"></span>
                    <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                </div>
            </div>
            
            <div class="relative z-10 mt-6">
                <div class="flex items-center justify-between p-2 rounded-lg bg-amber-50 border border-amber-100 group-hover:shadow-[inset_0_0_10px_rgba(245,158,11,0.1)] transition-all">
                    <div class="flex items-center gap-2">
                        <i class="ph-fill ph-warning-circle text-amber-500 text-lg"></i>
                        <span class="text-[11px] font-bold text-amber-700">5 Require Review</span>
                    </div>
                    <i class="ph ph-arrow-right text-amber-500 opacity-0 group-hover:opacity-100 transition-opacity -translate-x-2 group-hover:translate-x-0 transform duration-300"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grids -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Modern Order Table -->
        <div class="lg:col-span-2 bg-white/80 backdrop-blur-md rounded-2xl border border-gray-200/60 shadow-sm flex flex-col overflow-hidden">
            <div class="p-6 border-b border-gray-200/60 flex justify-between items-center bg-white/50">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 tracking-tight">Recent Transactions</h3>
                    <p class="text-xs text-gray-500 mt-1">Manage and track your latest guest orders.</p>
                </div>
                <button class="flex items-center gap-2 text-sm font-semibold text-white bg-brand-navy hover:bg-brand-blue px-4 py-2 rounded-xl transition-all shadow-sm hover:shadow-md hover:shadow-brand-blue/30 active:scale-95">
                    View All <i class="ph ph-arrow-right"></i>
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-gray-50/50 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-200/60">
                            <th class="px-6 py-4">Order ID</th>
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Amount</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        <!-- Interactive Row -->
                        <tr class="group hover:bg-brand-blue/5 transition-colors cursor-pointer">
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 group-hover:text-brand-blue transition-colors">#CRZ-1023</span>
                                <p class="text-[10px] text-gray-400 mt-0.5">2 mins ago</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center text-xs font-bold text-gray-600">RZ</div>
                                    <span class="font-semibold text-gray-800">Rizal</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-black text-gray-900">Rp 450.000</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-amber-50 text-amber-600 border border-amber-100 uppercase tracking-widest">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pending
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 -translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                                    <button class="w-8 h-8 rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-brand-blue hover:border-brand-blue flex items-center justify-center transition-colors shadow-sm"><i class="ph ph-eye"></i></button>
                                    <button class="w-8 h-8 rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-green-600 hover:border-green-600 flex items-center justify-center transition-colors shadow-sm"><i class="ph ph-check"></i></button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Interactive Row -->
                        <tr class="group hover:bg-brand-blue/5 transition-colors cursor-pointer">
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 group-hover:text-brand-blue transition-colors">#CRZ-1022</span>
                                <p class="text-[10px] text-gray-400 mt-0.5">1 hour ago</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center text-xs font-bold text-gray-600">AH</div>
                                    <span class="font-semibold text-gray-800">Ahmad</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-black text-gray-900">Rp 1.250.000</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-green-50 text-green-600 border border-green-100 uppercase tracking-widest">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Completed
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 -translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                                    <button class="w-8 h-8 rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-brand-blue hover:border-brand-blue flex items-center justify-center transition-colors shadow-sm"><i class="ph ph-eye"></i></button>
                                </div>
                            </td>
                        </tr>

                        <!-- Interactive Row -->
                        <tr class="group hover:bg-brand-blue/5 transition-colors cursor-pointer">
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 group-hover:text-brand-blue transition-colors">#CRZ-1021</span>
                                <p class="text-[10px] text-gray-400 mt-0.5">3 hours ago</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center text-xs font-bold text-gray-600">JO</div>
                                    <span class="font-semibold text-gray-800">Johan</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-black text-gray-900">Rp 200.000</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-[10px] font-bold bg-blue-50 text-blue-600 border border-blue-100 uppercase tracking-widest">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Shipped
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 -translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-300">
                                    <button class="w-8 h-8 rounded-lg bg-white border border-gray-200 text-gray-500 hover:text-brand-blue hover:border-brand-blue flex items-center justify-center transition-colors shadow-sm"><i class="ph ph-eye"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Realtime Comments Widget -->
        <div class="bg-white/80 backdrop-blur-md rounded-2xl border border-gray-200/60 shadow-sm flex flex-col h-[480px]">
            <div class="p-6 border-b border-gray-200/60 flex justify-between items-center bg-white/50">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 tracking-tight flex items-center gap-2">
                        Live Feedback
                        <div class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                        </div>
                    </h3>
                </div>
            </div>
            
            <div class="p-4 space-y-4 flex-1 overflow-y-auto custom-scrollbar relative">
                
                <!-- Interactive Comment Item -->
                <div class="group relative p-4 rounded-xl border border-transparent hover:border-gray-200 hover:bg-gray-50/80 transition-all duration-300">
                    <div class="flex gap-4">
                        <div class="relative">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 border border-purple-200 flex-shrink-0 flex items-center justify-center text-purple-700 font-bold shadow-sm">RA</div>
                            <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-100">
                                <i class="ph-fill ph-instagram-logo text-[10px] text-pink-500"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="text-sm font-bold text-gray-900 group-hover:text-brand-blue transition-colors">Rika Amelia</h4>
                                <span class="text-[10px] font-bold text-gray-400 uppercase bg-gray-100 px-2 py-0.5 rounded">Just now</span>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed group-hover:text-gray-800 transition-colors">"Hoodie nya adem parah min, next order lagi yang warna putih! Bahannya beneran premium."</p>
                            
                            <!-- Hover Actions -->
                            <div class="h-0 opacity-0 overflow-hidden group-hover:h-8 group-hover:opacity-100 group-hover:mt-3 transition-all duration-300 flex gap-2">
                                <button class="text-xs font-bold text-green-700 bg-green-100 hover:bg-green-200 px-3 py-1.5 rounded-lg transition-colors shadow-sm flex items-center gap-1"><i class="ph ph-check-circle"></i> Approve</button>
                                <button class="text-xs font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 px-3 py-1.5 rounded-lg transition-colors shadow-sm flex items-center gap-1"><i class="ph ph-eye-slash"></i> Hide</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Interactive Comment Item -->
                <div class="group relative p-4 rounded-xl border border-transparent hover:border-gray-200 hover:bg-gray-50/80 transition-all duration-300">
                    <div class="flex gap-4">
                        <div class="relative">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-100 to-cyan-100 border border-blue-200 flex-shrink-0 flex items-center justify-center text-blue-700 font-bold shadow-sm">DM</div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="text-sm font-bold text-gray-900 group-hover:text-brand-blue transition-colors">Dimas</h4>
                                <span class="text-[10px] font-bold text-gray-400 uppercase bg-gray-100 px-2 py-0.5 rounded">5m ago</span>
                            </div>
                            <p class="text-sm text-gray-600 leading-relaxed group-hover:text-gray-800 transition-colors">"Bro, apakah size oversize XL varian navy ready? Mau checkout nih"</p>
                            
                            <!-- Hover Actions -->
                            <div class="h-0 opacity-0 overflow-hidden group-hover:h-8 group-hover:opacity-100 group-hover:mt-3 transition-all duration-300 flex gap-2">
                                <button class="text-xs font-bold text-white bg-brand-blue hover:bg-blue-700 px-3 py-1.5 rounded-lg transition-colors shadow-[0_0_10px_rgba(37,99,235,0.3)] flex items-center gap-1"><i class="ph ph-arrow-u-down-left"></i> Fast Reply</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="p-3 border-t border-gray-200/60 bg-gray-50/50 rounded-b-2xl">
                <a href="#" class="block text-center text-xs font-semibold text-brand-blue hover:text-blue-800 transition-colors">View All Feedback</a>
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
    @keyframes bounceShort {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-3px); }
    }
    .animate-bounce-short {
        animation: bounceShort 0.5s ease-in-out infinite;
    }
</style>
@endsection
