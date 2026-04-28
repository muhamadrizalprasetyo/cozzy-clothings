<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>COZZY - Create Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="min-h-screen bg-slate-50 flex items-center justify-center p-4">
    <div class="w-full max-w-lg">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-slate-900 mb-2">COZZY</h1>
                <p class="text-slate-500 text-sm">Create your account</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm text-red-600">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Full Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required
                           class="w-full border-slate-200 rounded-lg px-4 py-2.5 focus:ring-slate-500 focus:border-slate-500" 
                           placeholder="John Doe" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required
                               class="w-full border-slate-200 rounded-lg px-4 py-2.5 focus:ring-slate-500 focus:border-slate-500" 
                               placeholder="you@example.com" />
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-slate-700 mb-1.5">WhatsApp</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}" required
                               class="w-full border-slate-200 rounded-lg px-4 py-2.5 focus:ring-slate-500 focus:border-slate-500" 
                               placeholder="08123456789" />
                    </div>
                </div>

                <div>
                    <label for="address" class="block text-sm font-medium text-slate-700 mb-1.5">Address</label>
                    <textarea id="address" name="address" rows="2" required
                              class="w-full border-slate-200 rounded-lg px-4 py-2.5 focus:ring-slate-500 focus:border-slate-500 resize-none" 
                              placeholder="Your full address">{{ old('address') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                        <input id="password" name="password" type="password" required
                               class="w-full border-slate-200 rounded-lg px-4 py-2.5 focus:ring-slate-500 focus:border-slate-500" 
                               placeholder="••••••••" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1.5">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="w-full border-slate-200 rounded-lg px-4 py-2.5 focus:ring-slate-500 focus:border-slate-500" 
                               placeholder="••••••••" />
                    </div>
                </div>

                <button type="submit" class="w-full py-2.5 px-4 bg-slate-900 text-white rounded-lg font-medium hover:bg-slate-800 transition-colors">
                    Create Account
                </button>
            </form>
            
            <!-- Footer -->
            <p class="text-center text-sm text-slate-500 mt-6">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-slate-900 font-medium hover:underline">Sign in</a>
            </p>
        </div>
        
        <!-- Back to Store -->
        <div class="text-center mt-6">
            <a href="{{ route('katalog') }}" class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-slate-900 transition-colors">
                <i class="ph ph-arrow-left"></i>
                Back to Store
            </a>
        </div>
    </div>
</body>
</html>