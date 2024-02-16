@extends('admin.admin_master')
@section('admin')


<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Edit Blog Catagory</h4><br>
                        <form method="post" action="{{ route('update.blog.catagory') }}">
                            @csrf

                            <input type="hidden" name="hid" id="" value="{{ $data->id }}">

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Catagory Name</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name='bc_name' type="text" value="{{ $data->blog_catagory }}">
                                    @error('bc_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Blog Catagory">

                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>


    </div>
</div>

 

@endsection