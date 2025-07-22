<?php

namespace App\Http\Controllers\Supper_Admin\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Admin\HRM\Employee;
use App\Models\Supper_Admin\Payroll\FestivalBonus;
use App\Models\Supper_Admin\Payroll\SalaryGenerate;
use App\Models\Supper_Admin\Payroll\SalaryGenerateEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SalaryGenerateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = SalaryGenerate::get();
        return view('supper_admin.pages.payroll.salary-generate', compact('salaries'));
    }

    public function unpaidSalaryEmployees()
    {
        $employees = SalaryGenerateEmployee::with(['employee'])->where('is_paid', 'Not Yet')->get();
        return response()->json($employees);}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'month_year'      => 'required|string'
            ]);
            $employees = Employee::where('is_hold_salary', 0)
                ->where('status', 1)
                ->get();
            if (SalaryGenerate::where('month_year', $request->input('month_year'))->exists()) {
                return response()->json(['status' => 'error', 'message' => 'Salary already generated for this month.']);
            }
            $salary = SalaryGenerate::create([
                'month_year'      => $request->input('month_year'),
                'total_employee'      => $employees->count(),
                'total_employee_salary'      => $employees->sum('basic_salary_monthly'),
                'user_id'      => Auth::user()->id,
                'note'  => $request->input('note')
            ]);

            foreach ($employees as $employee) {
                SalaryGenerateEmployee::create([
                    'salary_generate_id'      => $salary->id,
                    'employee_id'      => $employee->id,
                    'month_year'      => $salary->month_year,
                    'employee_salary'      => $employee->basic_salary_monthly
                ]);
            }
            return response()->json(['status' => 'success', 'message' => 'Salary Generated Successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'fail', 'message' => $e->validator->errors()]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SalaryGenerate $salaryGenerate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalaryGenerate $salaryGenerate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalaryGenerate $salaryGenerate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $salaryGenerate = SalaryGenerate::findOrFail($id);
            if($salaryGenerate->salaryGenerateEmployees) {
                $salaryGenerate->salaryGenerateEmployees()->delete();
            }
            $salaryGenerate->delete();
            return response()->json(['status' => 'success', 'message' => 'Deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
