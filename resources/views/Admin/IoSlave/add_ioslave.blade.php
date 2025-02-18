@section('meta_title') Map IO&Slave | IOGOBE @endsection
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
                            <form action="{{route('ioslave.store')}}" method="post" id="add-banner-form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{!empty($ioSlave->id)?$ioSlave->id:''}}">
                                <div class="row">

                                    
                                    <!-- Device Identification -->
                                    <div class="col-12">
                                        {{-- <h5 class="mb-3">Device Identification</h5> --}}
                                        <div class="row">

                                            <div class="mb-3 col-6">
                                                <label for="master_device_id" class="form-label">Select Master Device</label>
                                                <select class="form-select" id="master_device_id" name="master_device_id" onchange="fetchDeviceDetails(this.value)">
                                                    <option value="">Select Master Device</option>
                                                    @if(!empty($masterDevices))
                                                    @foreach($masterDevices as $device)
                                                  
                                                    <option value="{{!empty($device->id)?$device->id:''}}"    {{ !empty($ioSlave->master_device_id) && $ioSlave->master_device_id == $device->id ? 'selected' : '' }}>
                                                        {{!empty($device->device_name)?$device->device_name:''}} - {{!empty($device->device_id)?$device->device_id:''}}</option>
                                                    @endforeach 
                                                   @endif
                                                </select>
                                                @if($errors->has('master_device_id'))
                                                <span class="text-danger"><b>* {{$errors->first('master_device_id')}}</b></span>
                                              @endif
                                            </div>

                                            <div class="mb-3 col-6">
                                                <label for="io_or_slave_name" class="form-label">Select Port</label>
                                                <select class="form-select" id="io_or_slave_name" name="io_or_slave_name">
                                                    <option value="">Select Port</option>
                                                    @foreach( $availablePorts ?? [] as $port)
                                                        <option value="{{ $slaveDevice->id ?? '' }}"  {{ !empty($port) && $ioSlave->io_slave_name == $port ? 'selected' : '' }}>
                                                            {{ strtoupper($port) ?? '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('slave_device_id'))
                                                  <span class="text-danger"><b>* {{$errors->first('slave_device_id')}}</b></span>
                                                @endif
                                            </div>
                                     
                                            <div class="mb-3 col-6">
                                                <label for="slave_device_id" class="form-label">Select Connected Device</label>
                                                <select class="form-select" id="slave_device_id" name="slave_device_id">
                                                    <option value="">Select Slave Device</option>
                                                    @foreach($slaveDevices ?? [] as $slaveDevice)
                                                        <option value="{{ $slaveDevice->id ?? '' }}"  {{ !empty($ioSlave->slave_device_id) && $ioSlave->slave_device_id == $slaveDevice->id ? 'selected' : '' }}>
                                                            {{ strtoupper($slaveDevice->slave_device_name) ?? '' }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('slave_device_id'))
                                                  <span class="text-danger"><b>* {{$errors->first('slave_device_id')}}</b></span>
                                                @endif
                                            </div>

                                            {{-- <div class="mb-3 col-6">
                                                <label for="io_or_slave_name" class="form-label">IO or Slave Name</label>
                                                <input type="text" class="form-control" id="io_or_slave_name" name="io_or_slave_name" 
                                                    value="{{ old('io_or_slave_name', $ioSlave->io_slave_name ?? '') }}" placeholder="Enter IO or Slave Name">
                                                @if($errors->has('io_or_slave_name'))
                                                    <span class="text-danger"><b>* {{$errors->first('io_or_slave_name')}}</b></span>
                                                @endif
                                            </div> --}}
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

<script>
    function fetchDeviceDetails(deviceId) {
        if (deviceId) {
            $.ajax({
                type: "get",
                url: "{{ url('/admin/io-slave/get-port-list') }}",
                data: {
                    device_id: deviceId
                },
                success: function(response) {
                    console.log(response);
                    $('#io_or_slave_name').empty();
                    $('#io_or_slave_name').append('<option value="">Select Port</option>');

                    // Check if unused_ports is an object and has keys
                    if (response.unused_ports && Object.keys(response.unused_ports).length > 0) {
                        // Iterate over the object
                        Object.entries(response.unused_ports).forEach(([key, port]) => {
                            $('#io_or_slave_name').append(
                                '<option value="' + port + '">' + port.toUpperCase() + '</option>'
                            );
                        });
                    } else {
                        $('#io_or_slave_name').append('<option value="" disabled>No Available Ports</option>');
                    }
                },
                error: function(err) {
                    console.error(err);
                    alert('Error fetching ports. Please try again.');
                }
            });
        } else {
            console.log('No device selected.');
        }
    }
</script>

   


<script>
    $(document).ready(function() {
        $("#email").on("keyup", function() {
            $.ajax({
                type: "get",
                url: "{{ url('/admin/system-user/check-user-exist') }}",
                data: {
                    email: $(this).val(),
                    user_id: $("#id").val()
                },
                success: function(response) {
                    if (response.trim() == "true") {
                        $("#submit-btn").attr("disabled", true);
                        $("#email_existence_message").removeClass("d-none");
                        $("#email_existence_message").html("<b>*</b> This Email has already been taken");
                    } else {
                        $("#email_existence_message").addClass("d-none");
                        $("#email_existence_message").html("");
                        $("#submit-btn").removeAttr("disabled");
                    }
                }
            })
        })
    })
</script>
@endsection