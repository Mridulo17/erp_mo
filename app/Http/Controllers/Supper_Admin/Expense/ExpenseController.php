<?php

namespace App\Http\Controllers\Supper_Admin\Expense;

use App\Http\Controllers\Controller;
use App\Models\Supper_Admin\Payroll\Expense\Expense;
use App\Models\Supper_Admin\Payroll\Expense\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::get();
        return view('supper_admin.expense.expense-category', compact('expenses'));
    }

    public function Activeindex()
    {
        $expenses = Expense::where('status', 'Active')->get();
        return response()->json($expenses);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'code'      => 'required|string|max:255',
                'name'      => 'required|string|max:255',
                'status'    => 'required|in:Active,Inactive'
            ]);

            $user_id = Auth::id();
            Expense::create([
                'code'      => $request->input('code'),
                'name'      => $request->input('name'),
                'user_id'   => $user_id,
                'status'    => $request->input('status')
            ]);
            return response()->json(['status' => 'success', 'message' => 'Expense added Successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'fail', 'message' => $e->validator->errors()]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = Expense::findOrFail($id);
        return response()->json($expense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $expense = Expense::findOrFail($id);
        $expense->name = $request->name;
        $expense->code = $request->code;
        $expense->status = $request->status ? 'Active' : 'Inactive';

        $expense->save();

        return response()->json(['status' => 'success', 'message' => 'Expense updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $expense = Expense::findOrFail($id);
            $expense->delete();
            return response()->json(['status' => 'success', 'message' => 'Expense deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
