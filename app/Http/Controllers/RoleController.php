<?php

namespace App\Http\Controllers;

use App\Models\Role;
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

        return redirect()->route('role.index')->with('success', 'Role has been updated successfully!');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role has been deleted successfully!');
    }
}
