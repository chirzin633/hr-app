<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Role;
use App\Services\EmployeeRoleSync;
use Illuminate\Cache\RetrievesMultipleKeys;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('role.index', compact('roles'));
    }

    public function show(Role $role)
    {
        return view('role.show', compact('role'));
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable']
        ]);

        Role::create($validated);

        return redirect()->route('role.index')->with('success', 'Role has been created succesfully!');
    }

    public function edit(Role $role)
    {
        return view('role.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable']
        ]);

        $role->update($validated);

        // Bila title job_role di-rename, sinkronkan ulang Spatie role
        // semua employee yang memakai job_role ini.
        $synced = 0;
        if ($role->wasChanged('title')) {
            $employees = Employee::where('role_id', $role->id)->get();
            foreach ($employees as $employee) {
                $sync = EmployeeRoleSync::sync($employee);
                $synced += $sync['users'];
            }
        }

        $message = 'Role has been updated successfully!';
        if ($synced > 0) {
            $message .= " {$synced} akun login disinkron ke role '{$role->title}'.";
        }

        return redirect()->route('role.index')->with('success', $message);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role has been deleted successfully!');
    }
}
