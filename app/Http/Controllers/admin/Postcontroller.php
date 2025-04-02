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

    public function storepost(Request $request){

        $request->validate([
            'post_title'  => 'required',
            'post_slug'  => 'required',
            'post_body'  => 'required',
            'post_image'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('post_image')){
            $imagepath = $request->file('post_image')->store('posts','public');
        }
    
        posts::create([
            'title' => $request->post_title,
            'slug' => $request->post_slug,
            'body' => $request->post_body,
            'image' => $imagepath,
        ]);

        return redirect()->back()->with('success','Post added successfully!');
    }
}
