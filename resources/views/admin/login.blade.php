<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - Cozzy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        cozzy: {
                            900: '#0f0f11',
                            800: '#18181b',
                            700: '#27272a',
                            accent: '#ffffff',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-cozzy-900 text-gray-200 font-sans antialiased min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-8">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold tracking-widest text-cozzy-accent uppercase mb-2">Cozzy.</h1>
            <p class="text-gray-500">Admin Panel Login</p>
        </div>

        <div class="bg-cozzy-800 border border-cozzy-700 rounded-2xl p-8 shadow-2xl">
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-400 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full px-4 py-3 bg-cozzy-900 border border-cozzy-700 rounded-xl text-cozzy-accent focus:outline-none focus:border-white transition">
                    @error('email')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-400 mb-2">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-3 bg-cozzy-900 border border-cozzy-700 rounded-xl text-cozzy-accent focus:outline-none focus:border-white transition">
                    @error('password')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6 flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 bg-cozzy-900 border-cozzy-700 rounded">
                    <label for="remember" class="ml-2 text-sm text-gray-400">Remember me</label>
                </div>

                <button type="submit" class="w-full py-3 bg-white text-cozzy-900 font-semibold rounded-xl hover:bg-gray-200 transition">
                    Login
                </button>
            </form>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('katalog') }}" class="text-sm text-gray-500 hover:text-cozzy-accent transition">
                ← Back to Store
            </a>
        </div>
    </div>
</body>
</html>