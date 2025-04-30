<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;


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

        $record =Contact::create([
            'sender_name' => $request->sender_name ,
            'sender_email' => $request->sender_email,
            'sender_phone' => $request->sender_phone,
            'sender_subject' => $request->sender_subject,
            'sender_project' => $request->sender_project,
            'sender_message' => $request->sender_message,
        ]);

        if($record){
            $data = [
                'sender_name' => $request->sender_name ,
                'sender_email' => $request->sender_email,
                'sender_phone' => $request->sender_phone,
                'sender_subject' => $request->sender_subject,
                'sender_project' => $request->sender_project,
                'sender_message' => $request->sender_message,
            ];

            Mail::to('sampleoff@gmail.com')->send(new ContactFormMail($data));
        }

        return redirect()->back()->with('success','Message sent successfully!');
    }
}
