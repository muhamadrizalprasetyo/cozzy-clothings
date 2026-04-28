@extends('layouts.admin')

@section('header', 'System Settings')

@section('content')
<div class="space-y-8 animate-fade-in pb-10">
    <div class="max-w-2xl bg-cozzy-800 rounded-2xl border border-cozzy-700 shadow-xl p-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-cozzy-accent/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        
        <h2 class="text-xl font-bold tracking-tight text-white border-l-4 border-cozzy-accent pl-3 mb-8 uppercase">General Configuration</h2>
        
        @if(session('success'))
        <div class="bg-green-500/10 border border-green-500/20 text-green-500 px-4 py-3 rounded-xl shadow-sm text-sm font-bold flex items-center gap-2 mb-6">
            <i class="ph ph-check-circle text-lg"></i> {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6 relative z-10">
            @csrf
            @method('PATCH')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest">Shop Name</label>
                    <input type="text" name="shop_name" value="{{ $admin->shop_name }}" class="w-full bg-cozzy-900 border border-cozzy-700 text-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-cozzy-accent transition-colors" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest">WhatsApp Contact</label>
                    <input type="text" name="contact_wa" value="{{ $admin->contact_wa }}" class="w-full bg-cozzy-900 border border-cozzy-700 text-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-cozzy-accent transition-colors" required>
                </div>
            </div>

            <div class="pt-4 border-t border-cozzy-700"></div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest">Admin Name</label>
                    <input type="text" name="name" value="{{ $admin->name }}" class="w-full bg-cozzy-900 border border-cozzy-700 text-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-cozzy-accent transition-colors" required>
                </div>
                <div class="space-y-2">
                    <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest">Admin Email</label>
                    <input type="email" name="email" value="{{ $admin->email }}" class="w-full bg-cozzy-900 border border-cozzy-700 text-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-cozzy-accent transition-colors" required>
                </div>
            </div>

            <div class="space-y-2">
                <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest">New Password</label>
                <input type="password" name="password" placeholder="Leave blank to keep current" class="w-full bg-cozzy-900 border border-cozzy-700 text-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-cozzy-accent transition-colors">
            </div>

            <div class="pt-6 flex justify-end">
                <button type="submit" class="bg-cozzy-accent hover:bg-white text-cozzy-900 font-black uppercase tracking-widest py-3 px-10 rounded-xl transition-all shadow-lg active:scale-95 text-xs">
                    Save Configuration
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
