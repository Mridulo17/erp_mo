<?php

namespace App\Http\Controllers\Admin\Enquiry;

use App\Http\Controllers\Controller;
use App\Models\Admin\Process\CandidateType;
use App\Models\FindUs;
use App\Models\Admin\Enquiry\PhoneCall;
use App\Models\Supper_Admin\Location\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PhoneCallController extends Controller
{
    public function index()
    {
        $phoneCalls = PhoneCall::with('country', 'candidateType')->latest()->get();
        $countries = Country::all();
        $candidateTypes = CandidateType::all();
        return view('backend.pages.enquiry.phone_call', compact('phoneCalls', 'countries', 'candidateTypes'));
    }

    public function show($id)
    {
        $phoneCall = PhoneCall::findOrFail($id);
        return response()->json($phoneCall);
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone'             => 'required',
            'full_name'         => 'nullable|string',
            'email'             => 'nullable|email',
            'country_id'        => 'nullable|integer',
            'candidate_type_id' => 'nullable|integer',
            'note'              => 'nullable|string',
            'followup_date'     => 'nullable|date',
            'how_find_us'       => 'nullable|string',
        ]);

        $phoneCall = PhoneCall::create($request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Phone call record saved successfully.', 'data' => $phoneCall]);
        }

        return redirect()->route('admin.phone-calls.index')->with('success', 'Phone call record saved successfully.');
    }

    public function update(Request $request, PhoneCall $phone_call)
    {
        $request->validate([
            'phone'             => 'required',
            'full_name'         => 'nullable|string',
            'email'             => 'nullable|email',
            'country_id'        => 'nullable|integer',
            'candidate_type_id' => 'nullable|integer',
            'note'              => 'nullable|string',
            'followup_date'     => 'nullable|date',
            'how_find_us'       => 'nullable|string',
        ]);

        $phone_call->update($request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Phone call record updated successfully.', 'data' => $phone_call]);
        }

        return redirect()->route('admin.phone-calls.index')->with('success', 'Phone call record updated successfully.');
    }

    public function destroy(PhoneCall $phone_call, Request $request)
    {
        $phone_call->delete();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Phone call record deleted successfully.']);
        }

        return redirect()->route('admin.phone-calls.index')->with('success', 'Phone call record deleted successfully.');
    }
}
