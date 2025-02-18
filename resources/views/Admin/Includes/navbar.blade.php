<style>
    #sidebar-menu #side-menu li a{
    display: flex !important;
}
#sidebar-menu>ul>li>a i {
    line-height:unset;
}
</style>
{{-- statrt Topbar --}}
<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-end mb-0">
        {{-- <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="fe-bell noti-icon"></i>
                <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
            </a>
        </li> --}}

    {{-- Added Ashvini --}}
        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="fe-bell noti-icon"></i>
                <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-lg">
                <!-- Header -->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Notifications</h6>
                </div>

                <!-- Notification List -->
                {{-- <div class="slimscroll noti-scroll">
                    <!-- Notification Item -->
                    <a href="javascript:;" class="dropdown-item notify-item">
                        <div class="notify-icon bg-primary">
                            <i class="mdi mdi-email-outline"></i>
                        </div>
                        <p class="notify-details">
                            <span>New message received</span>
                            <small class="text-muted">2 mins ago</small>
                        </p>
                    </a>

                    <!-- Notification Item -->
                    <a href="javascript:;" class="dropdown-item notify-item">
                        <div class="notify-icon bg-success">
                            <i class="mdi mdi-account-plus-outline"></i>
                        </div>
                        <p class="notify-details">
                            <span>New user registered</span>
                            <small class="text-muted">10 mins ago</small>
                        </p>
                    </a>

                    <!-- Notification Item -->
                    <a href="javascript:;" class="dropdown-item notify-item">
                        <div class="notify-icon bg-warning">
                            <i class="mdi mdi-alert-outline"></i>
                        </div>
                        <p class="notify-details">
                            <span>System alert</span>
                            <small class="text-muted">30 mins ago</small>
                        </p>
                    </a>
                </div> --}}

                <div class="slimscroll noti-scroll">
                    <!-- Fire Alarm Triggered -->
                    <a href="javascript:;" class="dropdown-item notify-item">
                        <div class="notify-icon bg-danger">
                            <i class="mdi mdi-fire-alert"></i>
                        </div>
                        <p class="notify-details">
                            <span>Fire Alarm Triggered!</span>
                            <small class="text-muted">Just now</small>
                        </p>
                    </a>
                
                    <!-- Smoke Detected -->
                    <a href="javascript:;" class="dropdown-item notify-item">
                        <div class="notify-icon bg-warning">
                            <i class="mdi mdi-smoke-detector"></i>
                        </div>
                        <p class="notify-details">
                            <span>Smoke Detected in Building A</span>
                            <small class="text-muted">5 mins ago</small>
                        </p>
                    </a>
                
                    <!-- Fire Drill Scheduled -->
                    {{-- <a href="javascript:;" class="dropdown-item notify-item">
                        <div class="notify-icon bg-info">
                            <i class="mdi mdi-calendar-alert"></i>
                        </div>
                        <p class="notify-details">
                            <span>Fire Drill Scheduled</span>
                            <small class="text-muted">30 mins ago</small>
                        </p>
                    </a> --}}
                
                    <!-- System Check -->
                    {{-- <a href="javascript:;" class="dropdown-item notify-item">
                        <div class="notify-icon bg-primary">
                            <i class="mdi mdi-cog-outline"></i>
                        </div>
                        <p class="notify-details">
                            <span>Fire System Check Completed</span>
                            <small class="text-muted">1 hour ago</small>
                        </p>
                    </a> --}}
                    
                </div>
                


                <!-- Footer -->
                <a href="javascript:;" class="dropdown-item text-center text-primary notify-item notify-all">
                    View All
                </a>
            </div>
        </li>
    {{-- End --}}

        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <img src="{{ !empty(Auth::guard('master_admins')->user()->user_profile_image_path) && Storage::exists(Auth::guard('master_admins')->user()->user_profile_image_path) ? url('/').Storage::url(Auth::guard('master_admins')->user()->user_profile_image_path) : URL::asset('package_assets/images/default-images/profile-image.png')}}" alt="user-image" class="rounded-circle">
                <span class="pro-user-name ms-1"> {{ !empty(Auth::guard('master_admins')->user()->user_name) ? Auth::guard('master_admins')->user()->user_name : '' }} <i class="mdi mdi-chevron-down"></i></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome {{ !empty(Auth::guard('master_admins')->user()->user_name) ? Auth::guard('master_admins')->user()->user_name : '' }}!</h6>
                    <div class="text-center mt-1" style="background-color: #f3f9ff;"><span>{{ App\Helpers\Helpers\Helper::getRoleName() }}</span></div>
                </div>

                <a href="Javascript:;" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>My Account</span>
                </a>


                <div class="dropdown-divider"></div>

                <a href="{{ url('admin/logout') }}" class="dropdown-item notify-item">
                    <i class="fe-log-out"></i>
                    <span>Logout</span>
                </a>

            </div>
        </li>
    </ul>

    <div class="logo-box">
        <a href="{{ url('/admin/dashboard') }}" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) : URL::asset('package_assets/images/alarm_logo.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_name : '' }}" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) : URL::asset('package_assets/images/alarm_logo.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name : '' }}" height="16">
            </span>
        </a>
        <a href="{{ url('/admin/dashboard') }}" class="logo logo-dark text-center">
            <span class="logo-sm">
                <img src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_path) : URL::asset('package_assets/images/alarm_logo.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->mini_logo_image_name : '' }}" height="22">
            </span>
            <span class="logo-lg text-dark fs-4">
                <img src="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) && Storage::exists(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) ? url('/').Storage::url(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_path) : URL::asset('package_assets/images/alarm_logo.png') }}" alt="{{ !empty(App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name) ? App\Helpers\Helpers\Helper::getVisualImages()->logo_image_name : '' }}" height="55">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>
    </ul>

</div>
<!-- end Topbar -->

<!-- ========== Left Sidebar Start ========== -->
@php
$role_id = Auth::guard('master_admins')->user()->role_id;
$RolesPrivileges = App\Models\Master\Role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();
@endphp
<div class="left-side-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <ul id="side-menu">
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'dashboard_view'))
                <li>
                    <a href="{{ url('/admin/dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboard </span>
                    </a>
                </li>
                @endif

                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_type_master_view')||str_contains($RolesPrivileges, 'site_master_view'))
                <li class="master">
                    <a href="#master" data-bs-toggle="collapse">
                        <i class="mdi mdi-chart-pie"></i>
                        <span> Master </span>
                        <span class="menu-arrow"></span>
                    </a>

                    <div class="collapse" id="master">
                        <ul class="nav-second-level">

                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'site_master_view'))
                            <li class="site-master">
                                <a href="{{ url('admin/master/site') }}">Site Master</a>
                            </li>
                            @endif   
       
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'device_type_master_view'))
                            <li class="site-master">
                                <a href="{{ url('admin/master/device-master') }}">Device Master</a>
                            </li>
                            @endif


                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'slave_device_master_view'))
                            <li class="site-master">
                                <a href="{{ url('admin/master/slave-device-master') }}">Slave Device Master</a>
                            </li>
                            @endif

                                 
                        </ul>
                    </div>
                </li>
                @endif 

                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'role_privileges_view')||str_contains($RolesPrivileges, 'user_view'))  
                <li class="setting">
                    <a href="#role_management" data-bs-toggle="collapse">
                        <i class="mdi mdi-laptop"></i>
                        <span> Role Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="role_management">
                        <ul class="nav-second-level">
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'role_privileges_view'))
                            <li class="general-setting">
                                <a href="{{ url('/admin/roles-privileges') }}">
                                    <span>Role</span>
                                </a>
                            </li>
                            @endif
                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'user_view'))
                            <li class="visual-setting">
                                <a href="{{ url('admin/system-user') }}">
                                    <span>System User</span>
                                </a>
                            </li>
                            @endif
                            
                        </ul>
                    </div>
                </li>
                @endif



                @if(!empty($RolesPrivileges))
                @if(str_contains($RolesPrivileges, 'io_slave_management_view'))
                <li class="setting">
                    <a href="{{ url('/admin/io-slave') }}">
                        <i class="mdi mdi-rss"></i>
                        <span> IO&Slave Management </span>
                    </a>
                </li>
                @endif
                @endif


                @if(!empty($RolesPrivileges) && (str_contains($RolesPrivileges, 'device_view') || str_contains($RolesPrivileges, 'map_site_view')))
                @if(str_contains($RolesPrivileges, 'device_view'))
                <li class="setting">
                    <a href="{{ url('/admin/device') }}">
                        <i class="mdi mdi-chart-pie"></i>
                        <span> Device Management </span>
                    </a>
                </li>
                @endif

                @if(str_contains($RolesPrivileges, 'map_site_view'))
                <li class="visual-setting">
                    <a href="{{ url('/admin/assign-site') }}">
                        <i class="mdi mdi-map-marker"></i>
                        <span> Site Management </span>
                    </a>
                </li>
                @endif
               @endif

                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'alarm_view'))
                <li class="vendor">
                    <a href="{{ url('admin/alarm') }}">
                    <i class="mdi mdi-bell-ring"></i>
                        <span> Alarm Notification </span>
                    </a>
                </li>
                @endif


                
                @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_view'))
                <li class="vendor">
                    <a href="{{ url('admin/report') }}">
                    <i class="mdi mdi-file-document"></i>
                        <span> Report</span>
                    </a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</div>