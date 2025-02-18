<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiDeviceDataController extends Controller
{
     public function handleDeviceData(Request $request)
    {
         $rawData = $request->data;
        
         return $rawData;
    }
}
