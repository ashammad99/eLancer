<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthTokenController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->tokens;
    }

    public function show(Request $request)
    {
        $user = Auth::guard('sanctum')->user();

        return $user->currentAccessToken();
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'device_name' => 'required',
            'fcm_token' => 'nullable'
//            'permissions' => 'array'
        ]);
        Auth::validate($request->only('email', 'password'));
        $user = User::query()
            ->where('email', '=', $request->email)
//            ->where('password','=',$request->password)
            ->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $token = $user->createToken($request->device_name, ['projects.create', 'projects.update'],$request->fcm_token);//create token from device type, permissions(abilities) for the user
            return Response::json([
                'token' => $token->plainTextToken,//$token is object, plain text return hashed token
                'user' => $user,
            ], 201);

        }

        return Response::json([
            'message' => 'Invalid credentials',
        ], 401);
    }

    public function destroy($id)
    {
        $user = Auth::guard('sanctum')->user();

        // Logout from current device
        //$user->currentAccessToken()->delete();

        // Logout from single device
        $user->tokens()->findOrFail($id)->delete();

        // Logout from all devices!
        //$user->tokens()->delete();


        return [
            'message' => 'Token deleted'
        ];
    }
}
