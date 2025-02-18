@section('meta_title')
    Dashboard | IOGLOBE
@endsection
@extends('Admin.Layouts.layout')
@section('content')


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



<div class="content-page">
    <div class="content">
        <div class="container-fluid dashboard-cards">
            
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Total Alarm</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-alarm-light text-info"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> {{ $totalAlarmCount }} </h2>
                                    <p class="text-muted mb-1">Total Alarm Count</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">Active Alarm</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-alarm-light text-danger"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> {{ $totalActiveAlarmCount }} </h2>
                                    <p class="text-muted mb-1">Active Alarm Count</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title mt-0 mb-4">ACK. Alarm</h4>
                            <div class="widget-chart-1">
                                <div class="widget-chart-box-1 float-start" dir="ltr">
                                    <i class="mdi mdi-alarm-light text-warning"></i>
                                </div>
                                <div class="widget-detail-1 text-end">
                                    <h2 class="fw-normal pt-2 mb-1"> {{ $totalacknowledgedAlarmCount }} </h2>
                                    <p class="text-muted mb-1">Acknowledged Alaram Count</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        
        </div>



        {{-- <div class="row">
            <div class="col-12">
                <div class="card">
              
                    <div class="card-body table-responsive department-card">

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
        </div>  --}}

        <!-- New -->
        
            <div class="row">
                <div class="col-12">
                    <div class="card">
                  
                 


                        <div class="card-body table-responsive department-card">
                                       
            
                            <div class="mb-2 justify-content-between d-flex align-items-center">
                                <h4 class="mt-0 header-title">Device List</h4>
                            </div>

                            <table id="cims_data_table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                                <thead class="table-light">
                                    <tr role="row">
                                       

                                        <th>Sr no</th>
                                        <th>IO & Slave</th>
                                        <th>Device Image</th>
                                        <th>Connected Device Name</th>
                                        <th>Current Status</th>
                                        <th>Acknowledge</th>
                                     


                                    </tr>
                                </thead>

                                <tbody>

                         
                                    
                                </tbody>
                            </table>
                            
                        </div>


                        
                    </div>


                </div>
            </div> 
     




    </div>
</div>

 
@endsection

@section('script')
<script src="{{ URL::asset('admin_panel/controller_js/cn_client_dashboard.js')}}"></script>

    <script>
        $(".system-user").addClass("menuitem-active");
        $(".system-user-list").addClass("menuitem-active");
    </script>
@endsection
