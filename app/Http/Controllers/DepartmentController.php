<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();

        return view('department.index', compact('departments'));
    }

    public function show(Department $department)
    {
        return view('department.show', compact('department'));
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['nullable'],
            'status' => ['required']
        ]);

        Department::create($validated);

        return redirect()->route('department.index')->with('success', 'Department has ben created successfully!');
    }

    public function edit(Department $department)
    {
        return view('department.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['nullable'],
            'status' => ['required']
        ]);

        $department->update($validated);

        return redirect()->route('department.index')->with('success', 'Department has been updated!');
    }

    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('department.index')->with('success', 'Department has been deleted succesfully!');
    }
}
