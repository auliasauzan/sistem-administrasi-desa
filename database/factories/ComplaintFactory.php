<?php

namespace Database\Factories;

use App\Models\Complaint;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Complaint>
 */
class ComplaintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['open', 'in_progress', 'resolved']);
        $handledBy = null;

        if ($status !== 'open') {
            $handledBy = \App\Models\VillageOfficial::inRandomOrder()->first()?->id;
        }

        return [
            'resident_id' => \App\Models\Resident::inRandomOrder()->first()?->id ?? \App\Models\Resident::factory(),
            'handled_by' => $handledBy,
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'photo_url' => fake()->boolean(50) ? 'https://images.unsplash.com/photo-1596423735880-5fec8fb7b9ea?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' : null,
            'status' => $status,
        ];
    }
}
