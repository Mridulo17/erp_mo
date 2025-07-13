<?php

namespace App\Http\Controllers\Supper_Admin\Attendance_Leave;

use App\Http\Controllers\Controller;
use App\Models\Supper_Admin\Attendance_Leave\Attendance;
use App\Models\Supper_Admin\Attendance_Leave\Leave;
use App\Models\Supper_Admin\Attendance_Leave\LeaveDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LeaveController extends Controller
{
    public function index()
    {
        $leaves = Leave::get();
        return view('supper_admin.pages.attendanceAndLeave.leave', compact('leaves'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'department_id'      => 'required|integer',
                'employee_id'      => 'required|integer',
                'leave_type'    => 'required|in:Half Day Leave,Full Day Leave',
                'no_of_days'      => 'required'
            ]);
            $attachmentPath = null;

            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment')->store('leaves', 'public');
            }
            $leave = Leave::create([
                'department_id'      => $request->input('department_id'),
                'employee_id'      => $request->input('employee_id'),
                'leave_type'      => $request->input('leave_type'),
                'no_of_days'      => $request->input('no_of_days'),
                'shift'      => $request->input('shift'),
                'attachment'         => $attachmentPath,
                'note'  => $request->input('note')
            ]);
            if($request->input('leave_date')) {
                [$start, $end] = explode('→', $request->leave_date);

                $startDate = Carbon::createFromFormat('Y-m-d', trim($start));
                $endDate = Carbon::createFromFormat('Y-m-d', trim($end));

                $allDates = collect();
                for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                    $allDates->push($date->format('Y-m-d'));
                }

                foreach ($allDates as $singleDate) {
                    LeaveDate::create([
                        'leave_id' => $leave->id, // or any logic
                        'leave_date' => $singleDate
                    ]);
                }
            }
            return response()->json(['status' => 'success', 'message' => 'Attendance added Successfully']);
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
        $attendance = Attendance::findOrFail($id);
        return response()->json($attendance);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'department_id'      => 'required|integer',
                'employee_id'      => 'required|integer',
                'date'      => 'required|string',
                'check_in'      => 'required|string',
                'check_out'      => 'required|string'
            ]);
            $dateDetails = Carbon::parse($request->input('date'))->format('l, jS \\of F Y');

            $attendance = Attendance::findOrFail($id);
            $attendance->department_id = $request->department_id;
            $attendance->employee_id = $request->employee_id;
            $attendance->date = $request->date;
            $attendance->date_details = $dateDetails;
            $attendance->check_in = $request->check_in;
            $attendance->check_out = $request->check_out;
            $attendance->note = $request->note;
            $attendance->save();

            return response()->json(['status' => 'success', 'message' => 'Attendance updated successfully']);
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
            $leave = Leave::findOrFail($id);
            $leave->delete();
            return response()->json(['status' => 'success', 'message' => 'Leave deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
