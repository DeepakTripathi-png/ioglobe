<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteMaster;
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



class SiteMasterController extends Controller
{
    public function index(){
        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'site_master_view')){
            return view('Admin.Master.add_site');
        }else{
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!'); 
        }
       
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'site_name' => 'required',
            'site_address' => 'required',
         
        ], [
            'site_name.required' => 'The site name field is required.',
            'site_address.required' => 'The site address field is required.',
        ]);

    
        $input = [];

        $role_id = Auth::guard('master_admins')->user()->role_id;
        $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

        if (!empty($request->id)) {
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'site_master_edit')) {
                $input['site_name'] = $request->site_name;
                $input['site_address'] = $request->site_address;
                $input['modified_by'] = auth()->guard('master_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                SiteMaster::where('id', $request->id)->update($input);
                return redirect('admin/master/site')->with('success', 'Site updated successfully!');
            }else{
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        } else {
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'site_master_add')){
                $input['site_name'] = $request->site_name;
                $input['site_address'] = $request->site_address;
                $input['created_by'] = auth()->guard('master_admins')->user()->id;
                $input['created_ip_address'] = $request->ip();
                SiteMaster::create($input);
              return redirect('admin/master/site')->with('success', 'Site added successfully!');
            }else{
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            }
        }
    }


    public function edit($id){
        try {
            $site= SiteMaster::find($id);
            return view('Admin.Master.add_site', compact('site'));
        } 
        catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect('admin/roles-privileges')->with('error', 'Access Denied !');
        }
    }



    
        public function data_table(Request $request){

            $site = SiteMaster::where('status', '!=', 'delete')->orderBy('id','DESC')->select('id','site_name','site_address','status')->get();

            if ($request->ajax()) {
                return DataTables::of($site)
                    ->addIndexColumn()
                    
                    ->addColumn('site_name', function ($row) {
                        return !empty($row->site_name) ? $row->site_name : '' ;
                    })


                    ->addColumn('site_address', function ($row) {
                        return !empty($row->site_address) ? "<div class='scrollable-cell'>".implode(', ', explode(',',$row->site_address))."</div>" : '' ;
                    })


                

                    ->addColumn('action', function ($row) {
                        $actionBtn = '';
                        $role_id = Auth::guard('master_admins')->user()->role_id;
                        $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

                        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'site_master_edit')) {
                            $actionBtn .= '<a href="' . url('admin/site-master/edit/' . $row->id ) . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="mdi mdi-pencil"></i></button></a>';
                        } else {
                            $actionBtn .= '<a href="javascript:void;"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="mdi mdi-pencil"></i></button></a>';
                        }


                        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'site_master_delete')) {
                            $actionBtn .=  ' <a href="javascript:void;" data-id="' . $row->id . '" data-table="site_masters" data-flash="Site Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="mdi mdi-trash-can"></i></a>';
                        } else {
                            $actionBtn .= '<a href="javascript:void;" class="btn btn-danger btn-xs" title="Disabled" style="cursor:not-allowed;" disabled><i class="mdi mdi-trash-can"></i></a>';
                        }
                        return $actionBtn;
                    })
                       
                    ->addColumn('status', function ($row) {
                        $role_id = Auth::guard('master_admins')->user()->role_id;
                        $RolesPrivileges = Role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();

                        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'site_master_status_change')) {
                            if ($row->status == 'active') {
                                $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="site_masters" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                                return $statusActiveBtn;
                            } else {
                                $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="site_masters" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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
