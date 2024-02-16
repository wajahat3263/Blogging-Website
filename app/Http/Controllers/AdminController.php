<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\alert;
use function PHPSTORM_META\type;

class AdminController extends Controller
{

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }
    //end method


    public function Profile(){
        $id = Auth::user()->id;
        $admin_data=User::find($id);
        return view('admin.admin_profile_view',compact('admin_data'));

    }
    //end method

    public function EditProfile(){
        $id = Auth::user()->id;
        $edit_data=User::find($id);
        return view('admin.admin_profile_edit',compact('edit_data'));

    }
    //end method

    public function StoreProfile(Request $request){
        $id = Auth::user()->id;
        $data=User::find($id);
        //=== database names = form names ===//
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        
        if($request->file('profile_image')){
            $file = $request->file('profile_image');
            $filename = date('YmdHis').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin_images'),$filename);

            $data['profile_image'] = $filename;

        }

        $data->save();

        $notification = array(
            'message' => 'Admin profile updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.profile')->with($notification);

    }
    //end method

    public function ChangePassword(){
        
        return view('admin.admin_change_password');

    }
    //end method

    public function UpdatePassword(Request $request){

        // $validate_data=$request->validate([
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required',
            'confirm_password'=>'required | same:new_password',
        ]);

        $get_old_password=Auth::user()->password;
        if(Hash::check($request->old_password, $get_old_password)){
            $users=User::find(Auth::id());
            $users->password=bcrypt($request->new_password);
            $users->save();
            
            session()->flash('message','Password updated successfully');

            return redirect()->back();
        }else{
            session()->flash('message','Old password not match');

            return redirect()->back();
        }
        

    }
    //end method

}
