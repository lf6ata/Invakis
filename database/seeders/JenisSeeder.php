<?php

namespace Database\Seeders;

use App\Models\Jenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jenis::create([
            'id_jenis' => 'AA',
            'jenis' => 'USB',
        ]);

        Jenis::create([
            'id_jenis' => 'AB',
            'jenis' => 'LCD',
        ]);
    }
}
