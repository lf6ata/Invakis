<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $Roleadmin = Role::create([
        //     'name' => 'admin',
        //     'guard_name' => 'web'
        // ]);

        // $Roleuser = Role::create([
        //     'name' => 'user',
        //     'guard_name' => 'web'
        // ]);

        //Create Permission
        // $permission = ['view barang', 'delete barang', 'update barang', 'add barang'];

        // $permission = ['view_barang','add_barang'];
            
            $permission1 = Permission::updateOrCreate(
                [
                    'name' => 'view_barang'
                ],['name' => 'view_barang']
            );
        

        //Create User
        $user = ['admin', 'user'];
        $adminRole = Role::updateOrCreate(
            [
            'name'          => $user[0],
            'guard_name'    => 'web' 
        ], 
        [ 'name'=> $user[0], 'guard_name' => 'web' ]
        );

        $userRole = Role::updateOrCreate(
            [
            'name'          => $user[1],
            'guard_name'    => 'web' 
        ], 
        [ 'name'=> $user[1], 'guard_name' => 'web' ]
        );

        $adminRole->givePermissionTo([$permission1]);
        // $Roleuser->givePermissionTo([$permission[1]]);

        // $tes = User::find(9);
        // $permission1->assignRole($adminRole);
        $user = User::find(11);
        $user->assignRole('Admin'); // Menambahkan role
        $user->givePermissionTo('view_barang'); // Menambahkan permission
        

        

        // //membuat role and permission
        // $admin = Role::create([])

        // Membuat permission
        // Permission::create(['name' => 'edit articles']);
        // Permission::create(['name' => 'delete articles']);

        // // Membuat role
        // $role = Role::create(['name' => 'writer']);
        // $role->givePermissionTo('edit articles');
        
        // $role = Role::create(['name' => 'admin']);
        // $role->givePermissionTo(['edit articles', 'delete articles']);

        // $user = User::find(11);
        // $user->assignRole('writer'); // Menambahkan role
        // $user->givePermissionTo('edit articles'); // Menambahkan permission

        
    }
}
