@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Data Tables</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                            <li class="breadcrumb-item active">Data Tables</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">All Portfolio</h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Portfolio Name</th>
                                    <th>Portfolio Title</th>
                                    <th>Portfolio Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $i=1
                                @endphp
                                @foreach($all_data as $items)
                                <tr>
                                    <td>{{ $i++}}</td>
                                    <td>{{ $items->portfolio_name }}</td>
                                    <td>{{ $items->portfolio_title }}</td>
                                    <td><img src="{{ asset($items->portfolio_image) }}" alt="" height="45" width="45"></td>
                                    <td>
                                        <a href="{{ route('edit.portfolio',$items->id) }}" class="btn btn-info" title="Edit Data"><i class="fas fa-edit"></i></a>
                                        <a id="delete" href="{{ route('delete.portfolio',$items->id) }}" class="btn btn-danger" title="Delete Data"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->


@endsection