@extends('admin.admin_master')
@section('admin')


<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Update Blog Page</h4>
                        <form method="post" action="{{ route('update.blog') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{  $data->id }}" name="hid">

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Catagory Name</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" name="bc_id">
                                        <option value="">Please select catagory</option>
                                        @foreach($blog_cat as $cat)
                                            <option value="{{ $cat->id }}" {{ $cat->id == $data->blog_catagory_id ? "selected" : "" }}>{{ $cat->blog_catagory }}</option>
                                        @endforeach
                                    </select>
                                    @error('bc_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name='b_title' type="text" value="{{ $data->blog_title }}">
                                    @error('b_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Tags</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name='b_tags' type="text" value="{{ $data->blog_tags }}" data-role="tagsinput">
                                    @error('b_tags')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Description</label>
                                <div class="col-sm-10">
                                    <textarea id="elm1" name="b_description">{{ $data->blog_description }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name='b_image' type="file" id="b_image">
                                    @error('b_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <img class="rounded avatar-lg" id="show_image" src="{{ !empty($data->blog_image) ? url($data->blog_image) : url('uploads/no_image.jpg') }}" alt="Card image cap">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Blog">

                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>


    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#b_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#show_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
 

@endsection