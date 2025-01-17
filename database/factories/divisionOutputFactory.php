<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\divisionOutput>
 */
class divisionOutputFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'qty'           => fake()->randomNumber(3),
            'input_date'    => fake()->dateTimeInInterval('+5 days', '+3 month'),
        ];
    }
}
