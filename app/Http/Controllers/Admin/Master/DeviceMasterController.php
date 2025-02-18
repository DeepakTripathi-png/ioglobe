<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeviceMaster;
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
use App\Models\IOSlave;
use App\Models\ControllerDevice;


class DeviceMasterController extends Controller
{

    public function index(){
        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_type_master_view')){
            $controllerTypes=ControllerDevice::where('status','active')->get();
            return view('Admin.Master.device_master',compact('controllerTypes'));
        }else{
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!'); 
        }
       
    }

    public function store(Request $request)
    {
    
        $rules = [
            'controller_type'=>'required|integer',
            'device_id' => 'required|integer', 
            'device_name' => 'required', 
        ];
    
        
        $messages = [
            'device_id.required' => 'Device ID is required.',
            'device_id.integer' => 'Device ID must be an integer.', 
            'device_name.required' => 'Device name is required.',
            'controller_type.required' => 'Device type is required.'
        ];

        $validated = $request->validate($rules, $messages);

        $input = [];

        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

        if (!empty($request->id)) {
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_master_edit')) {
                $input['controller_type_id'] = $request->controller_type;
                $input['device_id'] = $request->device_id;
                $input['device_name'] = $request->device_name;
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                DeviceMaster::where('id', $request->id)->update($input);
                return redirect('admin/master/device-master')->with('success', 'Device updated successfully!');
            }else{
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        } else {
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_master_add')){
                $input['controller_type_id'] = $request->controller_type;
                $input['device_id'] = $request->device_id;
                $input['device_name'] = $request->device_name;
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                DeviceMaster::create($input);
              return redirect('admin/master/device-master')->with('success', 'Device added successfully!');
            }else{
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        }
    }


    public function edit($id){
        try {
            $device= DeviceMaster::where('id',$id)->first();
            $controllerTypes=ControllerDevice::where('status','active')->get();
            return view('Admin.Master.device_master', compact('device','controllerTypes'));
        } 
        catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect('admin/roles-privileges')->with('error', 'Access Denied !');
        }
    }


    public function view(Request $request){

        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_type_master_view')){

             $device = DeviceMaster::where('id',$request->id)->first();

             $ioSlave = IOSlave::where('status', '!=', 'delete')->where('master_device_id',$request->id)->orderBy('id','DESC')->with('masterDevice','slaveDevice')->get();

        

            return view('Admin.Master.device_master_view',compact('device','ioSlave'));
        }else{
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!'); 
        }
       
    }


    public function data_table(Request $request){

        $device = DeviceMaster::where('status', '!=', 'delete')->orderBy('id','DESC')->with('controllerDevice')->get();

        // dd($device);

       

        if ($request->ajax()){
            return DataTables::of($device)
                ->addIndexColumn()
                 
                ->addColumn('controller_type', function ($row) {
                    return !empty($row->controllerDevice->controller_name) ? $row->controllerDevice->controller_name : '' ;
                })

                ->addColumn('device_type', function ($row) {
                    return !empty($row->device_id) ? $row->device_id : '' ;
                })

                  
                ->addColumn('device_name', function ($row) {
                    return !empty($row->device_name) ? $row->device_name: '' ;
                })


            

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();


                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_type_master_view')) {
                        $actionBtn .= '<a href="' . url('admin/device-master/view/' . $row->id ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-primary btn-xs View_button" title="View"><i class="mdi mdi-eye"></i></button></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:void;"> <button type="button" data-id="' . $row->id . '" class="btn btn-primary btn-xs View_button" title="View" disabled><i class="mdi mdi-eye"></i></button></a>';
                    }


                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_type_master_edit')) {
                        $actionBtn .= '<a href="' . url('admin/device-master/edit/' . $row->id ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:void;"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="mdi mdi-pencil"></i></button></a>';
                    }

                    

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_type_master_delete')) {
                        $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="device_masters" data-flash="Device Type Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:void;" class="btn btn-danger btn-xs" title="Disabled" style="cursor:not-allowed;" disabled><i class="mdi mdi-trash-can"></i></a>';
                    }
                    return $actionBtn;
                })

                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_type_master_status_change')) {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="device_masters" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="device_masters" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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

                // ->rawColumns(['action', 'status'])
                ->rawColumns(['action', 'status','site_address'])
                ->make(true);
        }
    }


    



    // public function view_data_table(Request $request){

    //     //   dd($request->master_device_id);

    //     if(!empty($request->master_device_id)){
    //         $ioSlaves= IOSlave::where('status', '!=', 'delete')->where('master_device_id',$request->master_device_id)->orderBy('id','DESC')->with('masterDevice','slaveDevice')->get();
    //     }else{
    //         $ioSlaves= IOSlave::where('status', '!=', 'delete')->orderBy('id','DESC')->with('masterDevice','slaveDevice')->get();
    //     }
      


    //     if ($request->ajax()){
    //         return DataTables::of($ioSlaves)
    //             ->addIndexColumn()

          

    //             ->addColumn('io_slave_name', function ($row){
    //                 return !empty($row->io_slave_name) ? strtoupper($row->io_slave_name) : '' ;
    //             })


    //             ->addColumn('slave_device_image', function ($row){
    //                 $image_path = '';
    //                 $image_name = '';
    //                 if (!empty($row->slaveDevice->slave_device_image_path)) {
    //                     $image_path = Storage::exists($row->slaveDevice->slave_device_image_path) ? url('/').Storage::url($row->slaveDevice->slave_device_image_path) : "";
                    
    //                     $image_name = $row->slaveDevice->slave_device_image_name;
    //                 }
    //                 return '<img src="' . $image_path . '" alt="' . $image_name . '" width="100" class="review-image" style="cursor:pointer;">';
    //             })
                
    //             ->addColumn('slave_device_name', function ($row){
    //                 return !empty($row->slaveDevice->slave_device_name) ? strtoupper($row->slaveDevice->slave_device_name) : '' ;
    //             })


            

    //             ->addColumn('io_device_status', function ($row) {
    //                 if (!empty($row->io_device_status)) {
    //                     $status = strtoupper($row->io_device_status);
    //                     $color = '';
                
    //                     switch ($status) {
    //                         case 'NORMAL':
    //                             $color = 'background-color:rgb(58, 199, 58);'; 
    //                             break;
    //                         case 'ALARM':
    //                             $color = 'background-color:rgb(215, 35, 35);'; 
    //                             break;
    //                         case 'ON':
    //                             $color = 'background-color:rgb(43, 176, 43);'; 
    //                             break;
    //                         case 'OFF':
    //                             $color = 'background-color: rgb(188, 51, 51);'; 
    //                             break;
    //                         default:
    //                             $color = 'background-color: rgb(92, 178, 213);';;
    //                             break;
    //                     }
                
                       
    //                     return "<span style='display: block; width: 100%; height: 100%; padding-left: 20px;padding-right: 20px;padding-top:16px;padding-bottom:16px;text-align: center; color: white; $color; box-sizing: border-box;font-size:18px;font-weight:bold;'>$status</span>";
    //                 }
                
    //                 return '';
    //             })

    //             ->rawColumns(['slave_device_image','io_device_status'])
    //             ->make(true);
    //     }
    // }
    
    
    
    
    public function view_data_table(Request $request)
    {
        if (!empty($request->master_device_id)) {
            $ioSlaves = IOSlave::where('status', '!=', 'delete')->where('master_device_id', $request->master_device_id)->orderBy('id', 'DESC')->with('masterDevice', 'slaveDevice')->get();
        } else {
            $ioSlaves = IOSlave::where('status', '!=', 'delete')->orderBy('id', 'DESC')->with('masterDevice', 'slaveDevice')->get();
        }

        if ($request->ajax()) {
            return DataTables::of($ioSlaves)
                ->addIndexColumn()
                ->addColumn('io_slave_name', function ($row) {
                    return !empty($row->io_slave_name) ? strtoupper($row->io_slave_name) : '';
                })
                ->addColumn('slave_device_image', function ($row) {
                    $image_path = '';
                    $image_name = '';
                    if (!empty($row->slaveDevice->slave_device_image_path)) {
                        $image_path = Storage::exists($row->slaveDevice->slave_device_image_path) ? url('/') . Storage::url($row->slaveDevice->slave_device_image_path) : "";
                        $image_name = $row->slaveDevice->slave_device_image_name;
                    }
                    return '<img src="' . $image_path . '" alt="' . $image_name . '" width="100" class="review-image" style="cursor:pointer;">';
                })
                ->addColumn('slave_device_name', function ($row) {
                    return !empty($row->slaveDevice->slave_device_name) ? strtoupper($row->slaveDevice->slave_device_name) : '';
                })
                ->addColumn('io_device_status', function ($row) {
                    if (!empty($row->io_device_status)) {
                        $status = strtoupper($row->io_device_status);
                        $color = '';
                        switch ($status) {
                            case 'NORMAL':
                                $color = 'background-color:rgb(58, 199, 58);';
                                break;
                            case 'ALARM':
                                $color = 'background-color:rgb(215, 35, 35);';
                                break;
                            case 'ON':
                                $color = 'background-color:rgb(43, 176, 43);';
                                break;
                            case 'OFF':
                                $color = 'background-color: rgb(188, 51, 51);';
                                break;
                            default:
                                $color = 'background-color: rgb(92, 178, 213);';
                                break;
                        }
                        return "<span style='display: block; width: 100%; height: 100%; padding-left: 20px;padding-right: 20px;padding-top:16px;padding-bottom:16px;text-align: center; color: white; $color; box-sizing: border-box;font-size:18px;font-weight:bold;'>$status</span>";
                    }
                    return '';
                })
                
                ->addColumn('acknowledge', function ($row) {
                    return '<button id="acknowledge-btn" type="button" class="btn btn-sm btn-success acknowledge-btn"   style="display: block; width: 100%; height: 100%; padding-left: 15px;padding-right: 15px;padding-top:16px;padding-bottom:16px;text-align: center; color: white; background-color: rgb(31, 92, 116); box-sizing: border-box;font-size:18px;font-weight:bold;border-style:none" data-id="' . $row->id . '" onclick="openModal()">Acknowledge</button>';
                })
                ->rawColumns(['slave_device_image', 'io_device_status', 'acknowledge'])
                ->make(true);
        }
    }

















}
      
      
         

       
    
    

