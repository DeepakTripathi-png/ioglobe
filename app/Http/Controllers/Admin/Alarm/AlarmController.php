<?php

namespace App\Http\Controllers\Admin\Alarm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alarm;
use Carbon\Carbon;

class AlarmController extends Controller
{

    public function getAlarmsTriggeredInLastMinute()
    {

       


        $oneMinuteAgo = Carbon::now()->subMinute();

      
        
        // Get alarms triggered in the last minute
        $alarms = Alarm::where('alarm_status', 'active')
                    ->where('last_triggered_at', '>=', $oneMinuteAgo)
                    ->get();

       

        return response()->json($alarms);
    }
    


}
