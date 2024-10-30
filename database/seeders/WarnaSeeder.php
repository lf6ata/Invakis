<?php

namespace Database\Seeders;

use App\Models\Warna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarnaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Warna::updateOrCreate([
            'id_warna' => 'AA',
            'warna' => 'Silver',
        ]);

        Warna::updateOrCreate([
            'id_warna' => 'AB',
            'warna' => 'Hitam',
        ]);
    }
}
