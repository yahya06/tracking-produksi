<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code_product'  => fake()->unique()->word(),
            'name_product'  => fake()->word(),
            'customer'      => fake()->name(),
            'deadline'      => fake()->dateTimeInInterval('+5 days', '+3 month'),
        ];
    }
}
