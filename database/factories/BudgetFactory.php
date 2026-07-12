<?php

namespace Database\Factories;

use App\Models\Budget;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Budget>
 */
class BudgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['income', 'expense']);
        
        $categories = $type === 'income' 
            ? ['Dana Desa', 'Pendapatan Asli Desa', 'Bantuan Provinsi', 'Alokasi Dana Desa']
            : ['Pembangunan Infrastruktur', 'Operasional Perangkat', 'Pemberdayaan Masyarakat', 'Kesehatan dan Pendidikan'];

        return [
            'budget_type' => $type,
            'category' => fake()->randomElement($categories),
            'amount' => fake()->randomFloat(2, 5000000, 500000000), // 5jt - 500jt
            'year' => date('Y'),
            'description' => fake()->sentence(),
        ];
    }
}
