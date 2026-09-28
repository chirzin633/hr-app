<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\FiltersOwnRecords;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    use FiltersOwnRecords;

    public function index()
    {
        $leave_requests = $this->scopeToOwn(LeaveRequest::query(), 'leave_request.approve')->get();
        return view('leave-request.index', compact('leave_requests'));
    }

    public function create()
    {
        $employees = $this->selectableEmployees('leave_request.approve');
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

        $validated['employee_id'] = $this->resolveEmployeeId((int) $validated['employee_id'], 'leave_request.approve');
        $validated['status'] = 'pending';

        LeaveRequest::create($validated);

        return redirect()->route('leave-request.index')->with('success', 'Leave Request has been submited!');
    }

    public function show(LeaveRequest $leave_request)
    {
        $this->authorizeLeaveAccess($leave_request);

        $leave_request->loadMissing('employee');

        return view('leave-request.show', compact('leave_request'));
    }

    public function edit(LeaveRequest $leave_request)
    {

        $this->authorizeLeaveAccess($leave_request);

        $employees = $this->selectableEmployees('leave_request.approve');

        return view('leave-request.edit', compact('employees', 'leave_request'));
    }

    public function update(Request $request, LeaveRequest $leave_request)
    {
        $this->authorizeLeaveAccess($leave_request);

        $validated = $request->validate([
            'employee_id' => ['required'],
            'leave_type' => ['required'],
            'start_date' => ['date', 'required'],
            'end_date' => ['date', 'required'],
        ]);

        $validated['employee_id'] = $this->resolveEmployeeId((int) $validated['employee_id'], 'leave_request.approve');

        $leave_request->update($validated);

        return redirect()->route('leave-request.index')->with('success', 'Leave request has been updated successfully!');
    }

    public function destroy(LeaveRequest $leave_request)
    {
        $this->authorizeLeaveAccess($leave_request);

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

    /**
     * Pemilik record atau pemegang leave_request.approve.
     */
    protected function authorizeLeaveAccess(LeaveRequest $leave_request): void
    {
        if (auth()->user()->can('leave_request.approve')) {
            return;
        }

        $this->authorizeRecordOwnership($leave_request, 'leave_request.approve');
    }
}
