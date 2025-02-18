<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\Master_admin;

class ProfileController extends Controller
{

    public function profile()
    {
        $user = auth()->user();

        $userDetails = Master_admin::where('id', $user->id)
            ->where('status', '!=', 'delete')
            ->first();

        if ($userDetails) {
            return response()->json([
                'status' => true,
                'message' => 'User Profile Successfully Fetched',
                'data' => $userDetails
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User not found or deleted'
            ], 404);
        }
    }
    
}
