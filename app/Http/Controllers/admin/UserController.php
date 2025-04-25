<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = user::all();
        return view('admin.UserManage.user', compact('users'));
    }

    public function storeuser(Request $request){

        $request->validate([
           'user_name' => 'required',
           'user_email' => 'required',
           'user_password' => 'required',
        ]);
        User::Create([
            'name' => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->name),
        ]);
        return redirect()->back()->with('Success','User added successfully!');
    }
}
