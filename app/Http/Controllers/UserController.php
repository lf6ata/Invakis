<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    
    public function index(){
        $tb_user = User::all();
        $role = Role::all();
        // dd($tb_user->hasAllRoles($role));
        return view('menu.user.user',compact('tb_user','role'));
    }

    public function store(Request $request){
        $request->validate([
            'nama'                  => 'required',
            'email'                 => 'required',
            'password'              => 'required | same:confirm-password',
            'confirm-password'      => 'required ',
            'roles'                 => 'required'
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->roles);
        
        return back()->with('success', 'User Berhasil di Tambahkan');
    }

    public function destroy($id){
        $user= User::find($id);
        if(empty($user)){
            return response()->json(['error' => 'User tidak ditemkukan']);
        }

        $user->delete();

        // Menggunakan flash message
        session()->flash('success', 'User '.$user->name.' berhasil dihapus');
        // Kembalikan response sukses
        return response()->json(['success' => 'User '.$user->name.' berhasil dihapus']);
    }

    public function edit($id){
        // //mengambil id user tertentu
        // $user_id = User::findOrFail($id);
        // $roles = $user_id->getRoleNames()->toArray();

        // $role_select = Role::all();

        // // Format response untuk mengisi select
        // $formattedRoles = array_map(function($role) use ($role_select) {
        //     return [
        //         'name' => $role,
        //         'isSelected' => in_array($role, $role_select)
        //     ];
        // }, $roles);
        
        // //return response
        // return response()->json(['index_user'=> $user_id ]); 

        $user = User::findOrFail($id);
        $roles = $user->getRoleNames()->toArray(); // Mengambil role yang ada

        // Daftar semua role yang tersedia
        $allRoles = Role::all();

        $formattedRoles = [];
        foreach ($allRoles as $role) {
            $formattedRoles[] = [
                'name' => $role,
                'isSelected' => in_array($role, $roles)
            ];
        }

        //mengembalikan data role dan user
        return response()->json([
                'roles' => $formattedRoles,
                'index_user' => $user
            
        ]);
    }

    public function update(Request $request, $id){
        
        $user = User::find($id);
        $user->update([
            'name' => $request->nama_edit,
            'email' => $request->email_edit,
        ]);

        $user->syncRoles([$request->role_edit]);

        // Menggunakan flash message
        session()->flash('success', 'User berhasil di update.');
        //Return Respon
        return response()->json(['success' => 'User Berhasil di update']);
    }
}
