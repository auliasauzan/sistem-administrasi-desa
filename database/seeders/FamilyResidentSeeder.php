<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FamilyResidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Family::factory(10)->create()->each(function ($family) {
            \App\Models\Resident::factory(rand(3, 5))->create([
                'family_id' => $family->id
            ]);
        });
    }
}
