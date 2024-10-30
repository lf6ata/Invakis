<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{


    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriSeeder::class);
        $this->call(JenisSeeder::class);
        $this->call(MerekSeeder::class);
        $this->call(WarnaSeeder::class);
        $this->call(PegawaiSeeder::class);
        $this->call(BarangSeeder::class);
        $this->call(StoSeeder::class);
    }
    
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);
    // }
}
