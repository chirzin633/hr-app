<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
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

        return view('employee.create', compact('departments', 'roles'));
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
            'salary' => ['required', 'numeric']
        ]);

        Employee::create($validated);

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

        return view('employee.edit', compact('employee', 'departments', 'roles'));
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
            'salary' => ['required', 'numeric']
        ]);

        $employee->update($validated);

        return redirect()->route('employee.index')->with('success', 'Employee has been updated successfully!');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee has been deleted successfully.');
    }
}
