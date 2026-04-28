@extends('layouts.admin')

@section('header', 'Orders Management')

@section('content')
<div class="space-y-8 animate-fade-in pb-10">
    <div class="bg-cozzy-800 rounded-2xl border border-cozzy-700 shadow-xl p-6 relative overflow-hidden">
        <div class="flex justify-between items-center mb-6 border-l-4 border-cozzy-accent pl-3">
            <h2 class="text-xl font-bold tracking-tight text-white uppercase">Orders Management</h2>
        </div>
        
        @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-500 px-4 py-3 rounded-xl shadow-sm text-sm font-bold flex items-center gap-2 mb-4">
            <i class="ph ph-check-circle text-lg"></i> {{ session('success') }}
        </div>
        @endif

        <form id="bulk-update-form" action="{{ route('admin.orders.bulkUpdate') }}" method="POST">
            @csrf
            
            <!-- Bulk Action Toolbar -->
            <div id="bulk-toolbar" class="hidden mb-6 p-4 bg-white/5 border border-white/10 rounded-2xl flex flex-wrap items-center gap-4 animate-slide-up">
                <span class="text-sm font-bold text-cozzy-accent"><span id="selected-count">0</span> Selected</span>
                
                <select name="status" id="bulk-status" class="bg-cozzy-900 border-cozzy-700 text-gray-300 rounded-xl px-4 py-2 text-sm font-bold focus:ring-cozzy-accent">
                    <option value="">Update Status...</option>
                    <option value="Packing">Packing</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Completed">Completed</option>
                </select>

                <div id="shipping-fields" class="hidden flex gap-2">
                    <input type="text" name="courier" placeholder="Courier" class="bg-cozzy-900 border-cozzy-700 text-gray-300 rounded-xl px-4 py-2 text-sm font-bold w-32">
                    <input type="text" name="tracking_number" placeholder="Tracking #" class="bg-cozzy-900 border-cozzy-700 text-gray-300 rounded-xl px-4 py-2 text-sm font-bold w-48">
                </div>

                <button type="submit" class="bg-cozzy-accent hover:bg-gray-200 text-cozzy-900 px-6 py-2 rounded-xl text-sm font-bold transition-all shadow-md active:scale-95">
                    Apply Action
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse whitespace-nowrap">
                    <thead>
                        <tr class="bg-cozzy-900/50 text-gray-400 text-[10px] font-bold uppercase tracking-widest border-b border-cozzy-700">
                            <th class="px-6 py-4 w-10">
                                <input type="checkbox" id="select-all" class="rounded bg-cozzy-900 border-cozzy-700 text-cozzy-accent focus:ring-cozzy-accent">
                            </th>
                            <th class="px-6 py-4">Order Details</th>
                            <th class="px-6 py-4">Customer</th>
                            <th class="px-6 py-4">Total Amount</th>
                            <th class="px-6 py-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-cozzy-700">
                        @forelse ($orders as $order)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <td class="px-6 py-4">
                                <input type="checkbox" name="order_ids[]" value="{{ $order->id }}" class="order-checkbox rounded bg-cozzy-900 border-cozzy-700 text-cozzy-accent focus:ring-cozzy-accent">
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-white group-hover:text-cozzy-accent transition-colors">#{{ $order->order_number }}</p>
                                <p class="text-[11px] text-gray-500 font-medium">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-300">{{ $order->user->name ?? $order->guest_name }}</p>
                                <p class="text-[11px] text-gray-500 font-medium max-w-[200px] truncate">
                                    {{ $order->user->email ?? $order->guest_email }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-black text-cozzy-accent tracking-tighter">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-wider 
                                    {{ $order->status == 'Completed' ? 'bg-green-500/10 text-green-500 border border-green-500/20' : 
                                       ($order->status == 'Paid' ? 'bg-indigo-500/10 text-indigo-500 border border-indigo-500/20' : 
                                       ($order->status == 'Pending' ? 'bg-orange-500/10 text-orange-500 border border-orange-500/20' : 'bg-blue-500/10 text-blue-500 border border-blue-500/20')) }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-10 text-gray-500 font-bold italic">No orders found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>

        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('.order-checkbox');
        const toolbar = document.getElementById('bulk-toolbar');
        const selectedCount = document.getElementById('selected-count');
        const bulkStatus = document.getElementById('bulk-status');
        const shippingFields = document.getElementById('shipping-fields');

        function updateToolbar() {
            const checkedCount = document.querySelectorAll('.order-checkbox:checked').length;
            selectedCount.textContent = checkedCount;
            if (checkedCount > 0) {
                toolbar.classList.remove('hidden');
                toolbar.classList.add('flex');
            } else {
                toolbar.classList.add('hidden');
                toolbar.classList.remove('flex');
            }
        }

        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateToolbar();
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateToolbar);
        });

        bulkStatus.addEventListener('change', function() {
            if (this.value === 'Shipped') {
                shippingFields.classList.remove('hidden');
                shippingFields.classList.add('flex');
            } else {
                shippingFields.classList.add('hidden');
                shippingFields.classList.remove('flex');
            }
        });
    });
</script>
@endsection
