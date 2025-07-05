<?php

namespace App\Http\Controllers\Admin\Process;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Process\Candidate;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $step = $request->input('step', 1);
        return view('backend.pages.process.candidates.create', compact('step'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $step = $request->input('step', 1);
        $data = $request->except(['_token', 'step']);

        // dd('sssss', $data);

        // Save to session
        session()->put("form.step_$step", $data);

        if ($step < 7) {
            return redirect()->route('admin.candidates.create', ['step' => $step + 1]);
        } else {
            // Merge all steps
            $fullData = [];
            for ($i = 1; $i <= 7; $i++) {
                $fullData = array_merge($fullData, session()->get("form.step_$i", []));
            }

            // Dump the full data or save to DB
            dd('sadfasfdasfasdfas', $fullData);

            // Clear session if needed
            session()->forget('form');

            // return redirect()->route('home')->with('success', 'Form submitted!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
