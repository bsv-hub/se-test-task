<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // TODO: take max value from config
        return [
            'guid' => $this->faker->uuid(),
            'value' => $this->faker->randomFloat(2, 1, 500_000),
        ];
    }
}
