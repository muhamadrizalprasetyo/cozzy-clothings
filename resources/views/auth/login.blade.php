<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>COZZY - Sign In</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="min-h-screen bg-slate-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-slate-900 mb-2">COZZY</h1>
                <p class="text-slate-500 text-sm">Sign in to your account</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    @foreach ($errors->all() as $error)
                        <p class="text-sm text-red-600">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                           class="w-full border-slate-200 rounded-lg px-4 py-2.5 focus:ring-slate-500 focus:border-slate-500 transition-colors" 
                           placeholder="you@example.com" />
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1.5">Password</label>
                    <input id="password" name="password" type="password" required
                           class="w-full border-slate-200 rounded-lg px-4 py-2.5 focus:ring-slate-500 focus:border-slate-500 transition-colors" 
                           placeholder="Enter your password" />
                </div>
                
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="h-4 w-4 text-slate-900 focus:ring-slate-500 border-slate-300 rounded">
                        <span class="ml-2 text-slate-600">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-slate-600 hover:text-slate-900" href="{{ route('password.request') }}">Forgot password?</a>
                    @endif
                </div>
                
                <button type="submit" class="w-full py-2.5 px-4 bg-slate-900 text-white rounded-lg font-medium hover:bg-slate-800 transition-colors">
                    Sign In
                </button>
            </form>
            
            <!-- Footer -->
            <p class="text-center text-sm text-slate-500 mt-6">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-slate-900 font-medium hover:underline">Create one</a>
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