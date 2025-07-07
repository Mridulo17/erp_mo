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
        $visitorBooks = VisitorBook::latest()->paginate(20);
        $candidateTypes = CandidateType::all();

        return view('backend.pages.enquiry.visitor_book.index', compact('visitorBooks', 'candidateTypes'));
    }

    public function create()
    {
        $candidateTypes = CandidateType::all();
        return view('backend.pages.enquiry.visitor_book.create', compact('candidateTypes'));
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
        Log::info("storing");
        VisitorBook::create([
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

        return redirect()->route('admin.visitor-books.index')->with('success', 'Visitor record added successfully.');
    }

    public function edit($id)
    {
        $visitorBook = VisitorBook::findOrFail($id);
        $candidateTypes = CandidateType::all();

        return view('backend.pages.enquiry.visitor_book.edit', compact('visitorBook', 'candidateTypes'));
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

        return redirect()->route('admin.visitor-books.index')->with('success', 'Visitor record updated successfully.');
    }

    public function destroy($id)
    {
        VisitorBook::findOrFail($id)->delete();
        return redirect()->route('admin.visitor-books.index')->with('success', 'Visitor record deleted successfully.');
    }
}
