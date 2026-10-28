<nav x-data="{ sidebarOpen: false }"
     class="fixed left-0 top-0 h-screen w-64 bg-slate-900 text-slate-300 z-40 transform -translate-x-full transition-transform duration-300 ease-in-out md:relative md:translate-x-0 md:static md:z-auto md:w-64 md:text-slate-400 border-r border-slate-800">
    <!-- Sidebar Header / Logo -->
    <div class="flex items-center justify-between h-16 px-6 bg-slate-900 border-b border-slate-800 shrink-0">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg bg-indigo-500 flex items-center justify-center text-white shadow-lg shadow-indigo-500/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            <span class="font-bold text-lg tracking-tight text-white">AMS</span>
        </a>

        <!-- Mobile close button -->
        <button @click="sidebarOpen = false" class="md:hidden p-2 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 overflow-y-auto py-6 px-4 space-y-2">
        <div class="px-3 text-xs font-semibold uppercase tracking-wider text-slate-500 mb-4">
            Main Navigation
        </div>

        <a href="{{ route('dashboard') }}"
           class="{{ request()->routeIs('dashboard') ? 'bg-indigo-500/10 text-indigo-300' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800' }} flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition group"
           aria-current="{{ request()->routeIs('dashboard') ? 'page' : 'false' }}">
            <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center group-hover:bg-indigo-500/20 transition">
                <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-indigo-400' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
            </div>
            {{ __('Dashboard') }}
        </a>

        <a href="{{ route('employees.index') }}"
           class="{{ request()->routeIs('employees.*') ? 'bg-indigo-500/10 text-indigo-300' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800' }} flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition group"
           aria-current="{{ request()->routeIs('employees.*') ? 'page' : 'false' }}">
            <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center group-hover:bg-indigo-500/20 transition">
                <svg class="w-5 h-5 {{ request()->routeIs('employees.*') ? 'text-indigo-400' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
            {{ __('Employees') }}
        </a>

        <a href="{{ route('attendances.index') }}"
           class="{{ request()->routeIs('attendances.*') ? 'bg-indigo-500/10 text-indigo-300' : 'text-slate-400 hover:text-slate-200 hover:bg-slate-800' }} flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition group"
           aria-current="{{ request()->routeIs('attendances.*') ? 'page' : 'false' }}">
            <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center group-hover:bg-indigo-500/20 transition">
                <svg class="w-5 h-5 {{ request()->routeIs('attendances.*') ? 'text-indigo-400' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            {{ __('Attendance') }}
        </a>

        <div class="px-3 text-xs font-semibold uppercase tracking-wider text-slate-500 mb-4 mt-8">
            Account
        </div>

        <a href="{{ route('profile.edit') }}"
           class="text-slate-400 hover:text-slate-200 hover:bg-slate-800 flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition group">
            <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center group-hover:bg-indigo-500/20 transition">
                <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            {{ __('Profile') }}
        </a>
    </div>

    <!-- Sidebar Footer -->
    <div class="p-4 border-t border-slate-800 bg-slate-950/50">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-indigo-500/20 flex items-center justify-center text-indigo-400">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-medium text-slate-200 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>

        <div class="mt-4 pt-4 border-t border-slate-800">
            <button type="button"
                    onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"
                    class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-red-400 hover:bg-red-500/10 hover:text-red-300 rounded-xl transition group">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                {{ __('Log Out') }}
            </button>
            <form id="logoutForm" method="POST" action="{{ route('logout') }}" class="hidden">
                @csrf
            </form>
        </div>
    </div>
</nav>
