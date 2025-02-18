<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Master\Master_admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login API
    public function login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check user in database
        $user = Master_admin::where('email', $request->email)
            ->where('status', '!=', 'delete')
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid email or password',
            ], 401);
        }

        if ($user->status === 'inactive') {
            return response()->json([
                'status' => false,
                'message' => 'Contact Admin for access.',
            ], 403);
        }

        // Create access token
        $token = $user->createToken('auth-token')->plainTextToken;

        // Update last login
        $user->update(['last_login' => now(),'api_token' => $token]);

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'token' => $token,
            'data' => $user,
        ], 200);
    }

    // Logout API
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        Master_admin::where('api_token',$request->user()->api_token)->update(['api_token' =>null]);

        return response()->json([
            'status' => true,
            'message' => 'Logout successful',
        ], 200);
    }
}
