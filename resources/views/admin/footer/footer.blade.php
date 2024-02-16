@extends('admin.admin_master')
@section('admin')



<div class="page-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Footer Page</h4>
                        <form method="post" action="{{ route('update.footer') }}">
                            @csrf

                            <!-- <input type="hidden" name='id' value="{{ $data->id }}"> -->

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name='phone' type="text" id="phone" value="{{ $data->number }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea name='description' class="form-control" rows="5">{{ $data->description }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name='address' type="text" id="address" value="{{ $data->address }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name='email' type="email" id="email" value="{{ $data->email }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Facebook</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name='facebook' type="text" id="facebook" value="{{ $data->facebook }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Twitter</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name='twitter' type="text" id="twitter" value="{{ $data->twitter }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Copyright</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name='copyright' type="text" id="copyright" value="{{ $data->copyright }}">
                                </div>
                            </div>

                            
                            <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Footer">

                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>


    </div>
</div>

 

@endsection