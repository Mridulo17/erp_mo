<?php

namespace App\Http\Controllers\Supper_Admin\Expense;

use App\Http\Controllers\Controller;
use App\Models\Supper_Admin\Payroll\Expense\ExpenseCategory;
use App\Models\Supper_Admin\Payroll\Expense\ExpenseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ExpenseItemController extends Controller
{
    public function index()
    {
        $expenseItems = ExpenseItem::get();
        return view('supper_admin.expense.expense-item', compact('expenseItems'));
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
            ExpenseItem::create([
                'code'      => $request->input('code'),
                'name'      => $request->input('name'),
                'user_id'   => $user_id,
                'status'    => $request->input('status')
            ]);
            return response()->json(['status' => 'success', 'message' => 'Expense item added Successfully']);
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
        $expenseItem = ExpenseItem::findOrFail($id);
        return response()->json($expenseItem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $expenseItem = ExpenseItem::findOrFail($id);
            $expenseItem->name = $request->name;
            $expenseItem->code = $request->code;
            $expenseItem->status = $request->status ? 'Active' : 'Inactive';

            $expenseItem->save();

            return response()->json(['status' => 'success', 'message' => 'Expense item updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'fail', 'message' => $e->validator->errors()]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $expenseItem = ExpenseItem::findOrFail($id);
            $expenseItem->delete();
            return response()->json(['status' => 'success', 'message' => 'Expense item deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
