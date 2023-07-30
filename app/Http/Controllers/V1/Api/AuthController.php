<?php

namespace App\Http\Controllers\V1\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Api\LoginUserRequest;
use App\Http\Requests\V1\Api\RegisterUserRequest;
use Illuminate\Http\Response;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        $validated_data = $request->validated();

        $validated_data['password'] = Hash::make($request->password);
        $user = User::create($validated_data);

        $token =  $user->createToken('token-name')->plainTextToken;


        return response(['success' => true, 'user' => $user, 'access_token' => $token]);
    }

    public function login(LoginUserRequest $request)
    {
        $login_data = $request->validated();

        if (!auth()->attempt($login_data)) {
            return response(['success' => false, 'message' => trans('app.authentication.invalid_login')], Response::HTTP_UNAUTHORIZED);
        }

        $token =  auth()->user()->createToken('token-name')->plainTextToken;

        return response(['success' => true, 'user' => auth()->user(), 'access_token' => $token]);
    }

    public function logout()
    {
        auth('sanctum')->user()->tokens()->delete();

        return response(['success' => true, 'message' => trans('app.authentication.logged_out')]);
    }
}
