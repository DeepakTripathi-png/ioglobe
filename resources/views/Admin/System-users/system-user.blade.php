@section('meta_title') System User | Fire Alarm @endsection
@extends('Admin.Layouts.layout')
@section('content')
<style>
 .card-body {
    flex: 1 1 auto;
    padding: 1rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    border-radius: 0.5rem;
    width: 100%;
}   
</style>    

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="mb-2 justify-content-between d-flex align-items-center">
                        {{-- <h3 style="color:red">System User</h3> --}}

                        <div class="mb-2 justify-content-between d-flex align-items-center">
                            <h4 class="mt-0 header-title">System User</h4>
                        </div>
                        <a href="{{ url('admin/system-user/add') }}" class="btn btn-success waves-effect waves-light add-btn" ><span class="btn-label"> <i class="fas fa-plus "></i></span>Add</a>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive department-card">
                            <table id="cims_data_table" class="table table-bordered table-bordered dt-responsiv w-100 ">
                                <thead class="table-light">
                                    <tr role="row">
                                        <th >Sr No</th>
                                        <th >Name</th>
                                        <th >Email ID</th>
                                        <th >Role</th>
                                        <th >Mobile No</th>
                                        <th >Status</th>
                                        <th >Action</th>
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
<script src="{{ URL::asset('admin_panel/controller_js/cn_system_user.js')}}"></script>
@endsection