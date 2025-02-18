@section('meta_title') Dashboard | Fire alram @endsection
@extends('Admin.Layouts.layout')
@section('css')

<style>
    .card {
        display: block;
        min-width: 0;
        word-wrap: break-word;
        background-color: var(--ct-card-bg);
        background-clip: border-box;
        /* border: 0 solid var(--ct-card-border-color);
        border-radius: 0.25rem; */
        padding: 0px !important;
    }





    .card-body {
        flex: 1 1 auto;
        /* padding: 1rem; */
        /* box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important; */
        border-radius: 0.5rem;
        width: 100%;
    }

    .morris-donut-example svg text tspan {
        font-size: 10px !important;
    }

    .content {
        /* padding-top: 25px; */
    }

    .random {
        display: none;
    }
    .content-page {
    padding: 0 12px 40px 12px;
}
</style>
@endsection
@section('content')

<div class="content-page">
    <div class="content">
        <div class="container-fluid dashboard-cards">
            
            <div class="row">

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Clients</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-account-multiple text-dark"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> 2 </h2>
                                    <p class="text-muted mb-1">Total Clients</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Sites</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-office-building text-warning"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1">{{ $totalSiteCount }}</h2>
                                    <p class="text-muted mb-1">Total Assign Device</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Assigned Site
                            </h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-clipboard-list text-danger"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> 100 </h2>
                                    <p class="text-muted mb-1">Total Assigned Site</p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Devices</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-television"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> {{ $totalDeviceCount }} </h2>
                                    <p class="text-muted mb-1">Total Device Count</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4"> Assigned Devices</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-clipboard-list text-purple"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> 2 </h2>
                                    <p class="text-muted mb-1">Total Assigned Device</p>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

              


                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Total Alarms</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-alarm-light text-secondary"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> 1 </h2>
                                    <p class="text-muted mb-1">Total Alarms</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Active Alarms</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-alarm-light text-danger"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> 0 </h2>
                                    <p class="text-muted mb-1">Active Alarms</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Acknowledged Alarms</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-alarm-light text-warning"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> 2 </h2>
                                    <p class="text-muted mb-1">Acknowledged Alarms</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

               

            </div>
        
        </div>




        



        <div class="row">
            <div class="col-12">
                <div class="card">
              
                    <div class="card-body table-responsive department-card">

                        {{-- <div class="header">Latest Event / Alarm</div>

                        <h4 class="mt-0 header-title">Latest Event / Alarm</h4> --}}

                        <div class="mb-2 justify-content-between d-flex align-items-center">
                            <h4 class="mt-0 header-title">Latest Event / Alarm</h4>
                        </div>


                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 event-details">
                                            <div>Device ID <a href="#">TOR2314232</a></div>
                                            <div>Device Type: Smoke Detector</div>
                                            <div>Event Type: Miss fire</div>
                                            <div>Location: Phursungi, Pune</div>
                                        </div>
                                        <div class="col-md-6 event-status text-md-right">
                                            <div class="date-time">Date & Time: 12/11/2024 16:14:45</div>
                                            <div class="status status-missfire">Miss fire</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 event-details">
                                            <div>Device ID <a href="#">TOR2314232</a></div>
                                            <div>Device Type: Smoke Detector</div>
                                            <div>Event Type: Miss fire</div>
                                            <div>Location: Phursungi, Pune</div>
                                        </div>
                                        <div class="col-md-6 event-status text-md-right">
                                            <div class="date-time">Date & Time: 12/11/2024 16:14:45</div>
                                            <div class="status status-missfire">Miss fire</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 event-details">
                                            <div>Device ID <a href="#">TOR2314232</a></div>
                                            <div>Device Type: Smoke Detector</div>
                                            <div>Event Type: Miss fire</div>
                                            <div>Location: Phursungi, Pune</div>
                                        </div>
                                        <div class="col-md-6 event-status text-md-right">
                                            <div class="date-time">Date & Time: 12/11/2024 16:14:45</div>
                                            <div class="status status-missfire">Miss fire</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        


            
                        





                    </div>
                </div>


            </div>
        </div> 

        <!-- New -->
        
            <div class="row">
                <div class="col-12">
                    <div class="card">
                  
                        <div class="card-body table-responsive department-card">
                            {{-- <h2>Recently Active Device List</h2> --}}

                            <div class="mb-2 justify-content-between d-flex align-items-center">
                                <h4 class="mt-0 header-title">Recently Active Device List</h4>
                            </div>

                            <table id="cims_data_table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                                <thead class="table-light">
                                    <tr role="row">
                                       

                                        <th>Sr no</th>
                                        <th>Device Id</th>
                                        <th>Device Type</th>
                                        <th>Location</th>
                                        <th>Date Time</th>
                                        <th>Status</th>
                                        <th>Action</th>


                                    </tr>
                                </thead>

                                <tbody>

                                  <tr>
                                    <td data-label="Sr no">01</td>
                                    <td data-label="Device Id"><a href="#">TOR2314232</a></td>
                                    <td data-label="Device Type">Smoke Detector</td>
                                    <td data-label="Location">Phursungi, Pune</td>
                                    <td data-label="Date Time">12/11/2024 16:14:45</td>
                             

                                    <td><a href="javascript:void(0)" data-id="4" data-table="role_privileges" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a></td>

                                    <td>
                                        <a href="http://127.0.0.1:8000/admin/roles-privileges/edit/4"> <button type="button" data-id="4" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a> 
                                        <a href="javascript:void;" data-id="4" data-table="role_privileges" data-flash="Roles And Privileges Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                   </td>
                                
                                </tr>
                                <tr>
                                    <td data-label="Sr no">02</td>
                                    <td data-label="Device Id"><a href="#">TOR2314233</a></td>
                                    <td data-label="Device Type">Smoke Detector</td>
                                    <td data-label="Location">Phursungi, Pune</td>
                                    <td data-label="Date Time">12/11/2024 16:14:45</td>
                                    <!-- <td data-label="Status" class="status"><span class="dot red"></span></td>
                                    <td>
                                        <a href="http://127.0.0.1:8000/admin/roles-privileges/edit/4"> <button type="button" data-id="4" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a> 
                                        <a href="javascript:void;" data-id="4" data-table="role_privileges" data-flash="Roles And Privileges Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                   </td> -->

                                   <td><a href="javascript:void(0)" data-id="4" data-table="role_privileges" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a></td>

                                    <td>
                                        <a href="http://127.0.0.1:8000/admin/roles-privileges/edit/4"> <button type="button" data-id="4" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a> 
                                        <a href="javascript:void;" data-id="4" data-table="role_privileges" data-flash="Roles And Privileges Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td data-label="Sr no">03</td>
                                    <td data-label="Device Id"><a href="#">TOR2314233</a></td>
                                    <td data-label="Device Type">Smoke Detector</td>
                                    <td data-label="Location">Phursungi, Pune</td>
                                    <td data-label="Date Time">12/11/2024 16:14:45</td>
                                    <!-- <td data-label="Status" class="status"><span class="dot red"></span></td>
                                    <td>
                                        <a href="http://127.0.0.1:8000/admin/roles-privileges/edit/4"> <button type="button" data-id="4" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a> 
                                        <a href="javascript:void;" data-id="4" data-table="role_privileges" data-flash="Roles And Privileges Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                   </td> -->

                                    <td><a href="javascript:void(0)" data-id="4" data-table="role_privileges" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a></td>

                                    <td>
                                        <a href="http://127.0.0.1:8000/admin/roles-privileges/edit/4"> <button type="button" data-id="4" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a> 
                                        <a href="javascript:void;" data-id="4" data-table="role_privileges" data-flash="Roles And Privileges Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="mdi mdi-trash-can"></i></a>
                                    </td>
                                </tr>
                                    
                                </tbody>
                            </table>
                            {{-- <button class="show-alert-button" onclick="showAlert()">Show Alert</button> --}}
                        </div>
                    </div>


                </div>
            </div> 
     




    </div>
