@extends('admin.admin_master')
@section('admin')


<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Add Blog Catagory</h4><br>
                        <form method="post" id="form" action="{{ route('store.blog.catagory') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Blog Catagory Name</label>
                                <div class="form-group col-sm-10">
                                    <input class="form-control" name='bc_name' type="text">
                                    
                                </div>
                            </div>
                            
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Blog Catagory">

                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>


    </div>
</div>


<!--= jquery form validation script =-->
<script>
    $(document).ready(function (){

        $('#form').validate({
            rules: {
                bc_name: {
                    required: true
                }
            },
            messages: {
                bc_name: {
                    required: 'Please enter blog category name'
                }
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
            
        });


    });
</script>


 

@endsection