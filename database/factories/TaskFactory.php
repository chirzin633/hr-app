<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'employee_id' => Employee::inRandomOrder()->first()?->id ?? Employee::factory(),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
