<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            RoleSeeder::class,
            EmployeeSeeder::class,
            TaskSeeder::class,
            PayrollSeeder::class,
            PresenceSeeder::class,
            LeaveRequestSeeder::class
        ]);
    }
}
