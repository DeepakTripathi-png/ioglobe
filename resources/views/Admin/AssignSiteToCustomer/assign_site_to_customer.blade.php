@section('meta_title') Map Device | Fire Alarm @endsection
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
                   
                        {{-- {{dd($device->site->id)}} --}}

                        <div class="mb-2 justify-content-between d-flex align-items-center">
                            <h4 class="mt-0 header-title">Assign Site</h4>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary waves-effect waves-light add-btn"><span class="btn-label"> <i class="fas fa-long-arrow-alt-left"></i></span>Back</a>
                    </div>
                    <div class="card department-card">
                        <div class="card-body">

                            {{-- {{dd($device)}} --}}

                            <form action="{{route('assign-site.store')}}" method="post" id="add-banner-form" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" id="id" name="id" value="{{!empty($device->id)?$device->id:''}}">
                                @csrf
                                <div class="row">
                                    <!-- Customer Information -->
                              
                                   

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="customer_id" class="form-label">Select Customer</label>
                                            <select class="form-select" id="customer_id" name="customer_id">
                                                <option value="">Select Customer</option>
                                                @foreach($customers as $customer)
                                                    <option 
                                                        value="{{ $customer->id ?? '' }}" 
                                                        {{ !empty($device->customer->id) && $device->customer->id == $customer->id ? 'selected' : '' }}>
                                                        {{ $customer->user_name ?? '' }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('customer_id'))
                                            <span class="text-danger"><b>* {{$errors->first('customer_id')}}</b></span>
                                          @endif
                                        </div>
                                    </div>
                                    

                                    

                                   

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="site_id" class="form-label">Select Site</label>
                                            <select class="form-select" id="site_id" name="site_id">
                                                <option value="">Select Site</option>
                                                @foreach($sites as $site)
                                                    <option 
                                                        value="{{ $site->id ?? '' }}" 
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
                                    

                                    <!-- Mapping Description -->
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="mapping_description" class="form-label">Description</label>
                                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description">{{$device->description??''}}</textarea>
                                            @if($errors->has('description'))
                                            <span class="text-danger"><b>* {{$errors->first('description')}}</b></span>
                                          @endif
                                        </div>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success">{{!empty($device)?'Edit Assigned Site':'Assign Site'}}</button>
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