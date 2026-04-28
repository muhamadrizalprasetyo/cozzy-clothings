<div>
    @if(Auth::check() && $count > 0)
        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white min-w-[20px] text-center leading-none">
            {{ $count }}
        </span>
    @endif
</div>