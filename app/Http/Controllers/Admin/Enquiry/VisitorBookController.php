<?php

namespace App\Http\Controllers\Admin\Enquiry;

use App\Http\Controllers\Controller;
use App\Models\Admin\Enquiry\VisitorBook;
use App\Models\Admin\Process\CandidateType;
use App\Models\FindUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VisitorBookController extends Controller
{
    public function index(Request $request)
    {
        $visitorBooks = VisitorBook::latest()->get();
        $candidateTypes = CandidateType::all();

        return view('backend.pages.enquiry.visitor_book', compact('visitorBooks', 'candidateTypes'));
    }

    public function show($id)
    {
        $visitorBook = VisitorBook::findOrFail($id);
        return response()->json($visitorBook);
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone'             => 'required|string',
            'full_name'         => 'nullable|string',
            'address'           => 'nullable|string',
            'candidate_type_id' => 'nullable|integer',
            'reference_type'    => 'nullable|string',
            'note'              => 'nullable|string',
            'how_find_us'       => 'nullable|string',
            'entry_time'        => 'nullable|string',
        ]);
        $visitorBook = VisitorBook::create([
            'phone'             => $request->phone,
            'full_name'         => $request->full_name,
            'address'           => $request->address,
            'candidate_type_id' => $request->candidate_type_id,
            'reference_type'    => $request->reference_type,
            'note'              => $request->note,
            'how_find_us'       => $request->how_find_us,
            'entry_time'        => $request->entry_time,
            'entry_by'          => Auth::id(),
        ]);
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Visitor record added successfully.', 'data' => $visitorBook]);
        }
        return redirect()->route('admin.visitor-books.index')->with('success', 'Visitor record added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'phone'             => 'required|string',
            'full_name'         => 'nullable|string',
            'address'           => 'nullable|string',
            'candidate_type_id' => 'nullable|integer',
            'reference_type'    => 'nullable|string',
            'note'              => 'nullable|string',
            'how_find_us'       => 'nullable|string',
            'entry_time'        => 'nullable|string',
        ]);
        $visitorBook = VisitorBook::findOrFail($id);
        $visitorBook->update($request->all());
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Visitor record updated successfully.', 'data' => $visitorBook]);
        }
        return redirect()->route('admin.visitor-books.index')->with('success', 'Visitor record updated successfully.');
    }

    public function destroy($id, Request $request)
    {
        VisitorBook::findOrFail($id)->delete();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['status' => 'success', 'message' => 'Visitor record deleted successfully.']);
        }
        return redirect()->route('admin.visitor-books.index')->with('success', 'Visitor record deleted successfully.');
    }
}
