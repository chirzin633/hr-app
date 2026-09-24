<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        $departments =  Department::all();
        $roles = Role::all();
        $users = User::whereNull('employee_id')->orderBy('name')->get();

        return view('employee.create', compact('departments', 'roles', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'string'],
            'address' => ['required'],
            'birth_date' => ['required', 'date'],
            'hire_date' => ['required', 'date'],
            'department_id' => ['required'],
            'role_id' => ['required'],
            'status' => ['required', 'string'],
            'salary' => ['required', 'numeric'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        $userId = $validated['user_id'] ?? null;
        unset($validated['user_id']);

        $employee = Employee::create($validated);

        if ($userId) {
            User::whereKey($userId)->update(['employee_id' => $employee->id]);
        }

        return redirect()->route('employee.index')->with('success', 'Employee has been created succesfully!');
    }

    public function show(Employee $employee)
    {
        return view('employee.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $roles = Role::all();
        $users = User::whereNull('employee_id')
            ->orWhere('employee_id', $employee->id)
            ->orderBy('name')
            ->get();
        $linkedUserId = User::where('employee_id', $employee->id)->value('id');

        return view('employee.edit', compact('employee', 'departments', 'roles', 'users', 'linkedUserId'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'string'],
            'address' => ['required'],
            'birth_date' => ['required', 'date'],
            'hire_date' => ['required', 'date'],
            'department_id' => ['required'],
            'role_id' => ['required'],
            'status' => ['required', 'string'],
            'salary' => ['required', 'numeric'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        $userId = $validated['user_id'] ?? null;
        unset($validated['user_id']);

        $employee->update($validated);

        User::where('employee_id', $employee->id)
            ->where('id', '!=', $userId ?? 0)
            ->update(['employee_id' => null]);

        if ($userId) {
            User::whereKey($userId)->update(['employee_id' => $employee->id]);
        }

        return redirect()->route('employee.index')->with('success', 'Employee has been updated successfully!');
    }

    public function destroy(Employee $employee)
    {
        User::where('employee_id', $employee->id)->update(['employee_id' => null]);

        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee has been deleted successfully.');
    }
}
