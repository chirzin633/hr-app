<?php

namespace Database\Factories;

use App\Models\Department;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Department>
 */
class DepartmentFactory extends Factory
{

    protected $model = Department::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $departments = [
            'HR' => 'Human Resoources Department',
            'IT' => 'Information Technology Department',
            'Sales' => 'Sales and Marketing Department',
            'Finance' => 'Finance and Accounting Department',
            'Legal' => 'Legal and Compliance Department'
        ];

        $name = $this->faker->randomElement(array_keys($departments));


        return [
            'name' => $name,
            'description' => $departments[$name],
            'status' => $this->faker->randomElement(['acticve', 'inactive']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
