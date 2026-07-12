<?php

namespace Database\Factories;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'author_id' => \App\Models\VillageOfficial::inRandomOrder()->first()->id ?? 1,
            'title' => fake()->randomElement([
                'Pemberitahuan Kerja Bakti Massal',
                'Penyaluran Bantuan Langsung Tunai (BLT)',
                'Jadwal Posyandu Balita dan Lansia',
                'Peringatan Hari Kemerdekaan RI ke-81',
                'Sosialisasi Kesehatan Masyarakat',
                'Rapat Pembahasan Anggaran Desa',
                'Pengurusan e-KTP Gratis'
            ]),
            'content' => fake()->paragraphs(3, true),
            'published_at' => fake()->dateTimeBetween('-1 month', '+1 week'),
        ];
    }
}
