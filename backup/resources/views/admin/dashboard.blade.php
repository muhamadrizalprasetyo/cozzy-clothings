@extends('layouts.admin')

@section('header', 'Dashboard Overview')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        <!-- Card 1 -->
        <div class="bg-cozzy-800 p-6 rounded-2xl border border-cozzy-700 shadow-lg hover:border-gray-500 transition-all duration-300 group cursor-default">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-400 text-sm font-medium">Total Revenue</h3>
                <div class="bg-cozzy-700/50 p-2 rounded-lg text-cozzy-accent group-hover:bg-cozzy-accent group-hover:text-cozzy-900 transition-colors">
                    <i class="ph ph-currency-dollar text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-cozzy-accent">Rp 24.5M</p>
            <p class="text-sm text-green-400 mt-2 flex items-center gap-1">
                <i class="ph ph-trend-up"></i> +12.5% from last month
            </p>
        </div>

        <!-- Card 2 -->
        <div class="bg-cozzy-800 p-6 rounded-2xl border border-cozzy-700 shadow-lg hover:border-gray-500 transition-all duration-300 group cursor-default">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-400 text-sm font-medium">Guest Orders</h3>
                <div class="bg-cozzy-700/50 p-2 rounded-lg text-cozzy-accent group-hover:bg-cozzy-accent group-hover:text-cozzy-900 transition-colors">
                    <i class="ph ph-shopping-bag text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-cozzy-accent">152</p>
            <p class="text-sm text-green-400 mt-2 flex items-center gap-1">
                <i class="ph ph-trend-up"></i> +8.2% from last month
            </p>
        </div>

        <!-- Card 3 -->
        <div class="bg-cozzy-800 p-6 rounded-2xl border border-cozzy-700 shadow-lg hover:border-gray-500 transition-all duration-300 group cursor-default">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-400 text-sm font-medium">Products Live</h3>
                <div class="bg-cozzy-700/50 p-2 rounded-lg text-cozzy-accent group-hover:bg-cozzy-accent group-hover:text-cozzy-900 transition-colors">
                    <i class="ph ph-t-shirt text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-cozzy-accent">48</p>
            <p class="text-sm text-gray-500 mt-2 flex items-center gap-1">
                <i class="ph ph-minus"></i> Stable
            </p>
        </div>

        <!-- Card 4 -->
        <div class="bg-cozzy-800 p-6 rounded-2xl border border-cozzy-700 shadow-lg hover:border-gray-500 transition-all duration-300 group cursor-default">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-400 text-sm font-medium">New Comments</h3>
                <div class="bg-cozzy-700/50 p-2 rounded-lg text-cozzy-accent group-hover:bg-cozzy-accent group-hover:text-cozzy-900 transition-colors">
                    <i class="ph ph-chat-circle-dots text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-cozzy-accent">24</p>
            <p class="text-sm text-yellow-500 mt-2 flex items-center gap-1">
                <i class="ph ph-warning-circle"></i> 5 requires moderation
            </p>
        </div>
    </div>

    <!-- Main Grids -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Order Table -->
        <div class="lg:col-span-2 bg-cozzy-800 rounded-2xl border border-cozzy-700 shadow-lg overflow-hidden flex flex-col">
            <div class="p-6 border-b border-cozzy-700 flex justify-between items-center bg-cozzy-800/50">
                <h3 class="text-lg font-semibold text-cozzy-accent">Recent Guest Orders</h3>
                <button class="text-sm font-medium text-gray-400 hover:text-cozzy-accent transition">View All</button>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-cozzy-900/30 text-gray-400 text-xs uppercase tracking-wider border-b border-cozzy-700">
                            <th class="px-6 py-4 font-medium">Order ID</th>
                            <th class="px-6 py-4 font-medium">Guest Name</th>
                            <th class="px-6 py-4 font-medium">Total Amount</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium">Date</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-cozzy-700">
                        <!-- Sample Row -->
                        <tr class="hover:bg-cozzy-700/20 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="text-cozzy-accent font-medium group-hover:underline cursor-pointer">#ORD-1023</span>
                            </td>
                            <td class="px-6 py-4 text-gray-300">Rizal</td>
                            <td class="px-6 py-4 text-gray-300 font-medium tracking-wide">Rp 450.000</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-yellow-500/10 text-yellow-500 border border-yellow-500/20 text-xs font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span> Pending
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">2 mins ago</td>
                        </tr>
                        <!-- Sample Row -->
                        <tr class="hover:bg-cozzy-700/20 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="text-cozzy-accent font-medium group-hover:underline cursor-pointer">#ORD-1022</span>
                            </td>
                            <td class="px-6 py-4 text-gray-300">Ahmad</td>
                            <td class="px-6 py-4 text-gray-300 font-medium tracking-wide">Rp 1.250.000</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-green-500/10 text-green-500 border border-green-500/20 text-xs font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Completed
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">1 hour ago</td>
                        </tr>
                        <!-- Sample Row -->
                        <tr class="hover:bg-cozzy-700/20 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="text-cozzy-accent font-medium group-hover:underline cursor-pointer">#ORD-1021</span>
                            </td>
                            <td class="px-6 py-4 text-gray-300">Johan</td>
                            <td class="px-6 py-4 text-gray-300 font-medium tracking-wide">Rp 200.000</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-blue-500/10 text-blue-500 border border-blue-500/20 text-xs font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Shipped
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">3 hours ago</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Realtime Comments -->
        <div class="bg-cozzy-800 rounded-2xl border border-cozzy-700 shadow-lg flex flex-col h-[400px]">
            <div class="p-6 border-b border-cozzy-700 flex justify-between items-center bg-cozzy-800/50">
                <h3 class="text-lg font-semibold text-cozzy-accent flex items-center gap-2">
                    Live Comments
                    <span class="relative flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                </h3>
            </div>
            
            <div class="p-6 space-y-6 flex-1 overflow-y-auto custom-scrollbar">
                <!-- Comment 1 -->
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-600 to-gray-800 flex-shrink-0 flex items-center justify-center text-cozzy-accent text-sm font-bold shadow-inner">RA</div>
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <h4 class="text-cozzy-accent text-sm font-medium">Rika Amelia</h4>
                            <span class="text-[10px] text-gray-500 uppercase tracking-wider">Just now</span>
                        </div>
                        <p class="text-sm text-gray-400 leading-relaxed mb-2">"Bahannya adem banget min, next order lagi yang warna hitam."</p>
                        <div class="flex gap-2">
                            <button class="text-xs text-green-400 hover:text-green-300 transition">Approve</button>
                            <span class="text-gray-600">•</span>
                            <button class="text-xs text-red-400 hover:text-red-300 transition">Hide</button>
                        </div>
                    </div>
                </div>
                
                <!-- Comment 2 -->
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-600 to-gray-800 flex-shrink-0 flex items-center justify-center text-cozzy-accent text-sm font-bold shadow-inner">D</div>
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <h4 class="text-cozzy-accent text-sm font-medium">Dimas</h4>
                            <span class="text-[10px] text-gray-500 uppercase tracking-wider">5 mins ago</span>
                        </div>
                        <p class="text-sm text-gray-400 leading-relaxed mb-2">"Apakah ukuran XL masih tersedia untuk seri Cozzy Basic ini?"</p>
                        <div class="flex gap-2">
                            <button class="text-xs text-cozzy-accent hover:text-gray-300 transition">Reply</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
