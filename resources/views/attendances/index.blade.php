<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Attendance Management</h2>
                <p class="text-slate-500 text-sm mt-1">Track and manage employee attendance records.</p>
            </div>

            <div class="flex items-center gap-3">
                <form method="GET" action="{{ route('attendances.index') }}" class="flex items-center gap-2">
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search by employee name..."
                           class="px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition w-64">
                    @if ($search ?? '')
                        <a href="{{ route('attendances.index') }}" class="text-xs text-slate-500 hover:text-slate-700 underline">Clear</a>
                    @endif
                </form>
                <button onclick="document.getElementById('addAttendanceForm').reset(); document.getElementById('attendanceModalTitle').textContent = 'Add Attendance'; document.getElementById('attendanceModalAction').action = '{{ route('attendances.store') }}'; document.getElementById('addAttendanceModal').style.display = 'flex'"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl shadow-lg shadow-indigo-500/25 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Attendance
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
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Employee</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Check In</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Check Out</th>
                        <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @forelse ($attendances as $attendance)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $attendance->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 text-xs font-medium">
                                        {{ strtoupper(substr($attendance->employee->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">{{ $attendance->employee->name }}</p>
                                        <p class="text-xs text-slate-500">{{ $attendance->employee->employee_code }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $attendance->attendance_date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $attendance->check_in ?? '<span class="text-slate-300">—</span>' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $attendance->check_out ?? '<span class="text-slate-300">—</span>' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold
                                    @if($attendance->status === 'Present') bg-green-50 text-green-700
                                    @elseif($attendance->status === 'Absent') bg-red-50 text-red-700
                                    @else bg-yellow-50 text-yellow-700 @endif">
                                    {{ $attendance->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <button onclick="openEditAttendanceModal({{ $attendance->id }}, {{ $attendance->employee_id }}, '{{ $attendance->attendance_date }}', '{{ $attendance->check_in ?? '' }}', '{{ $attendance->check_out ?? '' }}', '{{ $attendance->status }}')"
                                        class="text-indigo-600 hover:text-indigo-700 hover:underline font-medium">
                                    Edit
                                </button>
                                <button onclick="openDeleteAttendanceModal({{ $attendance->id }}, '{{ route('attendances.destroy', $attendance) }}')"
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-slate-900">No attendance records found</p>
                                    <p class="text-xs text-slate-500">Get started by adding your first attendance record.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $attendances->links() }}

    <!-- Attendance Modal -->
    <div id="addAttendanceModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeModal('addAttendanceModal')"></div>
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 transform transition-all duration-300">
            <div class="p-6 border-b border-slate-100">
                <div class="flex items-center justify-between">
                    <h3 id="attendanceModalTitle" class="text-lg font-bold text-slate-900">Add Attendance</h3>
                    <button onclick="closeModal('addAttendanceModal')" class="text-slate-400 hover:text-slate-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="p-6">
                <form id="addAttendanceForm" action="{{ route('attendances.store') }}" method="POST" x-on:submit.prevent="submitAttendanceForm">
                    @csrf
                    <input type="hidden" name="_id" id="editAttendanceId">

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Employee</label>
                            <select name="employee_id" id="editAttendanceEmployeeId"
                                    class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition"
                                    required>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" @selected(old('employee_id') == $employee->id)>
                                        {{ $employee->employee_code }} - {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Attendance Date</label>
                            <input type="date" name="attendance_date" id="editAttendanceDate"
                                   class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition"
                                   value="{{ old('attendance_date') }}" required>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Check In</label>
                            <input type="time" name="check_in" id="editCheckIn"
                                   class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition"
                                   value="{{ old('check_in') }}">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Check Out</label>
                            <input type="time" name="check_out" id="editCheckOut"
                                   class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition"
                                   value="{{ old('check_out') }}">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Status</label>
                            <select name="status" id="editAttendanceStatus"
                                    class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-slate-50 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition"
                                    required>
                                <option value="Present" @selected(old('status', 'Present') === 'Present')>Present</option>
                                <option value="Absent" @selected(old('status') === 'Absent')>Absent</option>
                                <option value="Late" @selected(old('status') === 'Late')>Late</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" onclick="closeModal('addAttendanceModal')"
                                class="px-4 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium transition">
                            Cancel
                        </button>
                        <button type="submit" id="attendanceModalAction"
                                class="px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-medium shadow-lg shadow-indigo-500/25 transition-all transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Save Attendance
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Attendance Modal -->
    <div id="deleteAttendanceModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" onclick="closeModal('deleteAttendanceModal')"></div>
        <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 transform transition-all duration-300">
            <div class="p-6 border-b border-slate-100">
                <h3 class="text-lg font-bold text-slate-900">Confirm Delete</h3>
            </div>
            <div class="p-6">
                <p class="text-slate-600 mb-6">Are you sure you want to delete this attendance record?</p>
                <form id="deleteAttendanceForm" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="_id" id="deleteAttendanceId">
                </form>
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeModal('deleteAttendanceModal')"
                            class="px-4 py-2.5 rounded-xl text-slate-600 hover:bg-slate-50 font-medium transition">
                        Cancel
                    </button>
                    <button type="button" id="confirmDeleteAttendanceBtn"
                            class="px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white font-medium transition">
                        Yes, Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openEditAttendanceModal(id, employeeId, date, checkIn, checkOut, status) {
            document.getElementById('editAttendanceId').value = id;
            document.getElementById('editAttendanceEmployeeId').value = employeeId;
            document.getElementById('editAttendanceDate').value = date;
            document.getElementById('editCheckIn').value = checkIn;
            document.getElementById('editCheckOut').value = checkOut;
            document.getElementById('editAttendanceStatus').value = status;
            document.getElementById('attendanceModalTitle').textContent = 'Edit Attendance';
            document.getElementById('addAttendanceForm').action = '{{ route('attendances.update', '__ID__') }}'.replace('__ID__', id);
            document.getElementById('addAttendanceForm').method = 'POST';

            const existingMethodInput = document.querySelector('#addAttendanceForm input[name="_method"]');
            if (existingMethodInput) existingMethodInput.remove();
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            document.getElementById('addAttendanceForm').appendChild(methodInput);

            const modal = document.getElementById('addAttendanceModal');
            if (modal) modal.style.display = 'flex';
        }

        function openDeleteAttendanceModal(id, url) {
            document.getElementById('deleteAttendanceId').value = id;
            document.getElementById('deleteAttendanceForm').action = url;
            const modal = document.getElementById('deleteAttendanceModal');
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
        const addAttendanceForm = document.getElementById('addAttendanceForm');
        if (addAttendanceForm) {
            addAttendanceForm.addEventListener('submit', function(e) {
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
                        closeModal('addAttendanceModal');
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
                        alert('An error occurred while saving attendance.');
                    }
                });
            });
        }

        // Delete via AJAX
        const confirmDeleteAttendanceBtn = document.getElementById('confirmDeleteAttendanceBtn');
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (confirmDeleteAttendanceBtn) {
            confirmDeleteAttendanceBtn.addEventListener('click', function() {
                const form = document.getElementById('deleteAttendanceForm');
                const formData = new FormData(form);

                const headers = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                };
                if (csrfToken) {
                    headers['X-CSRF-TOKEN'] = csrfToken.content;
                }

                closeModal('deleteAttendanceModal');

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
                    alert('An error occurred while deleting attendance.');
                });
            });
        }
    </script>
</x-app-layout>
