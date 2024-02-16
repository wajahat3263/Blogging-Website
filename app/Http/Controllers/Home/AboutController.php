<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Carbon\Carbon;//to use datetime
use Image;//to use image intervation package

class AboutController extends Controller
{                   
                    // method
    public function AboutPage() {
                    //model
        $aboutpage = About::find(1);
        return view('admin.about_page.about_page_all',compact('aboutpage'));
        
    } //end method

    public function UpdateAbout(Request $request){
        $about_id = $request->id;

        if($request->file('about_image')){

            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()).".".$image->getClientOriginalExtension(); //42342.jpg
            
            Image::make($image)->resize(523,605)->save('uploads/home_about/'.$name_gen);

            $save_url = 'uploads/home_about/'.$name_gen;
            
            About::findOrFail($about_id)->update([
                'title'=>$request->title,
                'short_title'=>$request->short_title,
                'short_description'=>$request->short_description,
                'long_description'=>$request->long_description,
                'about_image'=>$save_url,
            ]);

            $notification=array(
                'message'=>'About Page Updated with image successfully',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
            

        }else{
            About::findOrFail($about_id)->update([
                'title'=>$request->title,
                'short_title'=>$request->short_title,
                'short_description'=>$request->short_description,
                'long_description'=>$request->long_description,
            ]);

            $notification=array(
                'message'=>'About Page Updated without image successfully',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }

    } //end method


    public function HomeAbout(){
        $aboutpage = About::find(1);
        return view('frontend.about_page',compact('aboutpage'));
    } //end method


    public function AboutImages(){
        return view('admin.about_page.multiimage');
    } //end method


    public function StoreMultiImage(Request $request){

        if ($request->file('about_images')) {
            
            $image = $request->file('about_images');
            foreach ($image as $multi_image) {

                $name_gen = hexdec(uniqid()).".".$multi_image->getClientOriginalExtension(); //42342.jpg
                
                Image::make($multi_image)->resize(220,220)->save('uploads/about_multi_image/'.$name_gen);

                $save_url = 'uploads/about_multi_image/'.$name_gen;
                
                MultiImage::insert([
                    'multi_image'=>$save_url,
                    'created_at'=>Carbon::now()
                ]);

            }

            $notification=array(
                'message'=>'Multiple images inserted successfully',
                'alert-type'=>'success'
            );
            return redirect()->route('all.about.images')->with($notification);

        } else {
            
            $notification=array(
                'message'=>'Please select image',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);

        }
        
        
        

    } //end method


    public function AllAboutImages(){
        $all_about_images = MultiImage::all();
        return view('admin.about_page.all_multiimage',compact('all_about_images'));
    } //end method


    public function EditMultiImage($eid){

        $multi_img = MultiImage::findOrFail($eid);
        return view('admin.about_page.edit_multi_image',compact('multi_img'));

    } //end method


    public function UpdateMultiImage(Request $request){

        $edit_id = $request->hid;
        if ($request->file('about_image')) {
            
            $image = $request->file('about_image');
            $name_gen = hexdec(uniqid()).".".$image->getClientOriginalExtension(); //42342.jpg
            
            Image::make($image)->resize(220,220)->save('uploads/about_multi_image/'.$name_gen);

            $save_url = 'uploads/about_multi_image/'.$name_gen;

            $up_img = MultiImage::findOrFail($edit_id);
            $img = $up_img->multi_image;
            unlink($img);
            
            MultiImage::findOrFail($edit_id)->update([
                'multi_image'=>$save_url,
            ]);

            $notification=array(
                'message'=>'Image Updated successfully',
                'alert-type'=>'success'
            );
            return redirect()->route('all.about.images')->with($notification);

        } else {

            $notification=array(
                'message'=>'Please upload image',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);

        }
        
        
            

    } //end method

    public function DeleteMultiImage($did){

        $del_img = MultiImage::findOrFail($did);
        $img = $del_img->multi_image;
        unlink($img);
        MultiImage::findOrFail($did)->delete();
        $notification=array(
            'message'=>'Images deleted successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
        
    } //end method


}
