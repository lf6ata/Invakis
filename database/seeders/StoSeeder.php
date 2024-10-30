<?php

namespace Database\Seeders;

use App\Models\Sto;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $date = new DateTime();
        Sto::updateOrCreate([
            'tgl_sto'       => $date->format('Y-m-d'),
            'no_asset'      => '01-AA-01-AA-001',
            'status'        => 'Sangat Layak',
            'user'          => 'Alif',
            'tgl_save_sto'  => '2024-10-24'
        ]);
    }
}
