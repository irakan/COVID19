<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'country' => $this->faker->country,
            'total_confirmed' => $this->faker->numberBetween(0, 1000000),
            'total_recovered' => $this->faker->numberBetween(0, 1000000),
            'total_deaths' => $this->faker->numberBetween(0, 1000000),
        ];
    }
}
