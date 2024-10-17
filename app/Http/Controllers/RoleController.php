<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        //get all data role
        $tb_role = Role::all();
        $tb_permission = Permission::all();
        
        //return data ke page role
        return view('menu.role.role',compact('tb_role', 'tb_permission'));
    }

    public function store(Request $request){
        dd($request->roles);
        $request->validate([
            'nama_roles' => 'required',
        ]);

        Role::create([
            'name' => $request->nama_roles,
        ]);
        
        return back()->with('success', 'Role Berhasil di Tambahkan');
    }

    public function destroy($id){
        $role= Role::find($id);
        if(empty($role)){
            return response()->json(['error' => 'Role tidak ditemkukan']);
        }

        $role->delete();

        // Menggunakan flash message laravel
        session()->flash('success', 'Role '.$role->name.' berhasil dihapus');
        // Kembalikan response sukses
        return response()->json(['success' => 'Role '.$role->name.' berhasil dihapus']);
    }

    public function edit($id){
        //mengambil id user tertentu
        $role_id = Role::find($id);
        
        //return response
        return response()->json(['index_role'=> $role_id ]); 
    }

    public function update(Request $request, $id){
        
        $role = Role::find($id);
        $role->update([
            'name' => $request->role_edit,
        ]);

        // Menggunakan flash message
        session()->flash('success', 'Role berhasil di update.');
        //Return Respon
        return response()->json(['success' => 'Role Berhasil di update']);
    }
}
