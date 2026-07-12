<?php

namespace Database\Factories;

use App\Models\Family;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Family>
 */
class FamilyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'family_card_number' => fake()->unique()->numerify('123456##########'),
            'address' => fake()->streetAddress(),
            'neighborhood' => fake()->numerify('00#') . '/' . fake()->numerify('00#'),
        ];
    }
}
