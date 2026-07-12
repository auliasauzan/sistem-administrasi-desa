<?php

namespace Database\Factories;

use App\Models\LandCertificate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<LandCertificate>
 */
class LandCertificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => \App\Models\Resident::inRandomOrder()->first()?->id ?? \App\Models\Resident::factory(),
            'certificate_number' => fake()->unique()->numerify('10.##.##.##.#.#####'),
            'area_size' => fake()->randomFloat(2, 50, 1000),
            'location' => fake()->address(),
        ];
    }
}
