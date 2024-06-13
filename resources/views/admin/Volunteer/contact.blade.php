@extends('admin.layouts.index')
@section('Title','Contacts')
@section('TitleHeader','Contacts')

@section('MainContant')
{{-- @include('admin/Volunteer/modal') --}}
<div class="container-fluid">
    
    <div class="card">
        <div class="card-body wizard-content">
            {{-- <div class="card-title d-flex justify-content-end">
                <button type="button" id="add_volunteer" class=" btn btn-success">Add Volunteer</button>
            </div> --}}
            <hr>

            <div class="table-responsive">
                <table id="contact_datatable" class="table table-striped table-bordered dataTable" role="grid"
                    aria-describedby="zero_config_info">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
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