</div>

@endsection

{{-- @section('script')
<script>
    var pieCanvas = document.getElementById('support-ticket-pie-chart').getContext('2d');
    var support_counts = JSON.parse($("#support-ticket-pie-chart").attr('data-counts'));
    var pieData = {
        labels: ['Resolved', 'Pending', 'Closed'],
        datasets: [{
            data: support_counts,
            backgroundColor: ["#ff8acc", "#5b69bc", "#f1b53d"],
            hoverBackgroundColor: ["#ff8acc", "#5b69bc", "#f1b53d"],
            hoverBorderColor: "#fff",
        }]
    };
    var myPieChart = new Chart(pieCanvas, {
        type: 'pie',
        data: pieData,
        options: {
            maintainAspectRatio: false,
        }
    });
</script>

<script>
    var doughnutCanvas = document.getElementById('requisition-doughnut-chart').getContext('2d');
    var requisition_counts = JSON.parse($("#requisition-doughnut-chart").attr('data-counts'));
    var doughnutData = {
        labels: ['Completed', 'Pending', 'Rejected'],
        datasets: [{
            data: requisition_counts,
            backgroundColor: ["#ff8acc", "#5b69bc", "#f1b53d"],
            hoverBackgroundColor: ["#ff8acc", "#5b69bc", "#f1b53d"],
            hoverBorderColor: "#fff",
        }]
    };
    var myPieChart = new Chart(doughnutCanvas, {
        type: 'doughnut',
        data: doughnutData,
        options: {
            maintainAspectRatio: false,
        }
    });
</script>
@endsection --}}