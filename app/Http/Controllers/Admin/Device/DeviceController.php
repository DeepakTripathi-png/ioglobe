<?php

namespace App\Http\Controllers\Admin\Device;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Master\Role_privilege;
use App\Models\DeviceMaster;
use App\Models\SiteMaster;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\MediaTrait;
use Storage;
use Crypt;
use Arr;
use Str;
use DB;
use Session;

class DeviceController extends Controller
{

    public function index(){

        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_view')){
           
            return view('Admin.Device.device');
        }else{
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!'); 
        }
       
    }





    public function add()
    {
        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)
            ->where('status', 'active')
            ->select('privileges')
            ->first();

        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_add')) {
          
            $assignedDeviceIDs = Device::where('status', 'active')->pluck('device_id');

            $devices = DeviceMaster::where('status', 'active')
                ->whereNotIn('id', $assignedDeviceIDs)
                ->get();

            $sites = SiteMaster::where('status', 'active')->get();

            return view('Admin.Device.add_device', compact('devices', 'sites'));
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
    }



   



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'site_id' => 'required|integer',
            'device_id' => 'required|integer',
            'description' => 'nullable|string|max:1000',
        ], [
            'site_id' => 'The site  field is required.',
            'device_id.required' => 'The device ID field is required.',
            'description.max' => 'The description field may not be greater than 1000 characters.',
        ]);

        
        $input = [
            'site_id'=>$request->site_id,
            'device_id' => $request->device_id,
            'description' => $request->description ?? null, 
        ];

        
        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

       
        if (!empty($request->id)) { 
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'device_edit')) {
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Device::where('id', $request->id)->update($input);
                return redirect('admin/device')->with('success', 'Device updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        } else { 
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'device_add')) {
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Device::create($input);
                return redirect('admin/device')->with('success', 'Device added successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        }
    }



 
    public function edit($id){
        try {
            $device= Device::where('id',$id)->with('site','deviceType')->first();

            $deviceTypes=DeviceMaster::where('status','active')->get();
            $sites=SiteMaster::where('status','active')->get();
         
            return view('Admin.Device.add_device', compact('device','deviceTypes', 'sites'));
        } 
        catch (\Illuminate\Contracts\Encryption\DecryptException $e){
            return redirect('admin/device')->with('error', 'Access Denied !');
        }
    }


    public function data_table(Request $request){

        $device = Device::where('status', '!=', 'delete')->with('site','deviceType')->orderBy('id','DESC')->get();

        

        if ($request->ajax()) {
            return DataTables::of($device)
                ->addIndexColumn()
                
                ->addColumn('site_name', function ($row) {
                    return !empty($row->site->site_name) ? $row->site->site_name : '' ;
                })

                ->addColumn('site_address', function ($row) {
                    return !empty($row->site->site_address) ? "<div class='scrollable-cell'>".implode(', ', explode(',',$row->site->site_address))."</div>" : '' ;
                })


                ->addColumn('device_id', function ($row) {
                    return !empty($row->deviceType->device_id) ? $row->deviceType->device_id : '' ;
                })

                ->addColumn('date', function ($row) {
                    return !empty($row->created_at) ? $row->created_at : '' ;
                })
    
    
             
    
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
    
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_edit')) {
                        $actionBtn .= '<a href="' . url('admin/device/edit/' . $row->id ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:void;"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="mdi mdi-pencil"></i></button></a>';
                    }
    
    
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_delete')) {
                        $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="devices" data-flash="Device Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:void;" class="btn btn-danger btn-xs" title="Disabled" style="cursor:not-allowed;" disabled><i class="mdi mdi-trash-can"></i></a>';
                    }
                    return $actionBtn;
                })


                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
    
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_status')) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="devices" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="devices" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                            return $statusBlockBtn;
                        }
                    } else {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:;" disabled ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title="Active"></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:;" disabled ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title="Inactive"></></a>';
                            return $statusBlockBtn;
                        }
                    }
                })

                ->rawColumns(['action', 'status','site_address'])
                ->make(true);
        }
    }




}
