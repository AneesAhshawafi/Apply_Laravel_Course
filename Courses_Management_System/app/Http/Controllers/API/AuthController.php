<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\API\RegisterRequest;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $user = User::create([
            "name" => $name,
            "email" => $email,
            "password" => Hash::make($password),
        ]);
        // no expiration time
        $data["token"] = $user->createToken("userToken")->plainTextToken;
        // with expiration time
        // $data["token"] = $user->createToken('userToken', ['*'], now()->addDays(7))->plainTextToken;
        $data["name"] = $name;
        $data["email"] = $email;

        return ApiResponse::send(201, true, "Regstration successfully", $data);
    }

    public function login(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt(["email" => $email, "password" => $password])) {
            $user = Auth::user();
            $data["token"] = $user->createToken("userToken")->plainTextToken;
            $data["name"] = $user->name;
            $data["email"] = $email;
            return ApiResponse::send(200, true, "Login successfully", $data);
        } else {
            return ApiResponse::send(401, false, "Check Your email or password", "", "");
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::send(200, true, "Loged out successfully", "", "");
    }
}
