<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Presence;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Presence>
 */
class PresenceFactory extends Factory
{
    protected $model = Presence::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('-1 month', 'now');
        $checkIn = $this->faker->dateTimeBetween($date->format('Y-m-d') . ' 08:00:00' . $date->format('Y-m-d') . ' 09:00:00');
        $chekOut = $this->faker->dateTimeBetween($date->format('Y-m-d') . ' 16:00:00' . $date->format('Y-m-d') . ' 17:00:00');
        $employee = Employee::inRandomOrder()->first()?->id ?? Employee::factory();


        return [
            'employee_id' => $employee,
            'check_in' => $checkIn,
            'check_out' => $chekOut,
            'date' => $date,
            'status' => $this->faker->randomElement(['present', 'absent', 'late', 'leave']),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
