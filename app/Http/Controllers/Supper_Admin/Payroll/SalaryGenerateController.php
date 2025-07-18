<?php

namespace App\Http\Controllers\Supper_Admin\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Supper_Admin\Payroll\FestivalBonus;
use App\Models\Supper_Admin\Payroll\SalaryGenerate;
use Illuminate\Http\Request;

class SalaryGenerateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $festivalBonuses = FestivalBonus::get();
        return view('supper_admin.pages.payroll.salary-generate', compact('festivalBonuses'));
    }

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
        //
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
    public function destroy(SalaryGenerate $salaryGenerate)
    {
        //
    }
}
