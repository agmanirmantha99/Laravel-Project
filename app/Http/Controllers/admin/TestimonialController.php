<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;


class TestimonialController extends Controller
{
    public function Index(){
        $testimonials = Testimonial::all();
        return view('admin.home.testimonial');
    }

    public function storeTestimonial(Request $request){

        $request->validate([
            'tm_name'=>'required|string',
            'tm_profession'=>'required|string',
            'tm_description'=>'required|string',
            'tm_image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if($request->hasFile('tm_image')){
            $imagePath = $request->file('tm_image')->store('testimonial','public');
        }

        Testimonial::create([ 
            'name'=> $request->tm_name,
            'profession'=>$request->tm_profession,
            'description'=>$request->tm_description,
            'image'=>$imagePath
        ]);

        return redirect()->back()->with('success','Testimonial added successfully');
    }
}
