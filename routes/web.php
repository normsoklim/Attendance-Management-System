<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', function () {
        $totalEmployees = \App\Models\Employee::count();
        $today = now()->toDateString();
        $presentToday = \App\Models\Attendance::where('attendance_date', $today)->where('status', 'Present')->count();
        $absentToday = \App\Models\Attendance::where('attendance_date', $today)->where('status', 'Absent')->count();
        $lateToday = \App\Models\Attendance::where('attendance_date', $today)->where('status', 'Late')->count();
        $recentAttendances = \App\Models\Attendance::with('employee')->latest('attendance_date')->limit(10)->get();

        return view('dashboard', compact(
            'totalEmployees',
            'presentToday',
            'absentToday',
            'lateToday',
            'recentAttendances'
        ));
    })->name('dashboard');

    Route::resource('attendances', AttendanceController::class)
        ->except(['show']);

    Route::resource('employees', EmployeeController::class)
        ->except(['show']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
