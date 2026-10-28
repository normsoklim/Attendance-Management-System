<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $employees = Employee::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->latest()->paginate(10)->appends(request()->only('search'));

        return view('employees.index', compact('employees', 'search'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_code' => 'required|string|max:20|unique:employees',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees',
            'department' => 'required|string|max:255',
            'employment_status' => 'required|in:Active,Inactive,On Leave',
        ]);

        Employee::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Employee created successfully!',
            ], 201);
        }

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee created successfully!');
    }

    public function edit(Request $request, Employee $employee)
    {
        if ($request->expectsJson()) {
            return response()->json($employee);
        }

        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'employee_code' => 'required|string|max:20|unique:employees,employee_code,' . $employee->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:employees,email,' . $employee->id,
            'department' => 'required|string|max:255',
            'employment_status' => 'required|in:Active,Inactive,On Leave',
        ]);

        $employee->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Employee updated successfully!',
            ]);
        }

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee updated successfully!');
    }

    public function destroy(Request $request, Employee $employee)
    {
        $employee->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Employee deleted successfully!',
            ]);
        }

        return redirect()
            ->route('employees.index')
            ->with('success', 'Employee deleted successfully!');
    }
}
