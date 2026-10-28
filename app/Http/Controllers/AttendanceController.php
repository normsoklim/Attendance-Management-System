<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $attendances = Attendance::with('employee')
            ->when($search, function ($query, $search) {
                return $query->whereHas('employee', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                });
            })
            ->latest('attendance_date')
            ->paginate(10)
            ->appends(request()->only('search'));
        $employees = Employee::latest()->get();

        return view('attendances.index', compact('attendances', 'employees', 'search'));
    }

    public function create()
    {
        $employees = Employee::latest()->get();

        return view('attendances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'attendance_date' => 'required|date',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
            'status' => 'required|in:Present,Absent,Late',
        ]);

        Attendance::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Attendance created successfully!',
            ], 201);
        }

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance created successfully!');
    }

    public function edit(Request $request, Attendance $attendance)
    {
        $employees = Employee::latest()->get();

        if ($request->expectsJson()) {
            return response()->json($attendance);
        }

        return view('attendances.edit', compact('attendance', 'employees'));
    }

    public function update(
        Request $request,
        Attendance $attendance
    ) {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'attendance_date' => 'required|date',
            'check_in' => 'nullable|date_format:H:i',
            'check_out' => 'nullable|date_format:H:i',
            'status' => 'required|in:Present,Absent,Late',
        ]);

        $attendance->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Attendance updated successfully!',
            ]);
        }

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance updated successfully!');
    }

    public function destroy(Request $request, Attendance $attendance)
    {
        $attendance->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Attendance deleted successfully!',
            ]);
        }

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance deleted successfully!');
    }
}
