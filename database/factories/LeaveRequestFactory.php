<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\LeaveRequest;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LeaveRequest>
 */
class LeaveRequestFactory extends Factory
{
    protected $model = LeaveRequest::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 month', '+1 month');
        $endDate = (clone $startDate)->modify('+' . rand(1, 5) . ' days');
        $employee = Employee::inRandomOrder()->first()?->id ?? Employee::factory();

        return [
            'employee_id' => $employee,
            'leave_type' => $this->faker->randomElement(['annual', 'sick', 'maternity', 'unpaid']),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
