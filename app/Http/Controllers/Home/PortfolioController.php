<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Portfolio;
use Carbon\Carbon;//to use datetime
use Image;//to use image intervation package

class PortfolioController extends Controller
{
    // backend
    public function AddPortfolio(){

        return view('admin.portfolio.add_portfolio');

    }//end method

    public function StorePortfolio(Request $request){

        $request->validate([
            'p_name' => 'required',
            'p_title' => 'required',
            'p_image' => 'required',
        ],[
            'p_name.required' => 'Portfolio name is required',
            'p_title.required' => 'Portfolio title is required',
            'p_image.required' => 'Portfolio image is required',
        ]);

        $image = $request->file('p_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1020,519)->save('uploads/portfolio_image/'.$name_gen);
        $save_url = 'uploads/portfolio_image/'.$name_gen;

        Portfolio::insert([
            'portfolio_name' => $request->p_name,
            'portfolio_title' => $request->p_title,
            'portfolio_image' => $save_url,
            'portfolio_description' => $request->p_description,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Portfolio inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.portfolio')->with($notification);

    }//end method

    public function AllPortfolio(){

        $all_data = Portfolio::latest()->get();//get all data descending
        return view('admin.portfolio.all_portfolio',compact('all_data'));

    }//end method

    public function EditPortfolio($id){

        $data = Portfolio::findOrFail($id);
        return view('admin.portfolio.edit_portfolio',compact('data'));

    }//end method

    public function UpdatePortfolio(Request $request){

        $uid = $request->hid;

        $request->validate([
            'p_name' => 'required',
            'p_title' => 'required',
        ],[
            'p_name.required' => 'Portfolio name is required',
            'p_title.required' => 'Portfolio title is required',
        ]);

        if ($request->file('p_image')) {
            
            $image = $request->file('p_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1020,519)->save('uploads/portfolio_image/'.$name_gen);
            $save_url = 'uploads/portfolio_image/'.$name_gen;
            //unlink old image
            $old_img = Portfolio::findOrFail($uid);
            $old_url = $old_img->portfolio_image;
            unlink($old_url);//

            Portfolio::findOrFail($uid)->update([

                'portfolio_name' => $request->p_name,
                'portfolio_title' => $request->p_title,
                'portfolio_image' => $save_url,
                'portfolio_description' => $request->p_description

            ]);

            $notification = array(
                'message' => 'Portfolio updated with image successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);

        } else {

            Portfolio::findOrFail($uid)->update([

                'portfolio_name' => $request->p_name,
                'portfolio_title' => $request->p_title,
                'portfolio_description' => $request->p_description

            ]);

            $notification = array(
                'message' => 'Portfolio updated without image successfully',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);

        }
        

    }//end method

    public function DeletePortfolio($id){

        $old_img = Portfolio::findOrFail($id);
        $old_url = $old_img->portfolio_image;
        unlink($old_url);

        Portfolio::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Portfolio deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method

    // frontend
    public function PortfolioDetails($id){

        $portfolio = Portfolio::findOrFail($id);
        return view('frontend.portfolio_details', compact('portfolio'));


    }//end method

    public function PortfolioPage(){

        $portfolio = Portfolio::latest()->get();
        return view('frontend.portfolio_page', compact('portfolio'));


    }//end method


}
