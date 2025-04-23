<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('admin.userManage.role',compact('roles'));
    }

    public function storerole(Request $request){

        $request->validate([
            'role_name' => 'required',
        ]);
        Role::create(['name' => $request->role_name]);
        return redirect()->back()->with('Success','Role added successfully!');
    }

    public function updaterole(Request $request){
        
        $request->validate([
            'role_name' => 'required',
            'role_id' => 'required',
        ]);

        $update = Role::find($request->role_id);
        $update->name = $request->role_name;
        $update->save();
        return redirect()->back()->with('Success','Role updated successfully!');
    }

    public function deleteRole($id){
        $role = Role::find($id);
        $role->delete();
        return redirect()->back()->with('success','Role deleted successfully !');
    }
    public function givePermissionToRole($id){
        $permissions = Permission::all();
        $role = Role::findOrFail($id);

        // $rolePermision = $role->permisions() ->pluck('id') ->toArray();



        return view('admin.UserManage.givePermissionToRole', compact('permissions', 'role',));
    }
    public function giveRoleToPermission(Request $request,$role_id){
        $request->validate([
            'permissions' => 'required',

        ]);
        $role = Role::findOrFail($role_id);
        $role->syncPermissions($request->permissions);

        return redirect()->back()->with('Success','Permission added successfully!');
    }
}
