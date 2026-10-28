<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['employee_code', 'name', 'email', 'department', 'employment_status'])]
#[Hidden([])]
class Employee extends Model
{
    use HasFactory;

    /**
     * Get the attendance records for the employee.
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
