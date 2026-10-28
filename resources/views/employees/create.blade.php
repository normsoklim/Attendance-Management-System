<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Employee</title>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <div class="ms-3">
                    <h3 class="page-title">Add Employee</h3>
                    <p class="page-subtitle">Create a new employee profile</p>
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

            <form action="{{ route('employees.store') }}"
                  method="POST"
                  data-loading="Saving employee...">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Employee Code</label>
                    <input type="text" name="employee_code"
                           class="form-control"
                           value="{{ old('employee_code') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name"
                           class="form-control"
                           value="{{ old('name') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email"
                           class="form-control"
                           value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Department</label>
                    <input type="text" name="department"
                           class="form-control"
                           value="{{ old('department') }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Employment Status</label>
                    <select name="employment_status" class="form-select" required>
                        <option value="Active"
                            @selected(old('employment_status', 'Active') === 'Active')>
                            Active
                        </option>
                        <option value="Inactive"
                            @selected(old('employment_status') === 'Inactive')>
                            Inactive
                        </option>
                        <option value="On Leave"
                            @selected(old('employment_status') === 'On Leave')>
                            On Leave
                        </option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">
                        Save Employee
                    </button>
                    <a href="{{ route('employees.index') }}"
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
