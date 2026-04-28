@extends('layouts.admin')

@section('header', 'Comments & Feedback')

@section('content')
<div class="space-y-8 animate-fade-in pb-10" x-data="{ checkApprove: function(id, btn) { 
    fetch(`/admin/comment/${id}/approve`, {
        method: 'PATCH', headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }, body: JSON.stringify({})
    }).then(()=> {
        btn.outerHTML = '<span class=\'inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[10px] font-bold bg-green-500/10 text-green-500 border border-green-500/20 uppercase tracking-widest\'>Approved</span>';
    })
 } }">
    <div class="bg-cozzy-800 rounded-2xl border border-cozzy-700 shadow-xl p-6">
        <h2 class="text-xl font-bold tracking-tight text-white border-l-4 border-cozzy-accent pl-3 mb-6 uppercase">Customer Feedback</h2>
        
        @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-500 px-4 py-3 rounded-xl shadow-sm text-sm font-bold flex items-center gap-2 mb-4">
            <i class="ph ph-check-circle text-lg"></i> {{ session('success') }}
        </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse whitespace-nowrap">
                <thead>
                    <tr class="bg-cozzy-900/50 text-gray-400 text-[10px] font-bold uppercase tracking-widest border-b border-cozzy-700">
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Product</th>
                        <th class="px-6 py-4">Comment</th>
                        <th class="px-6 py-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm divide-y divide-cozzy-700">
                    @forelse ($comments as $comment)
                    <tr class="hover:bg-white/5 transition-colors group">
                        <td class="px-6 py-4">
                            <p class="font-bold text-white">{{ $comment->user->name ?? $comment->guest_name }}</p>
                            <p class="text-[11px] text-gray-500 font-medium">{{ $comment->created_at->diffForHumans() }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-400">{{ $comment->product->name ?? 'Deleted Product' }}</p>
                        </td>
                        <td class="px-6 py-4 max-w-sm whitespace-normal">
                            <p class="text-gray-300 text-xs italic">"{{ $comment->content }}"</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                @if($comment->is_approved)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-[10px] font-bold bg-green-500/10 text-green-500 border border-green-500/20 uppercase tracking-widest">Approved</span>
                                @else
                                    <button @click="checkApprove({{ $comment->id }}, $event.target)" class="bg-cozzy-accent hover:bg-gray-200 text-cozzy-900 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest transition-colors active:scale-95">Approve</button>
                                @endif
                                
                                <form action="{{ route('admin.comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Hapus komentar ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500/10 text-red-500 hover:bg-red-500/20 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest transition-colors active:scale-95">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center py-10 text-gray-500 italic font-bold">No feedback found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($comments->hasPages())
        <div class="mt-8">
            {{ $comments->links() }}
        </div>
        @endif
    </div>
</div>
<!-- Load AlpineJS -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
