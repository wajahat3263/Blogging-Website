<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Footer;

class FooterController extends Controller
{
    public function Footer(){

        $data = Footer::findOrFail(1);
        return view('admin.footer.footer',compact('data'));

    }//end method

    public function UpdateFooter(Request $request){

        Footer::findOrFail(1)->update([
            'number' => $request->phone,
            'description' => $request->description,
            'address' => $request->address,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'copyright' => $request->copyright
        ]);

        $notification = array(
            'message' => 'Footer updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }//end method

}
