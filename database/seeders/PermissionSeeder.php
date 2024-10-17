<?php

namespace Database\Seeders;

use FontLib\Table\Type\name;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = ['view_barang'];

        foreach ($permission as $p) {
            
            Permission::updateOrCreate(
                [
                    'name' => $p
                ],['name' => $p]
            );
        }
    }
}
