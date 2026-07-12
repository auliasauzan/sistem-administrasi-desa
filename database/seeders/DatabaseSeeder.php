<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            FamilyResidentSeeder::class,
            LetterTypeSeeder::class,
            LetterSeeder::class,
            LandCertificateSeeder::class,
            ComplaintSeeder::class,
            BudgetSeeder::class,
            VillageAssetSeeder::class,
            AnnouncementSeeder::class,
            SettingSeeder::class,
        ]);

        // Map Warga users to random residents so they can use the application
        $wargaUsers = \App\Models\User::where('role', 'Warga')->get();
        $residents = \App\Models\Resident::inRandomOrder()->take($wargaUsers->count())->get();
        
        foreach ($wargaUsers as $index => $user) {
            if (isset($residents[$index])) {
                $residents[$index]->update(['user_id' => $user->id]);
            }
        }
    }
}
