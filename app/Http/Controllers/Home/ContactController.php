<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Contact;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function ContactPage(){

        return view('frontend.contact_page');

    }//end method

    public function StoreMessage(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'subject.required' => 'Subject is required',
            'phone.required' => 'Phone is required',
            'message.required' => 'Message is required',
        ]);

        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Message sent successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }//end method

    public function ContactMessage(){

        $all_data = Contact::latest()->get();
        return view('admin.contact_message.contact_message',compact('all_data'));

    }//end method

    public function DeleteMessage($id){

        Contact::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Message deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method


}
