<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-slate-500 text-sm mt-1">
                    Welcome back, {{ Auth::user()->name }}. Here's what's happening with your team today.
                </p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('attendances.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl shadow-lg shadow-indigo-500/25 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Quick Check-In
                </a>
            </div>
        </div>
    </x-slot>

    <!-- Welcome & Stats Header -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-6">
            <div class="flex-1">
                <h1 class="text-3xl font-bold text-slate-900 tracking-tight mb-1">Overview</h1>
                <p class="text-slate-500 text-sm">
                    Attendance summary for <span class="font-medium text-slate-700">{{ now()->format('F j, Y') }}</span>
                </p>
            </div>

            <div class="flex items-center gap-3 px-4 py-3 bg-white rounded-2xl border border-slate-200 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-lg">
                    {{ now()->format('j') }}
                </div>
                <div>
                    <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Today</p>
                    <p class="text-sm font-medium text-slate-900">{{ now()->format('l') }}</p>
                </div>
            </div>
        </div>

        <!-- Stat Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Employees -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition-all group">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Total Employees</p>
                            <h3 class="text-3xl font-bold text-slate-900 mt-1 tracking-tight">{{ $totalEmployees }}</h3>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <span class="flex items-center gap-1 text-green-600">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            +12% from last month
                        </span>
                    </div>
                </div>
            </div>

            <!-- Present Today -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition-all group">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Present Today</p>
                            <h3 class="text-3xl font-bold text-slate-900 mt-1 tracking-tight">{{ $presentToday }}</h3>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center text-green-600 group-hover:bg-green-600 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <span class="flex items-center gap-1 text-green-600">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            All clear
                        </span>
                    </div>
                </div>
            </div>

            <!-- Absent Today -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition-all group">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Absent Today</p>
                            <h3 class="text-3xl font-bold text-slate-900 mt-1 tracking-tight">{{ $absentToday }}</h3>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-600 group-hover:bg-red-600 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <span class="flex items-center gap-1 text-red-600">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            Needs attention
                        </span>
                    </div>
                </div>
            </div>

            <!-- Late Today -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden hover:shadow-md transition-all group">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Late Today</p>
                            <h3 class="text-3xl font-bold text-slate-900 mt-1 tracking-tight">{{ $lateToday }}</h3>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-yellow-50 flex items-center justify-center text-yellow-600 group-hover:bg-yellow-600 group-hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <span class="flex items-center gap-1 text-yellow-600">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            {{ $lateToday > 0 ? 'Review required' : 'On track' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Attendance Overview -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Quick Actions -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-6">
                            <div class="w-8 h-8 rounded-lg bg-indigo-100 flex items-center justify-center text-indigo-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900">Quick Actions</h3>
                        </div>

                        <div class="space-y-3">
                            <a href="{{ route('employees.index') }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-indigo-50 hover:text-indigo-600 text-slate-700 text-sm font-medium transition-all group border border-transparent hover:border-indigo-100">
                                <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <span>Manage Employees</span>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="{{ route('attendances.index') }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-indigo-50 hover:text-indigo-600 text-slate-700 text-sm font-medium transition-all group border border-transparent hover:border-indigo-100">
                                <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span>Attendance Records</span>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="{{ route('attendances.create') }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-indigo-50 hover:text-indigo-600 text-slate-700 text-sm font-medium transition-all group border border-transparent hover:border-indigo-100">
                                <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <span>Check In / Out</span>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="{{ route('profile.edit') }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-xl bg-slate-50 hover:bg-indigo-50 hover:text-indigo-600 text-slate-700 text-sm font-medium transition-all group border border-transparent hover:border-indigo-100">
                                <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <span>Profile Settings</span>
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Attendance Status Legend -->
                <div class="mt-6 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Attendance Status</h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <span class="w-3 h-3 rounded-full bg-green-500"></span>
                                <span class="text-sm text-slate-600">Present</span>
                                <span class="ml-auto text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded">{{ $presentToday }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                                <span class="text-sm text-slate-600">Absent</span>
                                <span class="ml-auto text-xs font-medium text-red-600 bg-red-50 px-2 py-1 rounded">{{ $absentToday }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                                <span class="text-sm text-slate-600">Late</span>
                                <span class="ml-auto text-xs font-medium text-yellow-600 bg-yellow-50 px-2 py-1 rounded">{{ $lateToday }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Attendance -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Recent Attendance</h3>
                                <p class="text-sm text-slate-500 mt-1">Latest check-ins and check-outs</p>
                            </div>
                            <a href="{{ route('attendances.index') }}"
                               class="text-sm font-medium text-indigo-600 hover:text-indigo-700 flex items-center gap-1 transition">
                                View All
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-slate-100">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Employee</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Check In</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Check Out</th>
                                    <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @forelse ($recentAttendances as $attendance)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 text-xs font-medium">
                                                    {{ strtoupper(substr($attendance->employee->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-slate-900">{{ $attendance->employee->name }}</p>
                                                    <p class="text-xs text-slate-400">{{ $attendance->employee->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                            {{ $attendance->attendance_date }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                            {{ $attendance->check_in ?? '<span class="text-slate-300">—</span>' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                            {{ $attendance->check_out ?? '<span class="text-slate-300">—</span>' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold
                                                @if($attendance->status === 'Present') bg-green-50 text-green-700
                                                @elseif($attendance->status === 'Absent') bg-red-50 text-red-700
                                                @else bg-yellow-50 text-yellow-700 @endif">
                                                {{ $attendance->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center gap-3">
                                                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h7a2 2 0 012 2v14a2 2 0 01-2 2z" />
                                                    </svg>
                                                </div>
                                                <p class="text-sm font-medium text-slate-900">No attendance records yet</p>
                                                <p class="text-xs text-slate-500">Start tracking your team's attendance today.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
