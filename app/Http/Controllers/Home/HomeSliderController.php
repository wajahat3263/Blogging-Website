<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Image;

class HomeSliderController extends Controller
{
    public function HomeSlider() {

        $homeslide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all',compact('homeslide'));
        
    } //end method

    public function UpdateSlider(Request $request){
        $slider_id = $request->id;

        if($request->file('home_slide')){

            $image = $request->file('home_slide');
            $name_gen = hexdec(uniqid()).".".$image->getClientOriginalExtension(); //42342.jpg
            
            Image::make($image)->resize(636,852)->save('uploads/home_slide/'.$name_gen);

            $save_url = 'uploads/home_slide/'.$name_gen;
            
            HomeSlide::findOrFail($slider_id)->update([
                'title'=>$request->title,
                'short_title'=>$request->short_title,
                'home_slide'=>$save_url,
                'video_url'=>$request->video_url,
            ]);

            $notification=array(
                'message'=>'Home Slide Updated with image successfully',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
            

        }else{
            HomeSlide::findOrFail($slider_id)->update([
                'title'=>$request->title,
                'short_title'=>$request->short_title,
                'video_url'=>$request->video_url,
            ]);

            $notification=array(
                'message'=>'Home Slide Updated without image successfully',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }

    } //end method

}
