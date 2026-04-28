<div>
    @if (session()->has('message'))
        <div class="mb-6 bg-green-100 text-green-800 px-4 py-3 rounded-xl text-sm font-bold border border-green-200">
            <i class="ph ph-check-circle mr-2"></i>{{ session('message') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm mb-8">
        <h4 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-4">Leave a Review</h4>
        <form wire:submit.prevent="submitComment" class="space-y-4">
            @guest
            <div>
                <input type="text" wire:model="guest_name" placeholder="Your Name" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-colors">
                @error('guest_name') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>
            @else
            <div class="flex items-center gap-2 mb-2 p-3 bg-blue-50 rounded-xl text-blue-800 text-xs font-bold">
                <i class="ph ph-user-circle text-lg"></i> Commenting as {{ auth()->user()->name }}
            </div>
            @endguest
            
            <div>
                <textarea wire:model="content" rows="3" placeholder="What do you think about this product?" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 transition-colors"></textarea>
                @error('content') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl transition-all shadow-md shadow-blue-600/20 text-sm">
                Submit Review
            </button>
        </form>
    </div>

    <!-- Approved Comments List -->
    <div class="space-y-4">
        @forelse($comments as $comment)
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-blue-100 to-purple-100 flex items-center justify-center text-blue-700 font-bold text-xs uppercase">
                        {{ substr($comment->user->name ?? $comment->guest_name, 0, 2) }}
                    </div>
                    <div>
                        <h5 class="text-sm font-bold text-gray-900">{{ $comment->user->name ?? $comment->guest_name }}</h5>
                        <p class="text-[10px] text-gray-400 font-semibold uppercase">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <p class="text-gray-600 text-sm leading-relaxed ml-11">"{{ $comment->content }}"</p>
            </div>
        @empty
            <div class="text-center py-8">
                <i class="ph text-4xl text-gray-300 ph-chat-teardrop mb-3"></i>
                <p class="text-gray-500 text-sm font-medium">No reviews yet. Be the first to share your thoughts!</p>
            </div>
        @endforelse
    </div>
</div>
