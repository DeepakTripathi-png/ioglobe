@section('meta_title') IOSlave | IOGLOBE @endsection
@extends('Admin.Layouts.layout')
@section('css')
@endsection

@section('content')
<style>
.filter-section {
    margin-bottom: 20px;
    display: flex;
    gap: 20px;
    align-items: center;
}

.filter-section label {
    font-weight: bold;
}

.filter-section input,
.filter-section select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 200px;
}
</style>    
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                     

                        <div class="mb-2 justify-content-between d-flex align-items-center">
                            <h4 class="mt-0 header-title">IO&Slave</h4>
                        </div>
                        <a href="{{ url('admin/io-slave/add') }}" class="btn btn-success waves-effect waves-light add-btn" ><span class="btn-label"> <i class="fas fa-plus "></i></span>Add</a>
                    </div>
                    <div class="card">

                        <div class="card-body table-responsive department-card">

                            {{-- <div class="filter-section">
                                <label for="master_device_name">Filter by Master Device Name:</label>
                                <select name="master_device_name"  id="master_device_name">
                                    <option value="all">All</option>
                                    @if(!empty($masterDevices))
                                     @foreach($masterDevices as $masterDevice)
                                       <option value="{{!empty($masterDevice->name)?$masterDevice->device_name:''}}">{{!empty($masterDevice->device_name)?$masterDevice->device_name:''}}</option>
                                     @endforeach
                                   @endif
                                </select>


                                <label for="master_device_id">Filter by Master Device ID:</label>
                                <select  id="master_device_id">
                                    <option name="master_device_id" value="all">All</option>
                                    @if(!empty($masterDevices))
                                    @foreach($masterDevices as $masterDevice)
                                      <option value="{{!empty($masterDevice->device_id)?$masterDevice->device_id:''}}">{{!empty($masterDevice->device_id)?$masterDevice->device_id:''}}</option>
                                    @endforeach
                                  @endif
                                </select>
                                
                                <label for="slave_device_name">Filter by Slave Device Name:</label>
                                <select name="slave_device_name" id="slave_device_name">
                                    <option value="all">All</option>
                                    @if(!empty($slaveDevices))
                                    @foreach($slaveDevices as $slaveDevice)
                                      <option value="{{!empty($slaveDevice->slave_device_name)?$slaveDevice->slave_device_name:''}}">{{!empty($slaveDevice->slave_device_name)?$slaveDevice->slave_device_name:''}}</option>
                                    @endforeach
                                  @endif
                                </select>

                                
                            </div> --}}

                            <div class="filter-section">
                                <label for="master_device_name">Filter by Master Device Name:</label>
                                <select name="master_device_name" id="master_device_name">
                                    <option value="all">All</option>
                                    @if(!empty($masterDevices))
                                        @foreach($masterDevices as $masterDevice)
                                            <option value="{{ $masterDevice->id ?? '' }}">{{ $masterDevice->device_name ?? '' }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            
                                <label for="master_device_id">Filter by Master Device ID:</label>
                                <select id="master_device_id">
                                    <option value="all">All</option>
                                    @if(!empty($masterDevices))
                                        @foreach($masterDevices as $masterDevice)
                                            <option value="{{ $masterDevice->id ?? '' }}">{{ $masterDevice->device_id ?? '' }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            
                                <label for="slave_device_name">Filter by Slave Device Name:</label>
                                <select name="slave_device_name" id="slave_device_name">
                                    <option value="all">All</option>
                                    @if(!empty($slaveDevices))
                                        @foreach($slaveDevices as $slaveDevice)
                                            <option value="{{ $slaveDevice->id ?? '' }}">{{ $slaveDevice->slave_device_name ?? '' }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            
                            
                            <table id="cims_data_table" class="table table-bordered table-bordered dt-responsiv w-100">
                                <thead class="table-light">
                                    <tr role="row">
                                        <th style="width: 5%;">Sr no</th>
                                        <th style="width: 15%;">Master Device Name</th>
                                        <th style="width: 20%;">Master Device ID</th>
                                        <th style="width: 10%;">IO&Slave Name</th>
                                        <th style="width: 10%;">Slave Device Image</th>
                                        <th style="width: 15%;">Slave Device Name</th>
                                        <th style="width: 10%;">Slave Device Status</th>
                                        <th style="width: 10%;">Status</th>
                                        <th style="width: 10%;">Action</th>
                                        
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
</div>

@endsection

@section('script')
<script src="{{ URL::asset('admin_panel\controller_js\cn_io_slave.js')}}"></script>
    <script>
        $(".system-user").addClass("menuitem-active");
        $(".system-user-list").addClass("menuitem-active");
    </script>
@endsection



