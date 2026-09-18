<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Payroll;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payroll>
 */
class PayrollFactory extends Factory
{
    protected $model = Payroll::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $employee = Employee::inRandomOrder()->first() ?? Employee::factory()->create();

        $salary = $employee->salary ?? $this->faker->randomFloat(2, 4000000, 25000000);
        $bonuses = $this->faker->optional()->randomFloat(2, 50000, 500000);
        $deductions = $this->faker->optional()->randomFloat(2, 100000, 2000000);

        return [
            'employee_id' => $employee->id,
            'salary' => $salary,
            'bonuses' => $bonuses,
            'deductions' => $deductions,
            'net_salary' => $salary + ($bonuses ?? 0) - ($deductions ?? 0),
            'pay_date' => $this->faker->dateTimeBetween('-2 months', 'now'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
