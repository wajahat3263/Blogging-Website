@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">About Images</h4><br>
                        <form method="post" action="{{ route('store.multi.image') }}" enctype="multipart/form-data">
                            @csrf                            

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Upload Multiple Images</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="about_images[]" type="file" id="about_images" multiple>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                <img class="rounded avatar-lg" id="show_image" src="{{ url('uploads/no_image.jpg') }}" alt="Card image cap">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Images">

                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>


    </div>
</div>

<script>
    $(document).ready(function(){
        $('#about_images').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#show_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
 

@endsection