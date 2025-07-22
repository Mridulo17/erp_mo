<?php

namespace App\Models\Supper_Admin\Payroll;

use App\Models\Admin\HRM\Employee;
use Illuminate\Database\Eloquent\Model;

class SalaryGenerateEmployee extends Model
{
    protected $fillable =
        [
            'salary_generate_id',
            'employee_id',
            'month_year',
            'employee_salary',
            'is_paid',
            'payment_method',
            'attachment',
            'transaction_note',
            'note'
        ];

    public function salaryGenerate()
    {
        return $this->belongsTo(SalaryGenerate::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
