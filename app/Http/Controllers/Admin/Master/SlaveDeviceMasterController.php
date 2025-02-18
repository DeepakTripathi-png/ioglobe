<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Role_privilege;
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
use App\Models\SlaveDeviceMaster;

class SlaveDeviceMasterController extends Controller
{
    use MediaTrait;

    public function index(){
        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'slave_device_master_view')){
            return view('Admin.Master.slave_device_master');
        }else{
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!'); 
        }
       
    }



    public function store(Request $request)
    {
    
        $rules = [
            'slave_device_name' => 'required|string|max:255',
            'device_image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ];
    
        // Custom validation messages
        $messages = [
            'slave_device_name.required' => 'Slave device name is required.',
            'slave_device_name.string' => 'Slave device name must be a valid string.',
            'device_image_path.image' => 'Device image must be an image file.',
            'device_image_path.mimes' => 'Device image must be of type: jpeg, png, jpg, gif, svg.',
            'device_image_path.max' => 'Device image size must not exceed 2MB.',
        ];

        // Validate the request
        $validated = $request->validate($rules, $messages);

        $input = [];

        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

        if (!empty($request->id)){

            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'slave_device_master_edit')) {
                
                if ($request->has('device_image_path')) {
                    $input['slave_device_image_path'] = $this->verifyAndUpload($request, 'device_image_path', 'images/slave_device_images');
                    $original_name = $request->file('device_image_path')->getClientOriginalName();
                    $input['slave_device_image_name'] = $original_name;
                }

                $input['slave_device_name'] = $request->slave_device_name;
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                SlaveDeviceMaster::where('id', $request->id)->update($input);
                return redirect('admin/master/slave-device-master')->with('success', 'Device updated successfully!');

            }else{
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        } else {
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'slave_device_master_add')){

                if ($request->has('device_image_path')) {
                    $input['slave_device_image_path'] = $this->verifyAndUpload($request, 'device_image_path', 'images/slave_device_images');
                    $original_name = $request->file('device_image_path')->getClientOriginalName();
                    $input['slave_device_image_name'] = $original_name;
                }

                $input['slave_device_name'] = $request->slave_device_name;
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                SlaveDeviceMaster::create($input);
               return redirect('admin/master/slave-device-master')->with('success', 'Slave Device added successfully!');

            }else{
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        }
    }

     

    public function edit($id){
        try {
            $slaveDevice= SlaveDeviceMaster::where('id',$id)->first();
            return view('Admin.Master.slave_device_master', compact('slaveDevice'));
        } 
        catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect('admin/roles-privileges')->with('error', 'Access Denied !');
        }
    }


    public function data_table(Request $request){

        $slaveDevice = SlaveDeviceMaster::where('status', '!=', 'delete')->orderBy('id','DESC')->select('id','slave_device_name','slave_device_image_path','status')->get();

        if ($request->ajax()){
            return DataTables::of($slaveDevice)
                ->addIndexColumn()

                ->addColumn('slave_device_image', function ($row){
                    $image_path = '';
                    $image_name = '';
                    if (!empty($row->slave_device_image_path)) {
                        $image_path = Storage::exists($row->slave_device_image_path) ? url('/').Storage::url($row->slave_device_image_path) : "";
                    
                        $image_name = $row->slave_device_image_name;
                    }
                    return '<img src="' . $image_path . '" alt="' . $image_name . '" width="50" class="review-image" style="cursor:pointer;">';
                })
                
                ->addColumn('slave_device_name', function ($row){
                    return !empty($row->slave_device_name) ? strtoupper($row->slave_device_name) : '' ;
                })

        
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'slave_device_master_edit')) {
                        $actionBtn .= '<a href="' . url('admin/slave-device-master/edit/' . $row->id ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:void;"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="mdi mdi-pencil"></i></button></a>';
                    }

                    

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'slave_device_master_delete')){
                        $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="slave_device_masters" data-flash="Device Type Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:void;" class="btn btn-danger btn-xs" title="Disabled" style="cursor:not-allowed;" disabled><i class="mdi mdi-trash-can"></i></a>';
                    }
                    return $actionBtn;
                })

                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'slave_device_master_status_change')) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="slave_device_masters" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="slave_device_masters" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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

                ->rawColumns(['action', 'status','slave_device_image'])
                ->make(true);
        }
    }






}
