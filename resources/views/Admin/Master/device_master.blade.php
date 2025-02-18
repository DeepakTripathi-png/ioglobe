@section('meta_title')
    Device  Master | Fire Alarm
@endsection
@extends('Admin.Layouts.layout')
@section('content')

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">


                <div class="row">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="mt-0 header-title"> {{!empty($device)?"Edit":"Update"}} Device</h4>
                    </div>
                    <div class="col-4">
                        <div class="card department-card">
                            <div class="card-body">


                                <form action="{{ route('master.device.store') }}" method="post" id="add-banner-form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" class="form-control" id="id" name="id" value="{{!empty($device)?$device->id:''}}">
                                    
                                    <div class="mb-3">
                                        <label for="controller_type" class="form-label">Controller Type</label>
                                        <select class="form-control" id="controller_type" name="controller_type">
                                            <option value="" disabled {{ old('controller_type', !empty($device) ? $device->controller_type : '') ? '' : 'selected' }}>
                                                Select Controller Type
                                            </option>
                                            @foreach ($controllerTypes as $controllerType)
                                                <option value="{{ $controllerType->id }}" 
                                                    {{ old('controller_type', !empty($device) ? $device->controller_type_id : '') == $controllerType->id ? 'selected' : '' }}>
                                                    {{ $controllerType->controller_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    
                                        @if($errors->has('controller_type'))
                                            <span class="text-danger"><b>* {{$errors->first('controller_type')}}</b></span>
                                        @endif
                                    </div>
                                    

                                      

                                    <div class="mb-3">
                                        <label for="device_id" class="form-label">Device ID</label>
                                        <input type="text" class="form-control" id="device_id" name="device_id"
                                            placeholder="Device ID" value="{{ old('device_id', !empty($device) ? $device->device_id : '') }}">
                                        @if($errors->has('device_id'))
                                            <span class="text-danger"><b>* {{$errors->first('device_id')}}</b></span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="device_name" class="form-label">Device Name</label>
                                        <input type="text" class="form-control" id="device_name" name="device_name"
                                            placeholder="Device Name" value="{{ old('device_name', !empty($device) ? $device->device_name : '') }}">
                                        @if($errors->has('device_name'))
                                            <span class="text-danger"><b>* {{$errors->first('device_name')}}</b></span>
                                        @endif
                                    </div>

                                    <button class="btn btn-success"  type="submit"> {{!empty($device)?"Update":"Add"}} </button>

                                    <button type="reset" class="btn btn-danger reset-button">Cancel </button>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body table-responsive department-card">
                                <div id="cims_data_table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                   
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="cims_data_table"
                                                class="table table-bordered dt-responsive w-100 dataTable no-footer dtr-inline"
                                                aria-describedby="cims_data_table_info" style="width: 1038px;">
                                                <thead class="table-light">
                                                    <tr role="row">
                                                            <th  class="text-center">Sr. No.</th>
                                                            <th  class="text-center">Controller Type</th>
                                                            <th  class="text-center">Device ID</th>
                                                            <th  class="text-center">Device Name</th>
                                                            <th  class="text-center">Status</th>
                                                            <th  class="text-center"> Action</th>    
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
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ URL::asset('admin_panel/controller_js/cn_device_master.js')}}"></script>
    <script>
        $(".system-user").addClass("menuitem-active");
        $(".system-user-list").addClass("menuitem-active");
    </script>
@endsection
