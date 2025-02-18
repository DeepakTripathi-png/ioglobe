@section('meta_title')
   Site Master | Fire Alarm
@endsection
@extends('Admin.Layouts.layout')
@section('content')

    <div class="content-page">
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        <h4 class="mt-0 header-title">Add Site</h4>
                    </div>
                    <div class="col-4">
                        <div class="card department-card">
                            <div class="card-body">

                                <form action="{{ route('master.site.store') }}" method="post" id="add-banner-form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" class="form-control" id="id" name="id" value="{{!empty($site)?$site->id:''}}">
                                    
                                    <div class="mb-3">
                                        <label for="site_name" class="form-label">Site Name</label>
                                        <input type="text" class="form-control" id="site_name" name="site_name" placeholder="Enter site name" value="{{!empty($site)?$site->site_name:''}}">
                                        @if($errors->has('site_name'))
                                        <span class="text-danger"><b>* {{$errors->first('site_name')}}</b></span>
                                        @endif    
                                    </div>

                                    <div class="mb-3">
                                        <label for="site_adress" class="form-label">Site Address</label>
                                        <textarea class="form-control" id="site_address" name="site_address" rows="3" placeholder="Enter site address">{{!empty($site->site_address)?$site->site_address:''}}</textarea>
                                        @if($errors->has('site_address'))
                                        <span class="text-danger"><b>* {{$errors->first('site_address')}}</b></span>
                                        @endif
                                    </div>
                                    
                                    <button class="btn btn-success"  type="submit"> Submit </button>

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
                                                            <th  class="text-center">Site Name</th>
                                                            <th  class="text-center">Site Address</th>
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
<script src="{{ URL::asset('admin_panel/controller_js/cn_site_master.js')}}"></script>
    <script>
        $(".system-user").addClass("menuitem-active");
        $(".system-user-list").addClass("menuitem-active");
    </script>
@endsection
