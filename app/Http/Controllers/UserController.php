<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    public function register(RegisterRequest $request)
    {
        $validate = $request->validated();
        $validate['password'] = Hash::make($validate['password']);
        $user = User::create($validate);
        return response()->json([
            'message' => ' user register successful',
            'user' => $user
        ], 200);
    }

    public function login(LoginRequest $request)
    {
        $validate = $request->validated();
        if (!Auth::attempt($validate)) {
            return response()->json(['message' => 'Invalid email or password'], 401);
        }
        $user = User::where('email', $validate['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ], 200);
    }

public function logout(Request $request){
$request->user()->tokens()->delete();
return response()->json([
    'message' => 'Logout successful'
], 200);
}

    public function getprofile($id)
    {
        $profile = User::findOrFail($id)->profile;
        return response()->json([
            'message' => 'Profile retrieved successfully',
            'profile' => $profile
        ], 200);
    }
    public function gettasks($id)
    {
        $tasks = User::findOrFail($id)->tasks;
        return response()->json([
            'message' => 'Tasks retrieved successfully',
            'tasks' => $tasks
        ], 200);
    }
}
