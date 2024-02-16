<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\BlogCatagory;
use Carbon\Carbon;
use Image;

class BlogController extends Controller
{
    public function AddBlog(){

        $data = BlogCatagory::orderBy('blog_catagory','ASC')->get();
        return view('admin.blogs.add_blog',compact('data'));

    }//end method

    public function StoreBlog(Request $request){

        $request->validate([
            'bc_id' => 'required',
            'b_title' => 'required',
            'b_tags' => 'required',
            'b_image' => 'required',
        ],[
            'bc_id.required' => 'Blog Catagory name is required',
            'b_title.required' => 'Blog title is required',
            'b_tags.required' => 'Blog Tag is required',
            'b_image.required' => 'Blog image is required',
        ]);

        $image = $request->file('b_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(430,327)->save('uploads/blog_images/'.$name_gen);
        $save_url = 'uploads/blog_images/'.$name_gen;

        Blog::insert([
            'blog_catagory_id' => $request->bc_id,
            'blog_title' => $request->b_title,
            'blog_tags' => $request->b_tags,
            'blog_description' => $request->b_description,
            'blog_image' => $save_url,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Blog inserted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog')->with($notification);

    }//end method

    public function AllBlog(){

        $all_data = Blog::latest()->get();//get all data descending
        return view('admin.blogs.all_blog',compact('all_data'));

    }//end method

    public function EditBlog($id){

        $blog_cat = BlogCatagory::orderBy('blog_catagory','ASC')->get();

        $data = Blog::findOrFail($id);
        return view('admin.blogs.edit_blog',compact('data','blog_cat'));

    }//end method

    public function UpdateBlog(Request $request){

        $request->validate([
            'bc_id' => 'required',
            'b_title' => 'required',
            'b_tags' => 'required',
        ],
        [
            'bc_id.required' => 'Blog Catagory name is required',
            'b_title.required' => 'Blog title is required',
            'b_tags.required' => 'Blog Tag is required',
        ]);

        if ($request->file('b_image')) {
            
            $uid = $request->hid;

            $image = $request->file('b_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(430,327)->save('uploads/blog_images/'.$name_gen);
            $save_url = 'uploads/blog_images/'.$name_gen;

            //unlink old image
            $old_img = Blog::findOrFail($uid);
            $old_url = $old_img->blog_image;

            Blog::findOrFail($uid)->update([
                'blog_catagory_id' => $request->bc_id,
                'blog_title' => $request->b_title,
                'blog_tags' => $request->b_tags,
                'blog_description' => $request->b_description,
                'blog_image' => $save_url
            ]);

            unlink($old_url);//

            $notification = array(
                'message' => 'Blog updated with image successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);

        } else {
            
            $uid = $request->hid;

            Blog::findOrFail($uid)->update([
                'blog_catagory_id' => $request->bc_id,
                'blog_title' => $request->b_title,
                'blog_tags' => $request->b_tags,
                'blog_description' => $request->b_description
            ]);

            $notification = array(
                'message' => 'Blog updated without image successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);

        }
        

        

    }//end method

    public function DeleteBlog($id){

        $old_img = Blog::findOrFail($id);
        $old_url = $old_img->blog_image;
        unlink($old_url);

        Blog::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method


    // frontend
    public function BlogDetails($id){

        $blog_cat = BlogCatagory::orderBy('blog_catagory','Asc')->get();
        $all_blogs = Blog::latest()->limit(5)->get();

        $details = Blog::findOrFail($id);
        return view('frontend.blog_details',compact('details','all_blogs','blog_cat'));

    }//end method

    public function CatagoryPost($id){

        $blog_post = Blog::where('blog_catagory_id',$id)->orderBy('id','DESC')->get();//to get multiple specific id data(loop necessary)
        // $blog_post = Blog::findOrFail($id);//to get single specific id data(cannot use loop)
        $all_blogs = Blog::latest()->limit(5)->get();
        $blog_cat = BlogCatagory::orderBy('blog_catagory','Asc')->get();
        $cat_name = BlogCatagory::findOrFail($id);

        return view('frontend.catagory_wise_blogs',compact('blog_post','all_blogs','blog_cat','cat_name'));

    }//end method
    
    public function BlogsAll(){

        // $blogs_all = Blog::latest()->get();
        $blogs = Blog::latest()->paginate(3);
        $blog_cat = BlogCatagory::orderBy('blog_catagory','Asc')->get();
        $all_blogs = Blog::latest()->limit(5)->get();

        return view('frontend.blogs_all',compact('blogs','blog_cat','all_blogs'));//try to make all names different

    }//end method

    
}
