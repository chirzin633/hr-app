<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $leave_requests = LeaveRequest::all();
        return view('leave-request.index', compact('leave_requests'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('leave-request.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => ['required'],
            'leave_type' => ['required'],
            'start_date' => ['date', 'required'],
            'end_date' => ['date', 'required'],
        ]);

        $validated['status'] = 'pending';

        LeaveRequest::create($validated);

        return redirect()->route('leave-request.index')->with('success', 'Leave Request has been submited!');
    }

    public function edit(LeaveRequest $leave_request)
    {

        $employees = Employee::all();

        return view('leave-request.edit', compact('employees', 'leave_request'));
    }

    public function update(Request $request, LeaveRequest $leave_request)
    {
        $validated = $request->validate([
            'employee_id' => ['required'],
            'leave_type' => ['required'],
            'start_date' => ['date', 'required'],
            'end_date' => ['date', 'required'],
        ]);

        $leave_request->update($validated);

        return redirect()->route('leave-request.index')->with('success', 'Leave request has been updated successfully!');
    }

    public function destroy(LeaveRequest $leave_request)
    {
        $leave_request->delete();
        return redirect()->route('leave-request.index')->with('success', 'Leave request has been deleted successfully!');
    }

    public function confirm(LeaveRequest $leave_request)
    {
        $leave_request->update([
            'status' => 'approved'
        ]);

        return redirect()->route('leave-request.index')->with('success', 'Success!');
    }

    public function reject(LeaveRequest $leave_request)
    {
        $leave_request->update([
            'status' => 'rejected'
        ]);

        return redirect()->route('leave-request.index')->with('success', 'Success!');
    }
}
