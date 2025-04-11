<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;


class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('admin.UserManage.permissions',compact('permissions'));
    }
}
