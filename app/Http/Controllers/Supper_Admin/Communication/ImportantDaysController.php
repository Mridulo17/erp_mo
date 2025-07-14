<?php

namespace App\Http\Controllers\Supper_Admin\Communication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supper_Admin\Communication\ImportantDays;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ImportantDaysController extends Controller
{
    public function index()
    {
        $importantDays = ImportantDays::get();
        return view('supper_admin.pages.communication.important_days', compact('importantDays'));
    }

    public function ActiveIndex(Request $request)
    {
        $importantDays = ImportantDays::where('status', 'Active')->get();
        return response()->json($importantDays);
    }

    public function create()
    {
        // return view('supper_admin.pages.communication.create_important_day');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'date' => 'required|date',
                'description' => 'nullable|string|max:1000',
                'status'      => 'required|in:Active,Inactive'
            ]);

            $user_id = Auth::id();

            ImportantDays::create([
                'name' => $request->input('name'),
                'date' => Carbon::parse($request->input('date')),
                'description' => $request->input('description'),
                'user_id' => $user_id,
                'status' => $request->input('status') === 'Active' ? 1 : 0,
            ]);

            return response()->json(['status' => 'success', 'message' => 'Important day added successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }
}
