@section('meta_title') Report | Fire alram @endsection
@extends('Admin.Layouts.layout')
@section('css')
@endsection

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        {{-- <h3 style="color:red">Alarm Management</h3> --}}
                        <div class="mb-2 justify-content-between d-flex align-items-center">
                            <h4 class="mt-0 header-title">Report</h4>
                        </div>

                         <!-- Buttons for Report Types -->
                    <div class="mb-3">

                        <a href="#" class="btn btn-primary waves-effect waves-light export-btn">
                            <span class="btn-label"><i class="fas fa-file-export"></i></span> Export Monthly Report
                        </a>

                        <a href="#" class="btn btn-primary waves-effect waves-light export-btn">
                            <span class="btn-label"><i class="fas fa-file-export"></i></span> Export Weekly Report
                        </a>

                        <a href="#" class="btn btn-primary waves-effect waves-light export-btn">
                            <span class="btn-label"><i class="fas fa-file-export"></i></span> Daily Monthly Report
                        </a>
                    
                    </div>

                  
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive department-card">

                            <div class="d-flex justify-content-end align-items-center mb-3">
                               
                                <div class="filter-dropdown ms-2">
                                    <label for="alarmFilter" class="form-label me-2">Filter by Alarm Status:</label>
                                    <select id="alarmFilter" class="form-select" onchange="filterAlarms()">
                                        <option value="">All Alarms</option>
                                        <option value="active">Active Alarm</option>
                                        <option value="fixed">Fixed Alarm</option>
                                        <option value="missfire">Miss Fire Alarm</option>
                                    </select>
                                </div>
                                <div class="filter-dropdown ms-2">
                                    <label for="deviceTypeFilter" class="form-label me-2">Filter by Device Type:</label>
                                    <select id="deviceTypeFilter" class="form-select" onchange="filterAlarms()">
                                        <option value="">All Device Types</option>
                                        <option value="smoke_detector">Smoke Detector</option>
                                        <option value="heat_detector">Heat Detector</option>
                                        <option value="carbon_monoxide_detector">Carbon Monoxide Detector</option>
                                    </select>
                                </div>
                                <div class="filter-dropdown ms-2">
                                    <label for="siteFilter" class="form-label me-2">Filter by Site:</label>
                                    <select id="siteFilter" class="form-select" onchange="filterAlarms()">
                                        <option value="">All Sites</option>
                                        <option value="phursungi_pune">Phursungi Pune</option>
                                        <option value="site_b">Site B</option>
                                        <option value="site_c">Site C</option>
                                    </select>
                                </div>
                            </div>

                            <table id="cims_data_table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                                <thead class="table-light">
                                    <tr role="row">
                                        <th>Sr no</th>
                                        <th>Alarm</th>
                                        <th>Customer</th>
                                        <th>Device Type</th>
                                        <th>Device ID</th>
                                        <th>Location</th>
                                        <th>Mobile No.</th>
                                        <th>Alarm Status</th>
                                        <th>Date</th> 
                                        <th>Description</th>
                                        {{-- <th>Status</th>
                                        <th>Action</th> --}}
                                    </tr>
                                </thead>

                                <tbody>

                                <tr>
                                <td>1</td>
                                <td>Fire Detect</td>
                                <td>Codepix</td>
                                <td>Smoke Detector</td>
                                <td><a href="#">TOR2314233</a></td>
                                <td>Phursungi Pune</td>
                                <td>+91-8857945412</td>
                                <td class="status-green">Miss fire</td>
                                <td>12/11/2024 16:14:45</td>
                                <td>Signals the presence of smoke in a specific area.</td>
                                    
                                    {{-- <td><a href="javascript:void(0)" data-id="4" data-table="role_privileges" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a></td>

                                    <td>
                                        <a href="http://127.0.0.1:8000/admin/roles-privileges/edit/4"> <button type="button" data-id="4" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a> 
                                        <a href="javascript:void;" data-id="4" data-table="role_privileges" data-flash="Roles And Privileges Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                   </td> --}}
                                </tr>


                                <tr>
                                <td>2</td>
                                <td>Fire Detect</td>
                                <td>Codepix</td>
                                <td>Smoke Detector</td>
                                <td><a href="#">TOR2314233</a></td>
                                <td>Phursungi Pune</td>
                                <td>+91-8857945412</td>
                                <td class="status-green">Miss fire</td>
                                <td>12/11/2024 16:14:45</td>
                                <td>Signals the presence of smoke in a specific area.</td>
                                    {{-- <td><a href="javascript:void(0)" data-id="4" data-table="role_privileges" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a></td>

                                    <td>
                                        <a href="http://127.0.0.1:8000/admin/roles-privileges/edit/4"> <button type="button" data-id="4" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a> 
                                        <a href="javascript:void;" data-id="4" data-table="role_privileges" data-flash="Roles And Privileges Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                   </td> --}}
                                </tr>
                                <tr>
                                <td>3</td>
                                <td>Fire Detect</td>
                                <td>Codepix</td>
                                <td>Smoke Detector</td>
                                <td><a href="#">TOR2314233</a></td>
                                <td>Phursungi Pune</td>
                                <td>+91-8857945412</td>
                                <td class="status-green">Miss fire</td>
                                <td>12/11/2024 16:14:45</td>
                                <td>Signals the presence of smoke in a specific area.</td>
                                    {{-- <td><a href="javascript:void(0)" data-id="4" data-table="role_privileges" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a></td>

                                    <td>
                                        <a href="http://127.0.0.1:8000/admin/roles-privileges/edit/4"> <button type="button" data-id="4" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a> 
                                        <a href="javascript:void;" data-id="4" data-table="role_privileges" data-flash="Roles And Privileges Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                   </td> --}}
                                </tr>
                                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div> 
</div>

@endsection



