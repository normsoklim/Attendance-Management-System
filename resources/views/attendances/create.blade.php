<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --text-dark: #1f2937;
            --text-muted: #6b7280;
            --border: #e5e7eb;
        }

        body {
            background: #f3f4f6;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--text-dark);
        }

        .page-card {
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            background: #fff;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0 0 0.5rem 0;
            letter-spacing: -0.025em;
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 0.875rem;
            margin: 0;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            border-radius: 8px;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-secondary {
            border-radius: 8px;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 0.625rem 0.875rem;
            font-size: 0.875rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .alert {
            border: none;
            border-radius: 8px;
            padding: 1rem 1.25rem;
            font-size: 0.875rem;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-4" style="max-width: 700px">
    <div class="page-card">
        <div class="card-body p-4">
            <div class="d-flex align-items-center mb-4">
                <div class="flex-shrink-0">
                    <div class="inline-flex items-center justify-center w-10 h-10 rounded-lg bg-indigo-100 text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                </div>
                <div class="ms-3">
                    <h3 class="page-title">Add Attendance</h3>
                    <p class="page-subtitle">Record a new attendance entry</p>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('attendances.store') }}"
                  method="POST"
                  data-loading="Saving attendance...">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Employee</label>
                    <select name="employee_id" class="form-select" required>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}"
                                @selected(old('employee_id') == $employee->id)>
                                {{ $employee->employee_code }} - {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Attendance Date</label>
                    <input type="date" name="attendance_date"
                           class="form-control"
                           value="{{ old('attendance_date') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Check In</label>
                    <input type="time" name="check_in"
                           class="form-control"
                           value="{{ old('check_in') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Check Out</label>
                    <input type="time" name="check_out"
                           class="form-control"
                           value="{{ old('check_out') }}">
                </div>

                <div class="mb-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="Present"
                            @selected(old('status', 'Present') === 'Present')>
                            Present
                        </option>
                        <option value="Absent"
                            @selected(old('status') === 'Absent')>
                            Absent
                        </option>
                        <option value="Late"
                            @selected(old('status') === 'Late')>
                            Late
                        </option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">
                        Save Attendance
                    </button>
                    <a href="{{ route('attendances.index') }}"
                       class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('components.loading')

</body>
</html>
