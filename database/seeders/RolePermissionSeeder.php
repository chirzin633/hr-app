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
            'employee.view',
            'employee.create',
            'employee.edit',
            'employee.delete',
            'department.view',
            'department.manage',
            'job_role.view',
            'job_role.manage',
            'task.view',
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

        $superAdmin->givePermissionTo(Permission::all());
        $manager->givePermissionTo(['dashboard.view', 'employee.view', 'department.view', 'job_role.view', 'task.view', 'payroll.view', 'leave_request.view']);
        $hr->givePermissionTo(Permission::all());
        $supervisor->givePermissionTo(Permission::all());
        $staff->givePermissionTo([
            'employee.view',
            'employee.create',
            'task.view',
            'presence.view',
            'payroll.view',
            'leave_request.view',
        ]);
    }
}
