<?php

namespace App\Services;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Provisioning akun login: Spatie role + employee + keselarasan job_role.
 * Dipakai bersama oleh registrasi mandiri dan command user:promote.
 */
class UserProvisioning
{
    /**
     * Pastikan user terhubung ke employee (link by email atau create minimal).
     */
    public static function ensureEmployee(User $user, string $jobRoleTitle = 'Staff'): Employee
    {
        if ($user->employee_id) {
            $existing = Employee::find($user->employee_id);
            if ($existing) {
                return $existing;
            }
        }

        $employee = Employee::where('email', $user->email)->first();

        if (!$employee) {
            $department = Department::first()
                ?? Department::create([
                    'name' => 'General',
                    'description' => 'Default department for self-registered users.',
                    'status' => 'active',
                ]);

            $jobRole = Role::where('title', $jobRoleTitle)->first()
                ?? Role::create([
                    'title' => $jobRoleTitle,
                    'description' => 'Auto-created role.',
                ]);

            $employee = Employee::create([
                'fullname' => $user->name,
                'email' => $user->email,
                'phone_number' => '-',
                'address' => '-',
                'birth_date' => now()->toDateString(),
                'hire_date' => now()->toDateString(),
                'department_id' => $department->id,
                'role_id' => $jobRole->id,
                'status' => 'active',
                'salary' => 0,
            ]);
        }

        $user->update(['employee_id' => $employee->id]);

        return $employee->fresh();
    }

    /**
     * Tetapkan Spatie role sekaligus selaraskan job_role employee ke nama yang sama.
     *
     * @return array{role: string, permissions: int, employee_id: ?int}
     */
    public static function assignRole(User $user, string $roleName): array
    {
        $roleName = trim($roleName);

        $spatieRole = SpatieRole::findOrCreate($roleName);
        $user->syncRoles($spatieRole);

        $employee = self::ensureEmployee($user, $roleName);

        $jobRole = Role::where('title', $roleName)->first()
            ?? Role::create([
                'title' => $roleName,
                'description' => 'Auto-created role.',
            ]);

        if ((int) $employee->role_id !== (int) $jobRole->id) {
            $employee->update(['role_id' => $jobRole->id]);
        }

        return [
            'role' => $roleName,
            'permissions' => $spatieRole->permissions()->count(),
            'employee_id' => $employee->id,
        ];
    }
}
