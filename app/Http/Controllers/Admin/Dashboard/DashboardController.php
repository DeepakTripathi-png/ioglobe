<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteMaster;
use App\Models\AssignDeviceToSite;
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
use App\Models\AssignSiteToCustomer;
use App\Models\Alarm;


class DashboardController extends Controller
{
    public function index() {
        $role_id = Auth::guard('master_admins')->user()->role_id;

        if ($role_id == "1" || $role_id == "3") {
            $totalSiteCount = SiteMaster::where('status', 'active')->count();
            $totalDeviceCount = AssignDeviceToSite::where('status', '!=', 'delete')->count();
            return view('Admin.Dashboard.index', compact('totalSiteCount', 'totalDeviceCount'));
        }

        $totalAlarmCount = 0;
        $totalActiveAlarmCount = 0;
        $totalacknowledgedAlarmCount = 0;
    
        
        $user = Auth::guard('master_admins')->user(); 
    
        if (!empty($user->role_id)) {
            $roleCheck = ($user->role_id == 4) ? $user->id : $user->created_by;
    
            $assignedSite = AssignSiteToCustomer::where('customer_id', $roleCheck)
                ->where('status', 'active')
                ->pluck('site_id')
                ->toArray();

            $assignedDevice = AssignDeviceToSite::where('status', 'active')
                ->whereIn('site_id', $assignedSite)
                ->pluck('device_id')
                ->toArray();

            $ioSlaves = IOSlave::where('status', 'active')
                ->whereIn('master_device_id', $assignedDevice)
                ->pluck('id')
                ->toArray();

            $totalAlarmCount = Alarm::whereIn('ioslave_id', $ioSlaves)->count();
            $totalActiveAlarmCount = Alarm::whereIn('ioslave_id', $ioSlaves)->where('alarm_status', 'active')->count();
            $totalacknowledgedAlarmCount = Alarm::whereIn('ioslave_id', $ioSlaves)->where('alarm_status', 'acknowledged')->count();
        }
    
        return view('Admin.Dashboard.client_dashboard', compact('totalAlarmCount', 'totalActiveAlarmCount', 'totalacknowledgedAlarmCount'));
    }
    

    public function client_dashboard_data_table(Request $request)
    {

        $user = Auth::guard('master_admins')->user(); 
    
        if (!empty($user->role_id)) {
            $roleCheck = ($user->role_id == 4) ? $user->id : $user->created_by;
    
            $assignedSite = AssignSiteToCustomer::where('customer_id',  $roleCheck)
            ->where('status', 'active')
            ->pluck('site_id')
            ->toArray();
        
           $assignedDevice = AssignDeviceToSite::where('status', 'active')
            ->whereIn('site_id', $assignedSite)
            ->pluck('device_id')
            ->toArray();

            $ioSlaves = IOSlave::where('status','!=','delete')
            ->whereIn('master_device_id', $assignedDevice)
            ->orderBy('id', 'DESC')
            ->with('masterDevice', 'slaveDevice')
            ->get();  
        } else {
            $ioSlaves = IOSlave::where('status','!=','delete')
            ->orderBy('id', 'DESC')
            ->with('masterDevice', 'slaveDevice')
            ->get();  
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
                    return '<button id="acknowledge-btn" type="button" class="btn btn-sm btn-success acknowledge-btn"   style="display: block; width: 100%; height: 100%; padding-left: 15px;padding-right: 15px;padding-top:16px;padding-bottom:16px;text-align: center; color: white; background-color: rgb(31, 92, 116); box-sizing: border-box;font-size:18px;font-weight:bold;border-style:none" data-id="' . $row->id . '"  onclick="openModal()">Acknowledge</button>';
                })
                ->rawColumns(['slave_device_image', 'io_device_status', 'acknowledge'])
                ->make(true);
        }
    }



}
