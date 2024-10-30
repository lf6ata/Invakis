<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::updateOrCreate([
            'name' => 'Alif',
            'email' => 'alif@designjaya.com',
            'password' => bcrypt('12345678'),
        ]);

        $user = User::updateOrCreate([
            'name' => 'Richie',
            'email' => 'richie@designjaya.com',
            'password' => bcrypt('12345678'),
        ]);

        $admin = User::find(1);
        $user = User::find(2);
        $user->assignRole('admin'); // Menambahkan role user
        $admin->assignRole('admin'); // Menambahkan role user
        // $user->assignRole('user');
        // $admin->assignRole('admin');
    }
}
