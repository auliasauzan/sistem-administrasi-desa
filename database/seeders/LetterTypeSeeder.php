<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LetterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Surat Keterangan Tidak Mampu (SKTM)',
                'requirements' => "1. Fotokopi KTP\n2. Fotokopi KK\n3. Surat Pengantar RT/RW",
            ],
            [
                'name' => 'Surat Pengantar Nikah',
                'requirements' => "1. Fotokopi KTP calon suami & istri\n2. Fotokopi KK\n3. Pas foto 3x4",
            ],
            [
                'name' => 'Surat Keterangan Usaha (SKU)',
                'requirements' => "1. Fotokopi KTP\n2. Foto tempat usaha\n3. Surat Pengantar RT/RW",
            ],
            [
                'name' => 'Surat Keterangan Domisili',
                'requirements' => "1. Fotokopi KTP\n2. Fotokopi KK\n3. Surat Pengantar RT/RW",
            ],
        ];

        foreach ($types as $type) {
            \App\Models\LetterType::create($type);
        }
    }
}
