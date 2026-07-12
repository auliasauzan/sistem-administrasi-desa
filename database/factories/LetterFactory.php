<?php

namespace Database\Factories;

use App\Models\Letter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Letter>
 */
class LetterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['pending', 'approved', 'rejected']);
        $approvedBy = null;
        $note = null;

        if ($status !== 'pending') {
            $approvedBy = \App\Models\VillageOfficial::inRandomOrder()->first()?->id;
            if ($status === 'rejected') {
                $note = fake()->sentence();
            }
        }

        return [
            'resident_id' => \App\Models\Resident::inRandomOrder()->first()?->id ?? \App\Models\Resident::factory(),
            'letter_type_id' => \App\Models\LetterType::inRandomOrder()->first()?->id ?? \App\Models\LetterType::factory(),
            'approved_by' => $approvedBy,
            'status' => $status,
            'note' => $note,
        ];
    }
}
