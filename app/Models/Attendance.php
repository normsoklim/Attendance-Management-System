<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['employee_id', 'attendance_date', 'check_in', 'check_out', 'status'])]
class Attendance extends Model
{
    /**
     * Get the employee that owns the attendance record.
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
