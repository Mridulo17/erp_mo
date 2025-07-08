<?php

namespace App\Http\Controllers\Admin\People;

use App\Http\Controllers\Controller;
use App\Models\Admin\HRM\Employee;
use App\Models\Admin\People\Investor;
use App\Models\Supper_Admin\Location\Country;
use App\Models\Supper_Admin\Location\District;
use App\Models\Supper_Admin\Location\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class InvestorController extends Controller
{
    public function index()
    {
        $countries = Country::select('id', 'name')->get();
        $districts = District::select('id', 'name')->get();
        $divisions = Division::select('id', 'name')->get();
        $employees = Employee::select('id', 'first_name', 'last_name')->get();
        $investors = Investor::latest()->paginate(20);
        return view('backend.pages.people.investor', compact('investors','countries','districts','divisions','employees'));
    }

    public function show($id)
    {
        $investor = Investor::findOrFail($id);
        return response()->json($investor);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'cell_no' => 'required|string',
            'email' => 'required|email|unique:investors,email',
            'password' => 'required|string|min:6',
            'investor_photo' => 'nullable|file|image',
            'nid_scan_copy' => 'nullable|file',
            'agreement_scan_copy' => 'nullable|file',
            'attachment' => 'nullable',
            'country_id' => 'nullable|integer',
            'division_id' => 'nullable|integer',
            'district_id' => 'nullable|integer',
            'employee_id' => 'nullable|integer',
            'current_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'note' => 'nullable|string',
            'status' => 'boolean',
        ]);
        $data['password'] = Hash::make($data['password']);
        // Handle file uploads
        foreach(['investor_photo','nid_scan_copy','agreement_scan_copy'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $data[$fileField] = $request->file($fileField)->store('investors/'.$fileField, 'public');
            }
        }
        // Handle multiple attachments
        if ($request->hasFile('attachment')) {
            $attachments = [];
            foreach ($request->file('attachment') as $file) {
                $attachments[] = $file->store('investors/attachments', 'public');
            }
            $data['attachment'] = $attachments;
        }
        $investor = Investor::create($data);
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Investor added successfully.', 'data' => $investor]);
        }
        return redirect()->route('admin.investors.index')->with('success', 'Investor added successfully.');
    }

    public function update(Request $request, $id)
    {
        $investor = Investor::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string',
            'cell_no' => 'required|string',
            'email' => 'required|email|unique:investors,email,'.$id,
            'password' => 'nullable|string|min:6',
            'investor_photo' => 'nullable|file|image',
            'nid_scan_copy' => 'nullable|file',
            'agreement_scan_copy' => 'nullable|file',
            'attachment' => 'nullable',
            'country_id' => 'nullable|integer',
            'division_id' => 'nullable|integer',
            'district_id' => 'nullable|integer',
            'employee_id' => 'nullable|integer',
            'current_address' => 'nullable|string',
            'permanent_address' => 'nullable|string',
            'note' => 'nullable|string',
            'status' => 'boolean',
        ]);
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        foreach(['investor_photo','nid_scan_copy','agreement_scan_copy'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $data[$fileField] = $request->file($fileField)->store('investors/'.$fileField, 'public');
            }
        }
        if ($request->hasFile('attachment')) {
            $attachments = [];
            foreach ($request->file('attachment') as $file) {
                $attachments[] = $file->store('investors/attachments', 'public');
            }
            $data['attachment'] = $attachments;
        }
        $investor->update($data);
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Investor updated successfully.', 'data' => $investor]);
        }
        return redirect()->route('admin.investors.index')->with('success', 'Investor updated successfully.');
    }

    public function destroy($id, Request $request)
    {
        $investor = Investor::findOrFail($id);
        $investor->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Investor deleted successfully.']);
        }
        return redirect()->route('admin.investors.index')->with('success', 'Investor deleted successfully.');
    }
} 