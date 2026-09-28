<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'dashboard.view',
            'dashboard.chart',
            'employee.view',
            'employee.manage',
            'department.view',
            'department.manage',
            'job_role.view',
            'job_role.manage',
            'task.view',
            'task.edit',
            'task.manage',
            'presence.view',
            'presence.manage',
            'payroll.view',
            'payroll.manage',
            'leave_request.view',
            'leave_request.approve',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $manager = ModelsRole::firstOrCreate(['name' => 'Manager']);
        $superAdmin = ModelsRole::firstOrCreate(['name' => 'Super Admin']);
        $staff = ModelsRole::firstOrCreate(['name' => 'Staff']);
        $hr = ModelsRole::firstOrCreate(['name' => 'HR Officer']);
        $supervisor = ModelsRole::firstOrCreate(['name' => 'Supervisor']);

        // syncPermissions (bukan give) agar re-run MENCABUT permission
        // yang sudah dihapus dari matriks — menutup kelebihan akses lama.
        $superAdmin->syncPermissions(Permission::all());
        $manager->syncPermissions([
            'dashboard.view', 'dashboard.chart', 'employee.view', 'department.view',
            'job_role.view', 'task.view', 'presence.view', 'payroll.view', 'leave_request.view',
        ]);
        $hr->syncPermissions(Permission::all());
        $supervisor->syncPermissions(Permission::all());
        $staff->syncPermissions([
            'dashboard.view',
            'task.view',
            'task.edit',
            'presence.view',
            'leave_request.view',
        ]);
    }
}
