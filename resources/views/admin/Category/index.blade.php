@extends('admin.layouts.index')
@section('Title','Category')
@section('TitleHeader','Category')

@section('MainContant')
@include('admin/Category/modal')
<div class="container-fluid">
    
    <div class="card">
        <div class="card-body wizard-content">
            <div class="card-title d-flex justify-content-end">
                <button type="button" id="add_category" class=" btn btn-success">Add Category</button>
            </div>
            <hr>

            <div class="table-responsive">
                <table id="category_datatable" class="table table-striped table-bordered dataTable" role="grid"
                    aria-describedby="zero_config_info">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    </div>


</div>
@endsection
@section('FooterScript')
<script src="{{asset('admin/js/category.js')}}"></script>
@endsection