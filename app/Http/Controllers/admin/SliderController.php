<?php

namespace App\Http\Controllers\Admin;
use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function Index()
    {
        return view('admin.home.slider');
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
}
