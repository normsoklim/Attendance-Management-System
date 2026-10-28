<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Attendant Management System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-900 bg-slate-50">
        <div class="min-h-screen flex">
            @include('layouts.navigation')

            <!-- Main Content -->
            <div class="flex-1 flex flex-col min-w-0">
                <!-- Top Header -->
                <header class="sticky top-0 z-20 bg-white/80 backdrop-blur-md border-b border-slate-200">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between h-16">
                            <div class="flex items-center gap-3">
                                <button
                                    @click="sidebarOpen = !sidebarOpen"
                                    class="md:hidden p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition"
                                    aria-label="Toggle sidebar"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    </svg>
                                </button>
                                <h1 class="text-sm font-semibold text-slate-900">
                                    @isset($header)
                                        {{ $header }}
                                    @else
                                        Dashboard
                                    @endif
                                </h1>
                            </div>

                            <div class="flex items-center gap-4">
                                <div class="hidden md:flex items-center gap-2 text-sm">
                                    <span class="text-slate-500">{{ now()->format('l, F j, Y') }}</span>
                                    <span class="w-1 h-1 rounded-full bg-green-500 animate-pulse"></span>
                                    <span class="text-slate-600 font-medium">System Online</span>
                                </div>

                                <div class="relative inline-block">
                                    <button @click="userMenuOpen = !userMenuOpen"
                                            class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-slate-700 hover:text-slate-900 hover:bg-slate-50 rounded-lg transition focus:outline-none">
                                        <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-xs">
                                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                        </div>
                                        <div>{{ Auth::user()->name }}</div>
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <div x-show="userMenuOpen" x-on:click.away="userMenuOpen = false"
                                         class="absolute right-0 mt-2 w-48 origin-top-right rounded-md bg-white shadow-xl ring-1 ring-slate-900/5 border border-slate-200 focus:outline-none"
                                         x-data="{ userMenuOpen: false }"
                                         @click.away="userMenuOpen = false">
                                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                                            <a href="{{ route('profile.edit') }}"
                                               class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600 transition"
                                               role="menuitem">
                                                {{ __('Profile') }}
                                            </a>

                                            <form id="logoutForm" method="POST" action="{{ route('logout') }}" class="hidden">
                                                @csrf
                                            </form>

                                            <button type="button"
                                                    onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                                                    class="block w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-red-600 transition"
                                                    role="menuitem">
                                                {{ __('Log Out') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="flex-1">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                        {{ $slot }}
                    </div>
                </main>

                <!-- Footer -->
                <footer class="border-t border-slate-200 bg-white py-4 mt-auto">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <p class="text-xs text-slate-500 text-center">
                            &copy; {{ now()->year }} {{ config('app.name', 'Attendant Management System') }}. All rights reserved.
                        </p>
                    </div>
                </footer>
            </div>

            <!-- Sidebar Overlay (Mobile) -->
            <div x-show="sidebarOpen" x-on:click="sidebarOpen = false"
                 class="fixed inset-0 z-30 bg-slate-900/50 backdrop-blur-sm md:hidden"
                 x-data="{ sidebarOpen: false }"></div>
        </div>
    </body>
</html>
