<?php

namespace Database\Seeders;

use App\Models\categori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        categori::updateOrCreate([
            'id_categori' => '01',
            'categori' => 'Monitor',
        ]);

        categori::updateOrCreate([
            'id_categori' => '02',
            'categori' => 'Mouse',
        ]);

    }
}
