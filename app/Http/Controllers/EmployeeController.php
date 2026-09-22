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
}
