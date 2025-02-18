<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AlertNotification;
use Carbon\Carbon;


class AlertNotificationController extends Controller
{
    public function showAlert()
    {
        $notifications = AlertNotification::where('is_read', false)
            ->select('id', 'device_id', 'device_type', 'location', 'description', 'created_at')
            ->get();

        // dd($notifications);    

        $alert_notification = array();

        foreach ($notifications as $notification) {
            $notification->update(['is_read' => true]);  

            $alert = array();
            $alert['icon'] = 'alert-icon'; 
            $alert['title'] = 'New Notification'; 
            $alert['alert_message'] = $notification->description;
            $alert['location'] = $notification->location;
            $alert['device_id'] = $notification->device_id;
            $alert['device_type'] = $notification->device_type;
            $alert['id'] = $notification->id;

            $alert_notification[] = $alert;
        }

        return response()->json(['alert_notification' => $alert_notification]);
    }



    public function create()
    {
        return view('Admin.notifications.create');
    }

    // Store the notification in the database
    public function store(Request $request)
    {

      

        // Validate incoming request
        $validated = $request->validate([
            'device_id' => 'required|string',
            'device_type' => 'required|string',
            'location' => 'required|string',
            'description' => 'required|string',
        ]);

        // Create the notification
        AlertNotification::create($validated);

        // Return a success message or redirect back
        return redirect()->route('notification.create')->with('success', 'Notification created successfully!');
    }

    
}
