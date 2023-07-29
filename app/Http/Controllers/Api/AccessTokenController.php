<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;

class AccessTokenController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->first();
        $pass_check =  Hash::check($request->password, $user->password);
        if ($user && $pass_check) {
            $device_name = $request->userAgent();
            $token =  $user->creatToken($device_name);

            return Response::json([
                'msg' => 'user login success',
                'token' => $token->plainTextToken,
                'user' => $user,
            ], 201);
        }
        return Response::json([
            'msg' => 'Invalid credentials',
        ], 401);
    }

    public function destroy($token = null)
    {
        $user = Auth::guard('sanctum')->user();


        if (null === $token) {
            $user->currentAccessToken()->delete();
            return;
        } 
        $personal_token =  PersonalAccessToken::findToken($token);
        if ($user->id === $personal_token->tokenable_id) {
            $personal_token->delete();
        }
    }
}
