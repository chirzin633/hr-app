<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        return view('task.index', compact('tasks'));
    }

    public function create()
    {
        $employees = Employee::all();

        return view('task.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable'],
            'employee_id' => ['required'],
            'due_date' => ['required', 'date'],
        ]);

        $validated['status'] = 'pending';

        Task::create($validated);

        return redirect()->route('task.index')->with('success', 'Task created successfully');
    }

    public function edit(Task $task)
    {
        $employees = Employee::all();

        return view('task.edit', compact('task', 'employees'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable'],
            'employee_id' => ['required'],
            'due_date' => ['required', 'date'],
            'status' => ['string']
        ]);

        $task->update($validated);

        return redirect()->route('task.index')->with('success', 'Task updated successfully');
    }
}
