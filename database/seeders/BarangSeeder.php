<?php

namespace Database\Seeders;

use App\Models\Barang;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   $date = new DateTime();
        Barang::updateOrCreate([
            'no_asset' => '01-AA-01-AA-001',
            'id_categori' => '01',
            'id_jenis' => '01',
            'id_merek' => '01',
            'id_warna' => '01',
            'npk' => '01',
            'lokasi' => 'IT',
            'nama_kr' => 'Alif',
            'divisi' => 'Network Infrastruktur',
            'image' => 'not image',
            'serial_number' => 'a0953jk9',
            'jenis_license' => '',
            'kode_license' => '',
            'tgl_masuk' => $date->format('Y-m-d'),
            'tgl_terakhir_sto' => $date->format('Y-m-d'),
        ]);

    }
}
