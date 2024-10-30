<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Karyawan::updateOrCreate([
            'npk' => '1811155',
            'nama_kr' => 'Alif',
            'divisi' => 'Network Infrastruktur'

        ]);

        Karyawan::updateOrCreate([
            'npk' => '1811156',
            'nama_kr' => 'Pani',
            'divisi' => 'Network Infrastruktur'
        ]);
    }
}
