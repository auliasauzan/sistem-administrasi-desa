<?php

namespace Database\Factories;

use App\Models\VillageAsset;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<VillageAsset>
 */
class VillageAssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'asset_code' => 'INV-' . date('Y') . '-' . fake()->unique()->numerify('###'),
            'name' => fake()->randomElement(['Mobil Dinas Kades', 'Laptop Asus', 'Printer Epson', 'Meja Rapat', 'Kursi Tamu', 'Proyektor', 'Tanah Kas Desa Dusun 1', 'AC Daikin 1 PK', 'Lemari Arsip']),
            'quantity' => fake()->numberBetween(1, 20),
            'condition' => fake()->randomElement(['Baik', 'Baik', 'Rusak Ringan', 'Rusak Berat']), // Bias towards 'Baik'
            'acquisition_date' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'location' => fake()->randomElement(['Ruang Kades', 'Ruang Sekdes', 'Balai Desa', 'Gudang', 'Dusun 1', 'Dusun 2']),
        ];
    }
}
