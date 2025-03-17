<?php

namespace App\Http\Controllers\Admin;
use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function Index()
    {
        $sliders = Slider::all();
        return view('admin.home.slider',compact('sliders'));
    }

    public function storeslider(Request $request)
    {
        $validatedData = $request->validate([
            'top_sub_heading'       => 'required|string',
            'heading'               => 'required|string|max:255',
            'bottom_sub_heading'    => 'required|string|max:255',
            'image'                 => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'more_info_link'        => 'nullable|url',
        ]);

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slides','public');
        }

        Slider::create([
            'top_sub_heading'     => $validatedData['top_sub_heading'],
            'heading'             => $validatedData['heading'],
            'bottom_sub_heading'  => $validatedData['bottom_sub_heading'],
            'image_link'          => $imagePath,
            'more_info_link'      => $validatedData['more_info_link'],
        ]);

        return redirect()->back()->with('success','Slide added succesfully !');
    }

    public function updateslider(Request $request){
        $validatedData = $request->validate([
            'top_sub_heading'       => 'required|string',
            'heading'               => 'required|string|max:255',
            'bottom_sub_heading'    => 'required|string|max:255',
            'more_info_link'        => 'nullable|url',
        ]);

        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('slides','public');
        }

        $update = Slider::find($request->slider_id);
        $update->top_sub_heading = $validatedData['top_sub_heading'];
        $update->heading = $validatedData['heading'];
        $update->bottom_sub_heading = $validatedData['bottom_sub_heading'];

        if($request->hasFile('image')){
            $update->image_link = $imagePath;
        }
        $update->more_info_link = $validatedData['more_info_link'];
        $update->save();

        return redirect()->back()->with('success','Slide updated succesfully !');
    }

    public function deleteSlider($id){
        $delete = Slider::find($id);
        $delete->delete();

        return redirect()->back()->with('success','Slide deleted succesfully !');

    }
}

