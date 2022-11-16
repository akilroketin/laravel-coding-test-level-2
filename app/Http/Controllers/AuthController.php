<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        DB::beginTransaction();

        try {

            $user = User::create([
                'name'  => $request->name,
                'email'  => $request->email,
                'username'  => $request->username,
                'password'  => Hash::make($request->password),
            ]);

            DB::commit();

            return response()->json([
                'status'    => 200,
                'message'   => 'User Successfully Created',
                'token'     => $user->createToken("API TOKEN LARAVEL")->plainTextToken
            ], 200);

        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ], 500);

        }
    }

    public function login(LoginUserRequest $request)
    {
        try {

            if(!Auth::attempt($request->only(['username', 'password']))){
                return response()->json([
                    'status' => 401,
                    'message' => 'Username & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('username', $request->username)->first();

            return response()->json([
                'status' => 200,
                'message' => 'User Successfully Logged In',
                'token' => $user->createToken("API TOKEN LARAVEL")->plainTextToken
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ], 500);

        }
    }
}
