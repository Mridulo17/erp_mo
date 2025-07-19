<?php

namespace App\Http\Controllers\Supper_Admin\Communication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supper_Admin\Communication\ImportantDaysTemplate;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\Auth;

class ImportantTemplateController extends Controller
{
    public function index()
    {
        $importantTemplates = ImportantDaysTemplate::with('importantDay')->get();
        return view('supper_admin.pages.communication.important_templates', compact('importantTemplates'));
    }

    public function ActiveIndex(Request $request)
    {
        $importantTemplates = ImportantDaysTemplate::where('status', 'Active')->with('importantDay')->get();
        return response()->json($importantTemplates);
    }

    public function create()
    {
        // return view('supper_admin.pages.communication.create_important_template');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'important_days_id' => 'required|exists:important_days,id',
                'message_template' => 'required|string|max:1000',
                'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
                'status' => 'in:Active,Inactive'
            ]);

            $user_id = Auth::id();

            $data = [
                'important_days_id' => $request->input('important_days_id'),
                'message_template' => $request->input('message_template'),
                'status' => $request->input('status') === 'Active' ? 'Active' : 'Inactive',
                'user_id' => $user_id,
            ];

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $filePath = $file->store('attachments', 'public');
                $data['attachment'] = $filePath;
            }

            ImportantDaysTemplate::create($data);

            return response()->json(['status' => 'success', 'message' => 'Important template added successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }

    public function edit(string $id)
    {
        $importantTemplate = ImportantDaysTemplate::findOrFail($id);
        return response()->json($importantTemplate);
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'important_days_id' => 'required|exists:important_days,id',
                'message_template' => 'required|string|max:1000',
                'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
                'status' => 'in:Active,Inactive'
            ]);

            $importantTemplate = ImportantDaysTemplate::findOrFail($id);
            $importantTemplate->important_days_id = $request->input('important_days_id');
            $importantTemplate->message_template = $request->input('message_template');
            $importantTemplate->status = $request->input('status') === 'Active' ? 'Active' : 'Inactive';
            $importantTemplate->user_id = Auth::id();

            if ($request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $filePath = $file->store('attachments', 'public');
                $importantTemplate->attachment = $filePath;
            }

            $importantTemplate->save();

            return response()->json(['status' => 'success', 'message' => 'Important template updated successfully']);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
        }
    }

    public function destroy(string $id)
    {
        try {
            $importantTemplate = ImportantDaysTemplate::findOrFail($id);
            $importantTemplate->delete();
            return response()->json(['status' => 'success', 'message' => 'Important template deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
