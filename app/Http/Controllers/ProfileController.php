<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($id)
    {
        $profile = Profile::where('user_id', $id)->first();
        return response()->json([
            'message' => 'Profile retrieved successfully',
            'profile' => $profile
        ], 200);
    }
    public function store(StoreProfileRequest $request)
    {
        $user = Auth::user();
        $oldprofile = Profile::where('user_id', $user->id)->exists();
        if ($oldprofile) {
            return response()->json(['message' => 'Profile already exists for this user'], 400);
        }
        $validated = $request->validated();
        $validated['user_id'] = $user->id;
        $validated['name'] = $user->name;
        $validated['email'] = $user->email;
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_picture', 'public');
            $validated['profile_picture'] = $path;
        }
        $profile = Profile::Create($validated);
        return response()->json([
            'message' => 'Profile created successfully',
            'profile' => $profile
        ], 201);
    }
    public function updateprofile(UpdateProfileRequest $request, $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->update($request->validated());
        return response()->json(['message' => 'Profile updated successfully'], 200);
    }
}
