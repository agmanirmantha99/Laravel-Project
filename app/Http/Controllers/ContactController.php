<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\View;

class ContactController extends Controller
{
    public function index() {
        $contacts = Contact::all();
        return view('admin.Contact',compact('contacts'));   
        
    } 

    public function store(Request $request){

        $request->validate([
            'sender_name' => 'required',
            'sender_email' => 'required',
            'sender_phone' => 'required',
            'sender_subject' => 'required',
            'sender_project' => 'required',
            'sender_message' => 'required',
        ]);

        Contact::create([
            'sender_name' => $request->sender_name ,
            'sender_email' => $request->sender_email,
            'sender_phone' => $request->sender_phone,
            'sender_subject' => $request->sender_subject,
            'sender_project' => $request->sender_project,
            'sender_message' => $request->sender_message,
        ]);

        return redirect()->back()->with('success','Message sent successfully!');
    }
}
