<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Employee Management</h2>
                <p class="text-slate-500 text-sm mt-1">Manage your team members and their employment details.</p>
            </div>

            <div class="flex items-center gap-3">
                <form method="GET" action="{{ route('employees.index') }}" class="flex items-center gap-2">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by name..."
                           class="px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition w-64">
                    @if ($search ?? '')
                        <a href="{{ route('employees.index') }}" class="text-xs text-slate-500 hover:text-slate-700 underline">Clear</a>
                    @endif
                </form>
                <button onclick="document.getElementById('addEmployeeForm').reset(); document.getElementById('employeeModalTitle').textContent = 'Add Employee'; document.getElementById('employeeModalAction').action = '{{ route('employees.store') }}'; document.getElementById('addEmployeeModal').style.display = 'flex'"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl shadow-lg shadow-indigo-500/25 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Employee
                </button>
            </div>
        </div>
    </x-slot>

    @if (session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-100 text-green-800 text-sm flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Employee Code</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Department</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @forelse ($employees as $employee)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $employee->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $employee->employee_code }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 text-xs font-medium">
                                        {{ strtoupper(substr($employee->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">{{ $employee->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $employee->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $employee->department }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold
                                    @if($employee->employment_status === 'Active') bg-green-50 text-green-700
                                    @elseif($employee->employment_status === 'Inactive') bg-red-50 text-red-700
                                    @else bg-yellow-50 text-yellow-700 @endif">
                                    {{ $employee->employment_status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <button onclick="openEditEmployeeModal({{ $employee->id }}, '{{ $employee->employee_code }}', '{{ $employee->name }}', '{{ $employee->email }}', '{{ $employee->department }}', '{{ $employee->employment_status }}')"
                                        class="text-indigo-600 hover:text-indigo-700 hover:underline font-medium">
                                    Edit
                                </button>
                                <button onclick="openDeleteEmployeeModal({{ $employee->id }}, '{{ route('employees.destroy', $employee) }}')"
                                        class="ml-3 text-red-600 hover:text-red-700 hover:underline font-medium">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-slate-900">No employees found</p>
                                    <p class="text-xs text-slate-500">Get started by adding your first employee.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $employees->links() }}

    <!-- Employee Modal -->
    <div id="addEmployeeModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeModal('addEmployeeModal')"></div>
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 transform transition-all duration-300">
            <div class="p-6 border-b border-slate-100">
                <div class="flex items-center justify-between">
                    <h3 id="employeeModalTitle" class="text-lg font-bold text-slate-900">Add Employee</h3>
                    <button onclick="closeModal('addEmployeeModal')" class="text-slate-400 hover:text-slate-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <form id="addEmployeeForm" action="{{ route('employees.store') }}" method="POST" x-on:submit.prevent="submitEmployeeForm">
                    @csrf
                    <input type="hidden" name="_id" id="editEmployeeId">

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Employee Code</label>
                            <input type="text" name="employee_code" id="employeeCode"
                                   class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition"
                                   value="{{ old('employee_code') }}" required>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Name</label>
                            <input type="text" name="name" id="employeeName"
                                   class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition"
                                   value="{{ old('name') }}" required>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Email</label>
                            <input type="email" name="email" id="employeeEmail"
                                   class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition"
                                   value="{{ old('email') }}" required>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Department</label>
                            <input type="text" name="department" id="employeeDepartment"
                                   class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition"
                                   value="{{ old('department') }}" required>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Employment Status</label>
                            <select name="employment_status" id="employeeEmploymentStatus"
                                    class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition">
                                <option value="Active" @selected(old('employment_status', 'Active') === 'Active')>Active</option>
                                <option value="Inactive" @selected(old('employment_status') === 'Inactive')>Inactive</option>
                                <option value="On Leave" @selected(old('employment_status') === 'On Leave')>On Leave</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" onclick="closeModal('addEmployeeModal')"
                                class="px-4 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium transition">
                            Cancel
                        </button>
                        <button type="submit" id="employeeModalAction"
                                class="px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium shadow-lg shadow-indigo-500/25 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Save Employee
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Employee Modal -->
    <div id="deleteEmployeeModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeModal('deleteEmployeeModal')"></div>
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 transform transition-all duration-300">
            <div class="p-6 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900">Confirm Delete</h3>
            </div>
            <div class="p-6">
                <p class="text-slate-600 mb-6">Are you sure you want to delete this employee?</p>
                <form id="deleteEmployeeForm" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="_id" id="deleteEmployeeId">
                </form>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal('deleteEmployeeModal')"
                            class="px-4 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-medium transition">
                        Cancel
                    </button>
                    <button type="button" id="confirmDeleteEmployeeBtn"
                            class="px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-medium transition">
                        Yes, Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openEditEmployeeModal(id, code, name, email, department, status) {
            document.getElementById('editEmployeeId').value = id;
            document.getElementById('employeeCode').value = code;
            document.getElementById('employeeName').value = name;
            document.getElementById('employeeEmail').value = email;
            document.getElementById('employeeDepartment').value = department;
            document.getElementById('employeeEmploymentStatus').value = status;
            document.getElementById('employeeModalTitle').textContent = 'Edit Employee';
            document.getElementById('addEmployeeForm').action = '{{ route('employees.update', '__ID__') }}'.replace('__ID__', id);
            document.getElementById('addEmployeeForm').method = 'POST';
            // Add method spoofing for PUT
            const existingMethodInput = document.querySelector('input[name="_method"]');
            if (existingMethodInput) existingMethodInput.remove();
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            document.getElementById('addEmployeeForm').appendChild(methodInput);

            const modalEl = document.getElementById('addEmployeeModal');
            if (modalEl) modalEl.style.display = 'flex';
        }

        function openDeleteEmployeeModal(id, url) {
            document.getElementById('deleteEmployeeId').value = id;
            document.getElementById('deleteEmployeeForm').action = url;
            const modal = document.getElementById('deleteEmployeeModal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.style.display = 'flex';
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                modal.style.display = '';
            }
        }

        // AJAX form submission
        const addEmployeeForm = document.getElementById('addEmployeeForm');
        if (addEmployeeForm) {
            addEmployeeForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const form = this;
                const formData = new FormData(form);

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errData => { throw errData; });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        closeModal('addEmployeeModal');
                        form.reset();
                        location.reload();
                    }
                })
                .catch(error => {
                    if (error.errors) {
                        Object.keys(error.errors).forEach(field => {
                            const input = form.querySelector('[name="' + field + '"]');
                            if (input) {
                                input.classList.add('border-red-500', 'focus:ring-red-500');
                                input.classList.remove('focus:ring-indigo-500');
                                const feedback = document.createElement('div');
                                feedback.className = 'text-red-500 text-xs mt-1';
                                feedback.textContent = error.errors[field][0];
                                input.parentNode.appendChild(feedback);
                            }
                        });
                    } else {
                        alert('An error occurred while saving employee.');
                    }
                });
            });
        }

        // Delete via AJAX
        const confirmDeleteEmployeeBtn = document.getElementById('confirmDeleteEmployeeBtn');
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (confirmDeleteEmployeeBtn) {
            confirmDeleteEmployeeBtn.addEventListener('click', function() {
                const form = document.getElementById('deleteEmployeeForm');
                const formData = new FormData(form);

                const headers = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                };
                if (csrfToken) {
                    headers['X-CSRF-TOKEN'] = csrfToken.content;
                }

                closeModal('deleteEmployeeModal');

                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: headers
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errData => { throw errData; });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                })
                .catch(error => {
                    alert('An error occurred while deleting employee.');
                });
            });
        }
    </script>
</x-app-layout>
