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
        $phoneCalls = PhoneCall::with('country', 'candidateType')->latest()->paginate(20);
        return view('backend.pages.enquiry.phone_call.index', compact('phoneCalls'));
    }

    public function create()
    {
        $countries = Country::all();
        $candidateTypes = CandidateType::all();
        return view('backend.pages.enquiry.phone_call.create', compact('countries', 'candidateTypes'));
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

        PhoneCall::create($request->all());
        
        return redirect()->route('admin.phone-calls.index')->with('success', 'Phone call record saved successfully.');
    }

    public function edit(PhoneCall $phoneCall)
    {
        $countries = Country::all();
        $candidateTypes = CandidateType::all();
        return view('backend.pages.enquiry.phone_call.edit', compact('phoneCall', 'countries', 'candidateTypes'));
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

        return redirect()->route('admin.phone-calls.index')->with('success', 'Phone call record updated successfully.');
    }

    public function destroy(PhoneCall $phone_call)
    {
        $phone_call->delete();
        return redirect()->route('admin.phone-calls.index')->with('success', 'Phone call record deleted successfully.');
    }
}
