<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use App\Services\EmployeeRoleSync;
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
        $employee->loadMissing('role', 'department');
        $linkedUser = User::where('employee_id', $employee->id)->first();

        return view('employee.show', compact('employee', 'linkedUser'));
    }

    public function edit(Employee $employee)
    {
        $departments = Department::all();
        $roles = Role::all();
        $linkedUser = User::where('employee_id', $employee->id)->first();

        return view('employee.edit', compact('employee', 'departments', 'roles', 'linkedUser'));
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

        // Pengaman: tidak boleh mengubah role/department employee milik sendiri
        // (mencegah self-promote maupun self-demote yang tidak disengaja).
        if ((int) $employee->id === (int) auth()->user()->employee_id
            && ((int) $validated['role_id'] !== (int) $employee->role_id
                || (int) $validated['department_id'] !== (int) $employee->department_id)) {
            abort(403, 'Anda tidak dapat mengubah role/department data employee milik sendiri. Minta admin lain.');
        }

        // Pengaman: tidak boleh mendemote Super Admin terakhir.
        // Dicek via Spatie role (sumber kebenaran akses), bukan job_role.
        $employee->loadMissing('role');
        if (strtolower(trim((string) $employee->role->title)) === 'super admin') {
            $newRole = Role::find($validated['role_id']);
            if (!$newRole || strtolower(trim($newRole->title)) !== 'super admin') {
                $affectedAdmins = User::role('Super Admin')->where('employee_id', $employee->id)->count();
                if ($affectedAdmins > 0 && User::role('Super Admin')->count() - $affectedAdmins < 1) {
                    abort(403, 'Tidak dapat mendemote Super Admin terakhir.');
                }
            }
        }

        $employee->update($validated);

        // Sinkronkan Spatie role akun login yang terhubung agar
        // perubahan job_role langsung membuka permission yang sesuai.
        $sync = EmployeeRoleSync::sync($employee->fresh());

        $message = 'Employee has been updated successfully!';

        if ($sync['users'] > 0) {
            $message .= " Akun login terkait disinkron ke role '{$sync['role']}'.";
            if ($sync['permissions'] === 0) {
                $message .= " Perhatian: role Spatie '{$sync['role']}' belum punya permission, tambahkan di seeder.";
            }
        }

        return redirect()->route('employee.index')->with('success', $message);
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employee.index')->with('success', 'Employee has been deleted successfully.');
    }
}
