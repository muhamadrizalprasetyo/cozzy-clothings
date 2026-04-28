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
            <p class="text-3xl font-bold text-cozzy-accent">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-sm text-green-400 mt-2 flex items-center gap-1">
                <i class="ph ph-trend-up"></i> Updated just now
            </p>
        </div>

        <!-- Card 2 -->
        <div class="bg-cozzy-800 p-6 rounded-2xl border border-cozzy-700 shadow-lg hover:border-gray-500 transition-all duration-300 group cursor-default">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-400 text-sm font-medium">Total Orders</h3>
                <div class="bg-cozzy-700/50 p-2 rounded-lg text-cozzy-accent group-hover:bg-cozzy-accent group-hover:text-cozzy-900 transition-colors">
                    <i class="ph ph-shopping-bag text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-cozzy-accent">{{ $totalOrdersCount }}</p>
            <p class="text-sm text-green-400 mt-2 flex items-center gap-1">
                <i class="ph ph-trend-up"></i> Across all status
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
            <p class="text-3xl font-bold text-cozzy-accent">{{ $productsLiveCount }}</p>
            <p class="text-sm text-gray-500 mt-2 flex items-center gap-1">
                <i class="ph ph-minus"></i> Active in catalog
            </p>
        </div>

        <!-- Card 4 -->
        <div class="bg-cozzy-800 p-6 rounded-2xl border border-cozzy-700 shadow-lg hover:border-gray-500 transition-all duration-300 group cursor-default">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-gray-400 text-sm font-medium">New Feedbacks</h3>
                <div class="bg-cozzy-700/50 p-2 rounded-lg text-cozzy-accent group-hover:bg-cozzy-accent group-hover:text-cozzy-900 transition-colors">
                    <i class="ph ph-chat-circle-dots text-xl"></i>
                </div>
            </div>
            <p class="text-3xl font-bold text-cozzy-accent">{{ $pendingFeedbackCount }}</p>
            <p class="text-sm text-yellow-500 mt-2 flex items-center gap-1">
                <i class="ph ph-warning-circle"></i> Requires moderation
            </p>
        </div>
    </div>

    <!-- Main Grids -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Order Table -->
        <div class="lg:col-span-2 bg-cozzy-800 rounded-2xl border border-cozzy-700 shadow-lg overflow-hidden flex flex-col">
            <div class="p-6 border-b border-cozzy-700 flex justify-between items-center bg-cozzy-800/50">
                <h3 class="text-lg font-semibold text-cozzy-accent">Recent Orders</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-gray-400 hover:text-cozzy-accent transition">View All</a>
            </div>
            <div class="overflow-x-auto flex-1">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-cozzy-900/30 text-gray-400 text-xs uppercase tracking-wider border-b border-cozzy-700">
                            <th class="px-6 py-4 font-medium">Order Number</th>
                            <th class="px-6 py-4 font-medium">Customer</th>
                            <th class="px-6 py-4 font-medium">Total</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium">Date</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-cozzy-700">
                        @foreach($recentTransactions as $order)
                        <tr class="hover:bg-cozzy-700/20 transition-colors group">
                            <td class="px-6 py-4">
                                <span class="text-cozzy-accent font-medium group-hover:underline cursor-pointer">#{{ $order->order_number }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-300">{{ $order->user->name ?? $order->guest_name }}</td>
                            <td class="px-6 py-4 text-gray-300 font-medium tracking-wide">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium 
                                    {{ $order->status === 'Completed' ? 'bg-green-500/10 text-green-500 border-green-500/20' : 
                                       ($order->status === 'Pending' ? 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' : 'bg-blue-500/10 text-blue-500 border-blue-500/20') }}">
                                    <span class="w-1.5 h-1.5 rounded-full 
                                        {{ $order->status === 'Completed' ? 'bg-green-500' : 
                                           ($order->status === 'Pending' ? 'bg-yellow-500' : 'bg-blue-500') }}"></span> 
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $order->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Realtime Comments -->
        <div class="bg-cozzy-800 rounded-2xl border border-cozzy-700 shadow-lg flex flex-col h-[400px]">
            <div class="p-6 border-b border-cozzy-700 flex justify-between items-center bg-cozzy-800/50">
                <h3 class="text-lg font-semibold text-cozzy-accent flex items-center gap-2">
                    Recent Feedback
                    <span class="relative flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                </h3>
            </div>
            
            <div class="p-6 space-y-6 flex-1 overflow-y-auto custom-scrollbar">
                @forelse($liveFeedbacks as $comment)
                <div class="flex gap-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-600 to-gray-800 flex-shrink-0 flex items-center justify-center text-cozzy-accent text-sm font-bold shadow-inner">
                        {{ strtoupper(substr($comment->user->name ?? $comment->guest_name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <h4 class="text-cozzy-accent text-sm font-medium">{{ $comment->user->name ?? $comment->guest_name }}</h4>
                            <span class="text-[10px] text-gray-500 uppercase tracking-wider">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-gray-400 leading-relaxed mb-2 line-clamp-2">"{{ $comment->content }}"</p>
                        <div class="flex gap-2">
                            <form action="{{ route('admin.comment.approve', $comment->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-xs text-green-400 hover:text-green-300 transition">Approve</button>
                            </form>
                            <span class="text-gray-600">•</span>
                            <form action="{{ route('admin.comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Hapus komentar?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-400 hover:text-red-300 transition">Hide</button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-sm text-center py-10">No new feedback.</p>
                @endforelse
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
