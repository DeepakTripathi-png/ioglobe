@section('meta_title')
   Slave Device Master | Fire Alarm
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


                                <form action="{{ route('master.slave.device.store') }}" method="post" id="add-banner-form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" class="form-control" id="id" name="id" value="{{!empty($slaveDevice)?$slaveDevice->id:''}}">

                            
                                    <div class="mb-3">
                                        <label for="slave_device_name" class="form-label">Slave Device Name</label>
                                        <input type="text" class="form-control" id="slave_device_name" name="slave_device_name"
                                            placeholder="Slave Device Name" value="{{ old('slave_device_name', !empty($slaveDevice) ? $slaveDevice->slave_device_name : '') }}">
                                        @if($errors->has('slave_device_name'))
                                            <span class="text-danger"><b>* {{$errors->first('slave_device_name')}}</b></span>
                                        @endif
                                    </div>

                                    {{-- <div class="mb-3">
                                        <!-- Slave Device Image Upload Field -->
                                        <label for="device_image_path" class="form-label">Upload Slave Device Image</label>
                                        <input type="file" class="form-control" id="device_image_path" name="device_image_path" accept="image/*" data-default-file="{{ !empty($slaveDevice->slave_device_image_path) && Storage::exists($slaveDevice->slave_device_image_path) ? url('/').Storage::url($slaveDevice->slave_device_image_path	) : '' }}" alt="{{ !empty($slaveDevice->slave_device_image_path	) ? $slaveDevice->slave_device_image_path : '' }}"  >
                                        @if($errors->has('device_image_path'))
                                            <span class="text-danger"><b>* {{$errors->first('device_image_path')}}</b></span>
                                        @endif
                                    
                                        <!-- Image Preview -->
                                        <div class="mt-3">
                                            <img id="image_preview" src="#" alt="Image Preview" style="max-width: 100px; display: none; border: 1px solid #ddd; padding: 5px;">
                                        </div>
                                    </div> --}}

                                    <div class="mb-3">
                                        <!-- Slave Device Image Upload Field -->
                                        <label for="device_image_path" class="form-label">Upload Slave Device Image</label>
                                        <input type="file" class="form-control" id="device_image_path" name="device_image_path" accept="image/*">
                                    
                                        @if($errors->has('device_image_path'))
                                            <span class="text-danger"><b>* {{$errors->first('device_image_path')}}</b></span>
                                        @endif
                                    
                                        <!-- Existing Image Preview -->
                                        <div class="mt-3" id="existing_image_container" style="{{ empty($slaveDevice->slave_device_image_path) ? 'display: none;' : '' }}">
                                            <img id="existing_image_preview" 
                                                 src="{{ !empty($slaveDevice->slave_device_image_path) && Storage::exists($slaveDevice->slave_device_image_path) ? url('/').Storage::url($slaveDevice->slave_device_image_path) : '' }}" 
                                                 alt="Existing Image" 
                                                 style="max-width: 100px; border: 1px solid #ddd; padding: 5px;">
                                        </div>
                                    
                                        <!-- New Image Preview -->
                                        <div class="mt-3">
                                            <img id="new_image_preview" src="#" alt="New Image Preview" style="max-width: 100px; display: none; border: 1px solid #ddd; padding: 5px;">
                                        </div>
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
                                                            <th  class="text-center">Slave Device Image</th>
                                                            <th  class="text-center">Slave Device Name</th>
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
<script src="{{ URL::asset('admin_panel/controller_js/cn_slave_device_master.js')}}"></script>
    <script>
        $(".system-user").addClass("menuitem-active");
        $(".system-user-list").addClass("menuitem-active");

        //Image Preview Code Start
    //     document.getElementById('device_image_path').addEventListener('change', function (event) {
    //     const imagePreview = document.getElementById('image_preview');
    //     const file = event.target.files[0];

    //     if (file) {
    //         const reader = new FileReader();
    //         reader.onload = function (e) {
    //             imagePreview.src = e.target.result;
    //             imagePreview.style.display = 'block'; // Show the preview
    //         };
    //         reader.readAsDataURL(file);
    //     } else {
    //         imagePreview.style.display = 'none'; // Hide the preview if no file is selected
    //         imagePreview.src = '#';
    //     }
    // });



    document.getElementById('device_image_path').addEventListener('change', function (event) {
    const newImagePreview = document.getElementById('new_image_preview');
    const existingImageContainer = document.getElementById('existing_image_container');
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            newImagePreview.src = e.target.result;
            newImagePreview.style.display = 'block'; // Show the new image preview
            existingImageContainer.style.display = 'none'; // Hide the existing image container
        };
        reader.readAsDataURL(file);
    } else {
        newImagePreview.style.display = 'none'; // Hide the new image preview
        newImagePreview.src = '#';
        if (existingImageContainer.querySelector('img').src) {
            existingImageContainer.style.display = 'block'; // Show the existing image if it exists
        }
    }
});


 //Image Preview Code End

</script>
@endsection
