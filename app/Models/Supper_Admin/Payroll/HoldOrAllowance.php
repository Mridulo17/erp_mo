<?php

namespace App\Models\Supper_Admin\Payroll;

use App\Models\Admin\HRM\Employee;
use App\Models\Admin\MyOffice\Department;
use Illuminate\Database\Eloquent\Model;

class HoldOrAllowance extends Model
{
    protected $fillable =
        [
            'department_id',
            'employee_id',
            'is_hold_salary',
            'is_hold_mobile_bill',
            'is_hold_accommodation',
            'is_hold_white_list'
        ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
