<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;


class TestimonialController extends Controller
{
    public function Index(){
        $testimonials = Testimonial::all();
        return view('admin.home.testimonial',compact('testimonials'));
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

    public function updateTestimonial(Request $request){

        $request ->validate([
            'tm_name'=> 'required',
            'tm_profession'=> 'required',
            'tm_description'=> 'required',
            'tm_id'=> 'required',
        ]);

        if($request->hasFile('tm_image')){
            $imagePath = $request->file('tm_image')->store('testimonial','public');
        }

        $update = Testimonial::find($request->tm_id);
        $update->name = $request->tm_name;
        $update->profession = $request->tm_profession;
        $update->description = $request->tm_description;
        if($request->hasFile('tm_image')){
            $update->image = $imagePath;
        }

        $update->save();

        return redirect()->back()->with('success','Testimonial Updated Successfully!');
    }

    public function deleteTestimonial($id){
        $delete = Testimonial::find($id);
        $delete->delete();

        return redirect()->back()->with('success','Testimonial Deleted Succesfully !');
    
    }

}
