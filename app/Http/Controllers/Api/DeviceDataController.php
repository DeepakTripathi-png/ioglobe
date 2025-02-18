<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DeviceDataService;
use Illuminate\Http\Request;

class DeviceDataController extends Controller
{
    protected $deviceDataService;

    public function __construct(DeviceDataService $deviceDataService)
    {
        $this->deviceDataService = $deviceDataService;
    }

    public function handleDeviceData(Request $request)
    {
        $rawData = $request->input('data');
        $response = $this->deviceDataService->handleDeviceData($rawData);

        return response()->json($response);
    }
}
