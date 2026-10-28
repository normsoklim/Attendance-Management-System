<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Attendance System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .input-field:focus {
            ring: 2px;
            ring-color: #3b82f6;
            border-color: #3b82f6;
            outline: none;
        }
        .btn-primary:active {
            transform: translateY(1px);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-50 px-4 py-8 antialiased text-gray-900">
    <div class="max-w-md w-full">
        <!-- Brand / Header -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-white/20 backdrop-blur-md mb-4 border border-white/30 shadow-lg">
                <svg class="w-8 h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-black tracking-tight">Welcome Back</h1>
            <p class="mt-2 text-indigo-400 text-sm">Sign in to your attendance account</p>
        </div>

        <!-- Auth Card -->
        <div class="glass-card rounded-3xl p-8 sm:p-10 relative overflow-hidden">
            <!-- Decorative accent -->
            <div class="absolute top-0 left-0 w-full h-1 bg-indigo-600"></div>

            @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-100 text-red-700 text-sm shadow-sm">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <div class="ml-3">
                            <ul class="list-disc pl-4 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST" data-loading="Logging in...">
                @csrf

                <div class="space-y-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email Address</label>
                        <input id="email" name="email" type="email" required autofocus
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 sm:text-sm">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                        <input id="password" name="password" type="password" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-900 placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 sm:text-sm">
                    </div>

                    <button type="submit"
                            class="w-full flex items-center justify-center px-4 py-3.5 text-base font-semibold text-white bg-indigo-600 border border-transparent rounded-xl hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 active:scale-[0.98] transition-all duration-200 shadow-lg shadow-indigo-500/30">
                        Sign In
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-200/50">
                <p class="text-center text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500 transition-colors">
                        Create an account
                    </a>
                </p>
            </div>
        </div>
    </div>

    @include('components.loading')
</body>
</html>
