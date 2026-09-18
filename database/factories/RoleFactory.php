<?php

namespace Database\Factories;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Role>
 */
class RoleFactory extends Factory
{
    protected $model = Role::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roles = [
            'Super Admin' => 'Full access to all system settings and data.',
            'Manager' => 'Manages department operations and views reports.',
            'Staff' => 'Standard access to daily tasks and records.',
            'Supervisor' => 'Oversees staff performance and approves requests.',
            'HR Officer' => 'Handles personnel and recruitment processes.'
        ];

        $title = $this->faker->unique()->randomElement(array_keys($roles));

        return [
            'title' => $title,
            'description' => $roles[$title],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
