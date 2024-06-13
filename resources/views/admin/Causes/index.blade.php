@extends('admin.layouts.index')
@section('Title','Causes')
@section('TitleHeader','Causes')

@section('MainContant')
@include('admin/Causes/modal')
<div class="container-fluid">
    
    <div class="card">
        <div class="card-body wizard-content">
            <div class="card-title d-flex justify-content-end">
                <button type="button" id="add_causes" class=" btn btn-success">Add Causes</button>
            </div>
            <hr>

            <div class="table-responsive">
                <table id="causes_datatable" class="table table-striped table-bordered dataTable" role="grid"
                    aria-describedby="zero_config_info">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Target</th>
                            <th scope="col">Donation</th>
                            <th scope="col">Description</th>
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
<script src="{{asset('admin/js/causes.js')}}"></script>
@endsection