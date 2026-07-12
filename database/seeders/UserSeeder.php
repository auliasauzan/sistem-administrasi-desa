<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Kepala Desa',
                'email' => 'kades@desa.id',
                'role' => 'Admin Desa',
                'position' => 'Kepala Desa',
                'employee_id' => '198001012010011001'
            ],
            [
                'name' => 'Sekretaris Desa',
                'email' => 'sekdes@desa.id',
                'role' => 'Perangkat Desa',
                'position' => 'Sekretaris Desa',
                'employee_id' => '198205022012021002'
            ],
            [
                'name' => 'Kaur Keuangan',
                'email' => 'keuangan@desa.id',
                'role' => 'Perangkat Desa',
                'position' => 'Kaur Keuangan',
                'employee_id' => '198503032015032003'
            ],
            [
                'name' => 'Warga Satu',
                'email' => 'warga1@desa.id',
                'role' => 'Warga',
            ],
            [
                'name' => 'Warga Dua',
                'email' => 'warga2@desa.id',
                'role' => 'Warga',
            ],
            [
                'name' => 'Warga Tiga',
                'email' => 'warga3@desa.id',
                'role' => 'Warga',
            ],
        ];

        foreach ($users as $userData) {
            if (User::where('email', $userData['email'])->exists()) {
                continue;
            }

            $user = User::factory()->create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'role' => $userData['role'],
            ]);

            if (in_array($userData['role'], ['Admin Desa', 'Perangkat Desa'])) {
                \App\Models\VillageOfficial::create([
                    'user_id' => $user->id,
                    'position' => $userData['position'] ?? null,
                    'employee_id' => $userData['employee_id'] ?? null,
                ]);
            }
        }
    }
}
