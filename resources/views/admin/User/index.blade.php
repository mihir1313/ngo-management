@extends('admin.layouts.index')
@section('Title','Users')
@section('TitleHeader','Users')

@section('MainContant')
@include('admin/User/modal')
<div class="container-fluid">
    <div class="card">
        <div class="card-body wizard-content">
            <div class="card-title d-flex justify-content-end">
                <button type="button" id="add_user" class=" btn btn-success">Add User</button>
            </div>
            <hr>

            <div class="table-responsive">
                <table id="user_datatable" class="table table-striped table-bordered dataTable" role="grid"
                    aria-describedby="zero_config_info">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
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
<script src="{{asset('admin/js/user.js')}}"></script>
@endsection