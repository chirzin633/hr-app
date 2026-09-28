<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\User;
use Spatie\Permission\Models\Role as SpatieRole;

/**
 * Menjembatani dua sistem role:
 * - HR master data: employees.role_id -> job_roles.title
 * - Akses login (Spatie): model_has_roles
 *
 * Setiap employee disimpan/diubah, akun login yang terhubung
 * (users.employee_id) disinkronkan ke Spatie role dengan nama
 * yang sama dengan job_role title.
 */
class EmployeeRoleSync
{
    /**
     * @return array{role: ?string, users: int, permissions: int}
     */
    public static function sync(Employee $employee): array
    {
        $employee->loadMissing('role');

        $title = trim((string) ($employee->role->title ?? ''));

        if ($title === '') {
            return ['role' => null, 'users' => 0, 'permissions' => 0];
        }

        $spatieRole = SpatieRole::findOrCreate($title);

        $users = User::where('employee_id', $employee->id)->get();

        foreach ($users as $user) {
            $user->syncRoles($spatieRole);
        }

        return [
            'role' => $title,
            'users' => $users->count(),
            'permissions' => $spatieRole->permissions()->count(),
        ];
    }
}
