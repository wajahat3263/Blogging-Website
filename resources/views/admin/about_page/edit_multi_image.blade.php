@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Edit About Images</h4><br>
                        <form method="post" action="{{ route('update.multi.image') }}" enctype="multipart/form-data">
                            @csrf                            

                            <input type="hidden" value="{{ $multi_img->id }}" name="hid">

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Edit About Image</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="about_image" type="file" id="about_image">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <img class="rounded avatar-lg" id="show_image" src="{{ asset($multi_img->multi_image) }}" alt="Card image cap">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Image">

                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>


    </div>
</div>

<script>
    $(document).ready(function(){
        $('#about_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#show_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
 

@endsection