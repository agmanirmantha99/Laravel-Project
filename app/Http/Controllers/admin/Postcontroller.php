<?php

namespace App\Http\Controllers\admin;

use App\Models\Posts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Postcontroller extends Controller
{
    public function index(){
        $posts = Posts::all();
        return view('admin.posts',compact('posts'));
    }
}
