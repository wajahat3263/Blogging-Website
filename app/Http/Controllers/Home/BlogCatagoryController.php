<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BlogCatagory;
use Carbon\Carbon;

class BlogCatagoryController extends Controller
{
    public function AddBlogCatagory(){

        return view('admin.blog_catagory.add_blog_catagory');

    }//end method

    public function StoreBlogCatagory(Request $request){

        BlogCatagory::insert([
            'blog_catagory' => $request->bc_name,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Blog Catagory inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.catagory')->with($notification);

    }//end method

    public function AllBlogCatagory(){

        $all_data = BlogCatagory::latest()->get();//get all data descending
        return view('admin.blog_catagory.all_blog_catagory',compact('all_data'));

    }//end method

    public function EditBlogCatagory($id){

        $data = BlogCatagory::findOrFail($id);
        return view('admin.blog_catagory.edit_blog_catagory',compact('data'));

    }//end method

    public function UpdateBlogCatagory(Request $request){

        $uid = $request->hid;

        $request->validate([
            'bc_name' => 'required',
        ],[
            'bc_name.required' => 'Blog Catagory name is required',
        ]);

        BlogCatagory::findOrFail($uid)->update([
            'blog_catagory' => $request->bc_name
        ]);

        $notification = array(
            'message' => 'Blog Catagory updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method

    public function DeleteBlogCatagory($id){

        BlogCatagory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog catagory deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method




}
