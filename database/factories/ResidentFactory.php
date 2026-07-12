<?php

namespace Database\Factories;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Resident>
 */
class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'family_id' => \App\Models\Family::factory(),
            'national_id' => fake()->unique()->numerify('123456##########'),
            'full_name' => fake()->name(),
            'birth_date' => fake()->date('Y-m-d', '-18 years'),
            'gender' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'religion' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
            'occupation' => fake()->jobTitle(),
        ];
    }
}
