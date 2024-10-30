<?php

namespace Database\Seeders;

use App\Models\Merek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Merek::updateOrCreate([
            'id_merek' => '01',
            'merek' => 'logitech',
        ]);

        Merek::updateOrCreate([
            'id_merek' => '02',
            'merek' => 'HP',
        ]);
    }
}
