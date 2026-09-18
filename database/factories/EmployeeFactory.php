<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */

class EmployeeFactory extends Factory
{

    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'fullname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'birth_date' => $this->faker->date('Y-m-d', '-22 years'),
            'hire_date' => $this->faker->date('Y-m-d', 'now'),

            'department_id' => Department::inRandomOrder()->first()?->id ?? Department::factory(),
            'role_id' => Role::inRandomOrder()->first()?->id ?? Role::factory(),

            'status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
            'salary' => $this->faker->randomFloat(2, 4000000, 25000000),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
