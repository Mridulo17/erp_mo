<?php

namespace App\Http\Controllers\Admin\Enquiry;

use App\Http\Controllers\Controller;
use App\Models\Admin\Enquiry\InterviewedCandidate;
use Illuminate\Http\Request;

class InterviewedCandidateController extends Controller
{
    public function index()
    {
        $candidates = InterviewedCandidate::latest()->get();
        return view('backend.pages.enquiry.interviewed_candidate', compact('candidates'));
    }

    public function show($id)
    {
        $candidate = InterviewedCandidate::findOrFail($id);
        return response()->json($candidate);
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'full_name' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'note' => 'nullable|string',
        ]);
        $candidate = InterviewedCandidate::create($request->all());
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Interviewed candidate saved successfully.', 'data' => $candidate]);
        }
        return redirect()->route('admin.interviewed-candidates.index')->with('success', 'Interviewed candidate saved successfully.');
    }

    public function update(Request $request, InterviewedCandidate $interviewed_candidate)
    {
        $request->validate([
            'phone' => 'required',
            'full_name' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'note' => 'nullable|string',
        ]);
        $interviewed_candidate->update($request->all());
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Interviewed candidate updated successfully.', 'data' => $interviewed_candidate]);
        }
        return redirect()->route('admin.interviewed-candidates.index')->with('success', 'Interviewed candidate updated successfully.');
    }

    public function destroy(InterviewedCandidate $interviewed_candidate, Request $request)
    {
        $interviewed_candidate->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Interviewed candidate deleted successfully.']);
        }
        return redirect()->route('admin.interviewed-candidates.index')->with('success', 'Interviewed candidate deleted successfully.');
    }
} 