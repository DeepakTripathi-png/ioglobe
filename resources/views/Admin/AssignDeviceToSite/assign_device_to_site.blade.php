@section('meta_title') Add Device | Fire Alarm @endsection
@extends('Admin.Layouts.layout')
@section('content')
  
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <div class="mb-2 justify-content-between d-flex align-items-center">
                            <h4 class="mt-0 header-title">Add Device Add</h4>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary waves-effect waves-light add-btn"><span class="btn-label"> <i class="fas fa-long-arrow-alt-left"></i></span>Back</a>
                    </div>
                    <div class="card department-card">
                        <div class="card-body">
                            <form action="{{route('device.store')}}" method="post" id="add-banner-form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{!empty($device->id)?$device->id:''}}">
                                <div class="row">

                                    
                                    <!-- Device Identification -->
                                    <div class="col-12">
                                        {{-- <h5 class="mb-3">Device Identification</h5> --}}
                                        <div class="row">

                                            <div class="mb-3 col-6">
                                                <label for="device_id" class="form-label">Select Device</label>
                                                <select class="form-select" id="device_id" name="device_id">
                                                    <option value="">Select Device</option>
                                                    @if(!empty($devices))
                                                    @foreach($devices as $device)
                                                    <option value="{{!empty($device->id)?$device->id:''}}"
                                                        {{ !empty($device->deviceType->id) && $device->deviceType->id == $device->id ? 'selected' : '' }}>
                                                        {{!empty($device->device_id)?$device->device_id:''}}</option>
                                                    @endforeach 
                                                   @endif
                                                </select>
                                                @if($errors->has('device_id'))
                                                <span class="text-danger"><b>* {{$errors->first('device_id')}}</b></span>
                                              @endif
                                            </div>
                                     
                                            <div class="mb-3 col-6">
                                                <label for="site_id" class="form-label">Select Site</label>
                                                <select class="form-select" id="site_id" name="site_id">
                                                    <option value="">Select Site</option>
                                                    @foreach($sites ?? [] as $site)
                                                        <option value="{{ $site->id ?? '' }}" 
                                                            {{ !empty($device->site->id) && $device->site->id == $site->id ? 'selected' : '' }}>
                                                            {{ $site->site_name ?? '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('site_id'))
                                                  <span class="text-danger"><b>* {{$errors->first('site_id')}}</b></span>
                                                @endif
                                            </div>
                                            

                                     

                                         </div>
                                         
                                        {{-- <div class="row">

                                            <div class="mb-3 col-6">
                                                <label for="device_id" class="form-label">Device ID</label>
                                                <input type="text" class="form-control" id="device_id" name="device_id" placeholder="Enter device id" value="{{!empty($device->device_id)?$device->device_id:''}}">
                                                @if($errors->has('device_id'))
                                                <span class="text-danger"><b>* {{$errors->first('device_id')}}</b></span>
                                               @endif
                                            </div>

                                         

                                            <div class="mb-3 col-6">
                                                <label for="device_name" class="form-label">Device Name</label>
                                                <input type="text" class="form-control" id="device_name" name="device_name" placeholder="Enter device name" value="{{!empty($device->device_name)?$device->device_name:''}}">
                                                @if($errors->has('device_name'))
                                                 <span class="text-danger"><b>* {{$errors->first('device_name')}}</b></span>
                                               @endif
                                            </div>
                                          
                                        </div> --}}

                                    </div>

                                        
                                    <!-- Description -->
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Additional details about the device" >{{!empty($device->description)?$device->description:''}}</textarea>
                                            @if($errors->has('description'))
                                              <span class="text-danger"><b>* {{$errors->first('description')}}</b></span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                        <button type="reset" class="btn btn-danger">Cancel</button>
                                    </div>
                                </div>
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
    $(".system-user-list").addClass("menuitem-active");
</script>
@endsection