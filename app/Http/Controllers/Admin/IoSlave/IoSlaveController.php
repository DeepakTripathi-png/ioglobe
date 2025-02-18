<?php

namespace App\Http\Controllers\Admin\IoSlave;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Role_privilege;
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
use App\Models\DeviceMaster;
use App\Models\SlaveDeviceMaster;
use App\Models\IOSlave;
use App\Models\ControllerDevicePort;

class IoSlaveController extends Controller
{


    public function index(){

        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'io_slave_management_view')){

            $masterDevices = DeviceMaster::where('status', 'active')->get();

            $slaveDevices = SlaveDeviceMaster::where('status', 'active')->get();
           
            return view('Admin.IoSlave.ioslave',compact('masterDevices','slaveDevices'));
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

        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'io_slave_management_add')) {
           
            $masterDevices = DeviceMaster::where('status', 'active')->get();

            $slaveDevices = SlaveDeviceMaster::where('status', 'active')->get();

            return view('Admin.IoSlave.add_ioslave',compact('masterDevices','slaveDevices'));
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        }
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'master_device_id' => 'required|integer',
            'slave_device_id' => 'required|integer',
            'io_or_slave_name' => 'required|string|max:255',
        ], [
            'device_id.required' => 'The master device field is required.',
            'slave_device_id.required' => 'The slave device  field is required.',
            'io_or_slave_name.required' => 'The IO or Slave Name field is required.',
            'io_or_slave_name.max' => 'The IO or Slave Name may not be greater than 255 characters.',
        ]);

    
        $input = [
            'master_device_id' => $request->master_device_id,
            'slave_device_id' => $request->slave_device_id,
            'io_slave_name' => $request->io_or_slave_name,
        ];

        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)
            ->where('status', 'active')
            ->select('privileges')
            ->first();

    
        if (!empty($request->id)) { 
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'io_slave_management_edit')) {
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();

                IOSlave::where('id', $request->id)->update($input);
                return redirect('admin/io-slave')->with('success', 'Device updated successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        } else { 
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges->privileges, 'io_slave_management_add')) {
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();

                IOSlave::create($input);
                return redirect('admin/io-slave')->with('success', 'Device added successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        }
    }



    public function edit($id){
        try {
            $ioSlave= IOSlave::where('id',$id)->first();

            $controllerId = DeviceMaster::where('id', $ioSlave->master_device_id)->value('controller_type_id');

            $allPortListArray = ControllerDevicePort::where('status', 'active')
            ->where('controller_device_id', $controllerId)
            ->pluck('port')
            ->toArray();

            $usedPortArray = IOSlave::where('status','active')->where('master_device_id', $ioSlave->master_device_id)
                ->pluck('io_slave_name')
                ->toArray();

            $excludePorts = [$ioSlave->io_slave_name];

            $availablePorts = array_diff($allPortListArray, $usedPortArray);

            $availablePorts = array_unique(array_merge($availablePorts, $excludePorts));

            $masterDevices = DeviceMaster::where('status', 'active')->get();

            $slaveDevices = SlaveDeviceMaster::where('status', 'active')->get();
         
            return view('Admin.IoSlave.add_ioslave', compact('ioSlave','masterDevices','slaveDevices','availablePorts'));
        } 
        catch (\Illuminate\Contracts\Encryption\DecryptException $e){
            return redirect('admin/device')->with('error', 'Access Denied !');
        }
    }






    public function data_table(Request $request){

      
            $query = IOSlave::where('status', '!=', 'delete')
            ->orderBy('id', 'DESC')
            ->with(['masterDevice', 'slaveDevice']);

            // Apply filters if provided in the request
            if ($request->has('master_device_name') && $request->master_device_name != 'all') {
             $query->where('master_device_id', $request->master_device_name);
            }

            if ($request->has('master_device_id') && $request->master_device_id != 'all') {
                $query->where('master_device_id', $request->master_device_id);
               }

            if ($request->has('slave_device_name') && $request->slave_device_name != 'all') {
            $query->where('slave_device_id', $request->slave_device_name);
            }

           
    
        $ioSlaves = $query->get();

        if ($request->ajax()){
            return DataTables::of($ioSlaves)
                ->addIndexColumn()

                ->addColumn('master_device_name', function ($row){
                    return !empty($row->masterDevice->device_name) ? strtoupper($row->masterDevice->device_name) : '' ;
                })

                ->addColumn('master_device_id', function ($row){
                    return !empty($row->masterDevice->device_id) ? strtoupper($row->masterDevice->device_id) : '' ;
                })

                ->addColumn('io_slave_name', function ($row){
                    return !empty($row->io_slave_name) ? strtoupper($row->io_slave_name) : '' ;
                })


                ->addColumn('slave_device_image', function ($row){
                    $image_path = '';
                    $image_name = '';
                    if (!empty($row->slaveDevice->slave_device_image_path)) {
                        $image_path = Storage::exists($row->slaveDevice->slave_device_image_path) ? url('/').Storage::url($row->slaveDevice->slave_device_image_path) : "";
                    
                        $image_name = $row->slaveDevice->slave_device_image_name;
                    }
                    return '<img src="' . $image_path . '" alt="' . $image_name . '" width="50" class="review-image" style="cursor:pointer;">';
                })
                
                ->addColumn('slave_device_name', function ($row){
                    return !empty($row->slaveDevice->slave_device_name) ? strtoupper($row->slaveDevice->slave_device_name) : '' ;
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
                                $color = 'background-color: rgb(92, 178, 213);';;
                                break;
                        }
                
                        return "<span style='display: block; width: 100%; height: 100%; padding-left: 20px;padding-right: 20px;padding-top:16px;padding-bottom:16px;text-align: center; color: white; $color; box-sizing: border-box;font-size:18px;font-weight:bold;'>$status</span>";
                    }
                
                    return '';
                })

        
                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'io_slave_management_edit')) {
                        $actionBtn .= '<a href="' . url('admin/io-slave/edit/' . $row->id ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:void;"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="mdi mdi-pencil"></i></button></a>';
                    }

                    

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'io_slave_management_delete')){
                        $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="i_o_slaves" data-flash="Device Type Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:void;" class="btn btn-danger btn-xs" title="Disabled" style="cursor:not-allowed;" disabled><i class="mdi mdi-trash-can"></i></a>';
                    }
                    return $actionBtn;
                })

                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('master_admins')->user()->role_id;
                    $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'io_slave_management_status_change')){
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="i_o_slaves" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="i_o_slaves" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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

                ->rawColumns(['action', 'status','slave_device_image','io_device_status'])
                ->make(true);
        }
    }



    public function getPortList(Request $request)
    {
        $controllerId = DeviceMaster::where('id', $request->device_id)
            ->value('controller_type_id');
    
        $allPortListArray = ControllerDevicePort::where('status', 'active')
            ->where('controller_device_id', $controllerId)
            ->pluck('port')
            ->toArray();

        $usedPortArray = IOSlave::where('master_device_id', $request->device_id)
            ->pluck('io_slave_name')
            ->toArray();

        $availablePorts = array_diff($allPortListArray, $usedPortArray);

       



    

        
    
        return response()->json([
            'unused_ports' => $availablePorts,     
        ]);
    }
    






    
}
