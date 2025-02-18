<?php

// Start Common Controllers Needed For All Projects
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Admin\Login\LoginController;
use App\Http\Controllers\Admin\Login\ForgotPasswordController;
use App\Http\Controllers\Admin\Settings\GeneralSettings;
use App\Http\Controllers\Admin\Settings\VisualSettings;
use App\Http\Controllers\Admin\SystemUsers\RolesPrivilegesController;
use App\Http\Controllers\Admin\SystemUsers\SystemUserController;
use App\Http\Controllers\Admin\NotFoundController\NotFoundController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\AlertNotificationController;
use App\Http\Controllers\Admin\Master\DeviceMasterController;
use App\Http\Controllers\Admin\Master\SiteMasterController;
use App\Http\Controllers\Admin\Master\SlaveDeviceMasterController;
// use App\Http\Controllers\Admin\Device\DeviceController;
use App\Http\Controllers\Admin\AssignDeviceToSite\AssigDeviceToSiteController;
use App\Http\Controllers\Admin\AssignSiteToCustomer\AssignSiteToCustomerController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Admin\IoSlave\IoSlaveController;
use App\Http\Controllers\Admin\Alarm\AlarmController;
// End Common Controllers Needed For All Project

// Project Controller Start Here

// Project Controller Ends Here

// Start Common Routes For The Projects
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'storage linked';
});
Route::get('clear', function () {
    \Artisan::call('route:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    return 'clear';
});

Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/admin', [LoginController::class, 'index']);
});
Route::post('login-action', [LoginController::class, 'admin_login'])->name('login');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('reset-password', function(){ return abort(404); });
// End Common Routes For The Projects


// Start FrontEnd Routes

Route::get('/', function () {
    return redirect('/admin');
});

Route::get('/', [HomeController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
// *
// *----------- CODE HERE  -------------
// *

// End Frontend Routes

Route::get('/check-unread-notifications', [AlertNotificationController::class, 'showAlert'])->name('showAlert');
Route::post('/test-notification', [AlertNotificationController::class, 'store'])->name('notification.store');
Route::get('/test-notification', [AlertNotificationController::class, 'create'])->name('notification.create');


// Start Backend Routes
Route::group(['prefix' => 'admin', 'middleware' => ['prevent-back-history', 'is_admin']], function () {

   

    Route::controller(DashboardController::class)->group(function (){
        Route::get('/dashboard','index')->name('dashboard');
        Route::get('/dashboard/client_dashboard_data_table','client_dashboard_data_table');
    });


    Route::controller(SiteMasterController::class)->group(function () {
        Route::get('master/site', 'index');
        Route::post('master/site/store', 'store')->name('master.site.store');
        Route::get('master/site/data-table','data_table');
        Route::get('site-master/edit/{id}','edit');
    });

    Route::controller(DeviceMasterController::class)->group(function (){
        Route::get('master/device-master', 'index');
        Route::post('master/device-master/store', 'store')->name('master.device.store');
        Route::get('master/device-master/data-table','data_table');
        Route::get('device-master/edit/{id}','edit');
        Route::get('device-master/view/{id}','view');
        Route::get('master/device-master/view_data-table','view_data_table');
    });

    Route::controller(SlaveDeviceMasterController::class)->group(function () {
        Route::get('master/slave-device-master', 'index');
        Route::post('master/slave-device-master/store', 'store')->name('master.slave.device.store');
        Route::get('master/slave-device-master/data-table','data_table');
        Route::get('slave-device-master/edit/{id}','edit');
    });




    Route::controller(IoSlaveController::class)->group(function (){

        Route::get('io-slave', 'index');
        Route::get('/io-slave/add', 'add');
        Route::post('io-slave/store', 'store')->name('ioslave.store');
        Route::get('io-slave/edit/{id}','edit');
        Route::get('io-slave/data-table','data_table');
        Route::get('io-slave/get-port-list','getPortList');
       
    });




    Route::controller(AssigDeviceToSiteController::class)->group(function (){
        Route::get('device', 'index');
        Route::get('/device/add', 'add');
        Route::post('device/store', 'store')->name('device.store');
        Route::get('device/edit/{id}','edit');
        Route::get('device/data-table','data_table');
       
    });


    // Route::view('/device', 'admin.Device.device');


    Route::controller(AssignSiteToCustomerController::class)->group(function (){

        Route::get('assign-site', 'index');
        Route::get('/assign-site/add', 'add');
        Route::post('assign-site/store', 'store')->name('assign-site.store');
        Route::get('assign-site/edit/{id}','edit');
        Route::get('assign-site/data-table','data_table');
      
       
    });



    Route::controller(AlarmController::class)->group(function (){
        Route::get('/get-alarms','getAlarmsTriggeredInLastMinute');

      
       
    });






    // Route::view('/device-import', 'admin.Device.import_device');
    
    // Route::view('/map-site', 'admin.Device.map_device');

    // Route::view('/map-site/add', 'Admin.Device.map_device_add');

   

   
  
   //Customer Route
//    Route::view('/customer', 'admin.Customer.customer');

   //Alarm Management 
   Route::view('/alarm', 'Admin.Alarm.alarm');

   Route::view('/report', 'Admin.Report.report');



    // Start Backend Common Routes For The Projects
    Route::controller(GeneralSettings::class)->group(function () {
        Route::get('general-setting', 'index');
        Route::post('general-settings-store', 'store')->name('geraral.settings.store');
    });

    Route::controller(VisualSettings::class)->group(function () {
        Route::get('visual-setting', 'index');
        Route::post('visual-settings-store', 'store')->name('visual.settings.store');
    });

    Route::controller(RolesPrivilegesController::class)->group(function () {
        Route::get('roles-privileges','index');
        Route::get('roles-privileges/add','create');
        Route::post('roles-privileges/store','store')->name('roles-previllages.store');
        Route::get('roles-privileges/data-table','data_table');
        Route::get('roles-privileges/edit/{id}','edit');
        Route::get('roles-privileges/check-role-exist','check_role_exist');
    });

    Route::controller(SystemUserController::class)->group(function (){
        Route::get('system-user','index');
        Route::get('system-user/add','create');
        Route::post('system-user/store','store')->name('system-user.store');
        Route::get('system-user/data-table','data_table');
        Route::get('system-user/edit/{id}','edit');
        Route::get('system-user/check-user-exist','check_user_exist');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('change-password', 'view_change_password');
        Route::post('change-password', 'change_password');
        Route::get('logout', 'logout');
    });

    Route::controller(BaseController::class)->group(function () {
        Route::get('sub-category-list', 'subCategoryList');
        Route::get('common-delete', 'delete');
        Route::post('change-status', 'status')->name('change-status');
    });
    // End Backend Common Routes For The Projects

    route::get('/404', [NotFoundController::class, 'index']);
});
//Developer Comment
//Comment From Ashvini Dev
//End Backend Routes

// Route::fallback(function () {
//     return redirect('admin/404');
// });

