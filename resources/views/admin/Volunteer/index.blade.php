@extends('admin.layouts.index')
@section('Title','Volunteer')
@section('TitleHeader','Volunteer')

@section('MainContant')
@include('admin/Volunteer/modal')
<div class="container-fluid">
    
    <div class="card">
        <div class="card-body wizard-content">
            <div class="card-title d-flex justify-content-end">
                <button type="button" id="add_volunteer" class=" btn btn-success">Add Volunteer</button>
            </div>
            <hr>

            <div class="table-responsive">
                <table id="volunteer_datatable" class="table table-striped table-bordered dataTable" role="grid"
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
<script src="{{asset('admin/js/volunteer.js')}}"></script>
@endsection