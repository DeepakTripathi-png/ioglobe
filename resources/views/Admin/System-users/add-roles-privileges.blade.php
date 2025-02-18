@section('meta_title')
    Add Roles & Privileges | Fire Alarm
@endsection
@extends('Admin.Layouts.layout')
@section('content')
    <style>
        .card-body {
            flex: 1 1 auto;
            padding: 1rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
            border-radius: 0.5rem;
            width: 100% !important;
        }
    </style>
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-2 justify-content-between d-flex align-items-center">
                            {{-- <h3 style="color: red">Add New Role</h3> --}}

                            <div class="mb-2 justify-content-between d-flex align-items-center">
                                <h4 class="mt-0 header-title">Add New Role</h4>
                            </div>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary waves-effect waves-light add-btn"><span
                                    class="btn-label"> <i class="fas fa-long-arrow-alt-left"></i></span>Back</a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('roles-previllages.store') }}" method="post">
                                    @csrf
                                    <input type="hidden" class="form-control" id="id" name="id"
                                        value="{{ !empty($role_privileges) ? $role_privileges->id : '' }}">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="mb-2">
                                                <label for="role_name" class="form-label"> Role Name </label>
                                                <input type="text" name="role_name" id="role_name" class="form-control"
                                                    value="{{ !empty($role_privileges->role_name) ? $role_privileges->role_name : old('role_name') }}">
                                                <span class="text-danger d-none" id="role_existence_message"></span>
                                                @if ($errors->has('role_name'))
                                                    <span class="text-danger"><b>*
                                                            {{ $errors->first('role_name') }}</b></span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <label> Privileges </label>
                                            @if ($errors->has('privileges'))
                                                <span class="text-danger"><b>* {{ $errors->first('privileges') }}</b></span>
                                            @endif
                                            <label style="float:right;"><span style="padding-right:5px;">Select All</span>
                                                <input value="select_all" id="select_all" class="select_all"
                                                    type="checkbox">
                                            </label>
                                        </div>
                                        <div class="col-12">
                                            <table class="table color-table info-table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th width="10%" class="text-center">Sr. No.</th>
                                                        <th width="30%">Pages</th>
                                                        <th width="10%" class="text-center">View</th>
                                                        <th width="10%" class="text-center">Add</th>
                                                        <th width="10%" class="text-center">Edit</th>
                                                        <th width="10%" class="text-center">Delete</th>
                                                        <th width="10%" class="text-center">Active/Inactive</th>
                                                        <th width="10%" class="text-center">Other</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="role-privileges-table">
                                                    <tr>
                                                        <td class="text-center">1</td>
                                                        <td>Select All</td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-view"></td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-add"></td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-edit"></td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-delete"></td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-status"></td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-other"></td>
                                                    </tr>
                                                    <!-- dashboard -->
                                                    <tr>
                                                        <td class="text-center">2</td>
                                                        <td>Dashboard</td>
                                                        <td class="text-center"><input type="checkbox" name="privileges[]"
                                                                id="dashboard_view" class="ccheckbox view"
                                                                value="dashboard_view"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'dashboard_view') ? 'checked' : '' }}>
                                                        </td>

                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>
                                                    </tr>
                                                    
                                                     
                                                    

                                                    <tr>
                                                        <td class="text-center">3</td>
                                                        <td>Master > Site Master</td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="site_master_view"
                                                                class="ccheckbox view" value="site_master_view"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'site_master_view') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="site_master_add"
                                                                class="ccheckbox add" value="site_master_add"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'site_master_add') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="site_master_edit"
                                                                class="ccheckbox edit" value="site_master_edit"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'site_master_edit') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="site_master_delete"
                                                                class="ccheckbox deletes" value="site_master_delete"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'site_master_delete') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="site_master_status_change"
                                                                class="ccheckbox status" value="site_master_status_change"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'site_master_status_change') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-other"></td>

                                                    </tr>
                                                   


                                                    <tr>
                                                        <td class="text-center">4</td>
                                                        <td>Master > Device </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="device_type_master_view"
                                                                class="ccheckbox view" value="device_type_master_view"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'device_type_master_view') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="device_master_add"
                                                                class="ccheckbox add" value="device_master_add"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'device_master_add') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="device_master_edit"
                                                                class="ccheckbox edit" value="device_master_edit"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'device_master_edit') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="device_type_master_delete"
                                                                class="ccheckbox deletes" value="device_type_master_delete"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'device_type_master_delete') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="device_type_master_status_change"
                                                                class="ccheckbox status" value="device_type_master_status_change"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'device_type_master_status_change') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-other"></td>

                                                    </tr>



                                                    
                                                    <tr>
                                                        <td class="text-center">5</td>
                                                        <td>Master > Slave Device </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="slave_device_master_view"
                                                                class="ccheckbox view" value="slave_device_master_view"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'slave_device_master_view') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="slave_device_master_add"
                                                                class="ccheckbox add" value="slave_device_master_add"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'slave_device_master_add') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="slave_device_master_edit"
                                                                class="ccheckbox edit" value="slave_device_master_edit"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'slave_device_master_edit') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="slave_device_master_delete"
                                                                class="ccheckbox deletes" value="slave_device_master_delete"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'slave_device_master_delete') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="slave_device_master_status_change"
                                                                class="ccheckbox status" value="slave_device_master_status_change"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'slave_device_master_status_change') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-other"></td>

                                                    </tr>

                                               






                                                    <tr>
                                                        <td class="text-center">3</td>
                                                        <td>Role Management > Role & Previleges</td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="role_privileges_view" class="ccheckbox view"
                                                                value="role_privileges_view"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'role_privileges_view') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="role_privileges_add " class="ccheckbox add"
                                                                value="role_privileges_add "
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'role_privileges_add') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="role_privileges_edit" class="ccheckbox edit"
                                                                value="role_privileges_edit"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'role_privileges_edit') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="role_privileges_delete"
                                                                class="ccheckbox deletes" value="role_privileges_delete"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'role_privileges_delete') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="role_privileges_status_change"
                                                                class="ccheckbox status" value="role_privileges_status_change"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'role_privileges_status_change') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-other"></td>
                                                    </tr>


                                                    <tr>
                                                        <td class="text-center">3</td>
                                                        <td>Role Management > System User</td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="user_view"
                                                                class="ccheckbox view" value="user_view"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'user_view') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="user_add"
                                                                class="ccheckbox add" value="user_add"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'user_add') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="user_edit"
                                                                class="ccheckbox edit" value="user_edit"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'user_edit') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="user_delete"
                                                                class="ccheckbox deletes" value="user_delete"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'user_delete') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="user_status_change"
                                                                class="ccheckbox status" value="user_status_change"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'user_status_change') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-other"></td>
                                                    </tr>


                                                    
                                                    <tr>
                                                        <td class="text-center">3</td>
                                                        <td>IO & Slave Management</td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="io_slave_management_view"
                                                                class="ccheckbox view" value="io_slave_management_view"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'io_slave_management_view') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="io_slave_management_add" class="ccheckbox add"
                                                                value="io_slave_management_add"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'io_slave_management_add') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="io_slave_management_edit"
                                                                class="ccheckbox edit" value="io_slave_management_edit"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'io_slave_management_edit') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="io_slave_management_delete"
                                                                class="ccheckbox deletes" value="io_slave_management_delete"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'io_slave_management_delete') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="io_slave_management_status_change"
                                                                class="ccheckbox status" value="io_slave_management_status_change"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'io_slave_management_status_change') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-other"></td>
                                                    </tr>



                                                    <tr>
                                                        <td class="text-center">3</td>
                                                        <td>Device Management</td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="device_view"
                                                                class="ccheckbox view" value="device_view"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'device_view') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="device_add" class="ccheckbox add"
                                                                value="device_add"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'device_add') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="device_edit"
                                                                class="ccheckbox edit" value="device_edit"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'device_edit') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="device_delete"
                                                                class="ccheckbox deletes" value="device_delete"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'device_delete') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="device_status"
                                                                class="ccheckbox status" value="device_status"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'device_status') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-other"></td>
                                                    </tr>


                                                    <tr>
                                                        <td class="text-center">3</td>
                                                        <td>Site Management</td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="map_site_view"
                                                                class="ccheckbox view" value="map_site_view"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'map_site_view') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="map_site_add"
                                                                class="ccheckbox add" value="map_site_add"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'map_site_add') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="map_site_edit"
                                                                class="ccheckbox edit" value="map_site_edit"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'map_site_edit') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="map_site_delete"
                                                                class="ccheckbox deletes" value="map_site_delete"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'map_site_delete') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="map_site_status"
                                                                class="ccheckbox status" value="map_site_status"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'map_site_status') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-other"></td>
                                                    </tr>





                                                    <!-- Alarm Master -->
                                                    <tr>
                                                        <td class="text-center">2</td>
                                                        <td>Alarm</td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="alarm_view"
                                                                class="ccheckbox view" value="alarm_view"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'alarm_view') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="alarm_edit"
                                                                class="ccheckbox edit" value="alarm_edit"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'alarm_edit') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="alarm_add" class="ccheckbox add"
                                                                value="alarm_add"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'alarm_add') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="alarm_delete"
                                                                class="ccheckbox delete" value="alarm_delete"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'alarm_delete') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="alarm_status"
                                                                class="ccheckbox status" value="alarm_status"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'alarm_status') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-other"></td>
                                                    </tr>


                                                    <!-- Reports Master -->
                                                    <tr>
                                                        <td class="text-center">2</td>
                                                        <td>Reports</td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="report_view"
                                                                class="ccheckbox view" value="report_view"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'report_view') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="report_add"
                                                                class="ccheckbox edit" value="report_add"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'report_add') ? 'checked' : '' }}>
                                                        </td>


                                                        <td class="text-center"></td>
                                                        <td class="text-center"></td>

                                                        <td class="text-center"></td>

                                                        <td class="text-center"></td>


                                                        {{-- <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="report_edit"
                                                                class="ccheckbox view" value="report_edit"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'report_edit') ? 'checked' : '' }}>
                                                        </td>

                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="report_delete"
                                                                class="ccheckbox delete" value="report_delete"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'report_delete') ? 'checked' : '' }}>
                                                        </td>
                                                        <td class="text-center"><input type="checkbox"
                                                                name="privileges[]" id="report_status_change"
                                                                class="ccheckbox status" value="report_status_change"
                                                                {{ isset($role_privileges) && !empty($role_privileges->privileges) && str_contains($role_privileges->privileges, 'report_status_change') ? 'checked' : '' }}>
                                                        </td> --}}
                                                        {{-- <td class="text-center"><input type="checkbox"
                                                                class="ccheckbox all-other"></td> --}}
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <button class="btn btn-success" type="submit" id="submit-btn">
                                        {{ !empty($system_user) ? 'Update' : 'Submit' }} </button>
                                    @if (empty($system_user))
                                        <button type="reset" class="btn btn-danger"> Cancel </button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(".system-user").addClass("menuitem-active");
        $(".role-privileges").addClass("menuitem-active");
    </script>

    <script>
        $(document).ready(function() {
            $('#role-privileges-table tr').each(function(index) {
                $(this).find('td:first').html(index + 1);
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $("#role_name").on("keyup", function() {
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/roles-privileges/check-role-exist') }}",
                    data: {
                        role_name: $(this).val(),
                        role_id: $("#id").val()
                    },
                    success: function(response) {
                        if (response.trim() == "true") {
                            $("#submit-btn").attr("disabled", true);
                            $("#role_existence_message").removeClass("d-none");
                            $("#role_existence_message").html(
                                "<b>*</b> This Role has already been taken");
                        } else {
                            $("#role_existence_message").addClass("d-none");
                            $("#role_existence_message").html("");
                            $("#submit-btn").removeAttr("disabled");
                        }
                    }
                })
            })
        })
    </script>

    <script>
        // all view select
        $('.all-view').on('change', function() {
            if ($('.all-view').is(":checked")) {
                $('.view').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('.view').each(function() {
                    $(this).prop('checked', false);
                });
            }
        })

        $('.view').on('change', function() {
            $('.view').each(function() {
                if ($(this).is(":checked")) {
                    $('.all-view').prop('checked', true);
                } else {
                    $('.all-view').prop('checked', false);
                    return false;
                }
            })
        })

        // all add select
        $('.all-add').on('change', function() {
            if ($('.all-add').is(":checked")) {
                $('.add').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('.add').each(function() {
                    $(this).prop('checked', false);
                });
            }
        })

        $('.add').on('change', function() {
            $('.add').each(function() {
                if ($(this).is(":checked")) {
                    $('.all-add').prop('checked', true);
                } else {
                    $('.all-add').prop('checked', false);
                    return false;
                }
            })
        })

        // all edit select
        $('.all-edit').on('change', function() {
            if ($('.all-edit').is(":checked")) {
                $('.edit').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('.edit').each(function() {
                    $(this).prop('checked', false);
                });
            }
        })

        $('.edit').on('change', function() {
            $('.edit').each(function() {
                if ($(this).is(":checked")) {
                    $('.all-edit').prop('checked', true);
                } else {
                    $('.all-edit').prop('checked', false);
                    return false;
                }
            })
        })

        // all deletes select
        $('.all-delete').on('change', function() {
            if ($('.all-delete').is(":checked")) {
                $('.deletes').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('.deletes').each(function() {
                    $(this).prop('checked', false);
                });
            }
        })

        $('.delete-privilege').on('change', function() {
            $('.delete-privilege').each(function() {
                if ($(this).is(":checked")) {
                    $('.all-delete').prop('checked', true);
                } else {
                    $('.all-delete').prop('checked', false);
                    return false;
                }
            })
        })

        // all status select
        $('.all-status').on('change', function() {
            if ($('.all-status').is(":checked")) {
                $('.status').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('.status').each(function() {
                    $(this).prop('checked', false);
                });
            }
        })

        $('.status').on('change', function() {
            $('.status').each(function() {
                if ($(this).is(":checked")) {
                    $('.all-status').prop('checked', true);
                } else {
                    $('.all-status').prop('checked', false);
                    return false;
                }
            })
        })

        // all other select
        $('.all-other').on('change', function() {
            if ($('.all-other').is(":checked")) {
                $('.other').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('.other').each(function() {
                    $(this).prop('checked', false);
                });
            }
        })

        $('.other').on('change', function() {
            $('.other').each(function() {
                if ($(this).is(":checked")) {
                    $('.all-other').prop('checked', true);
                } else {
                    $('.all-other').prop('checked', false);
                    return false;
                }
            })
        })

        // Select All
        $('.select_all').on('change', function() {
            if ($('.select_all').is(":checked")) {
                $('.ccheckbox').each(function() {
                    $(this).prop('checked', true);
                });
            } else {
                $('.ccheckbox').each(function() {
                    $(this).prop('checked', false);
                });
            }
        })
    </script>
@endsection
