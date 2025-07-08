<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;

class ProfileController extends Controller
{public function show($id){
    $profile=Profile::where('user_id', $id)->first();
    return response()->json(['message'=>'Profile retrieved successfully',
    'profile'=>$profile
    ], 200);
}
    public function store(StoreProfileRequest $request){ 
        $profile=Profile::firstOrCreate($request->validated());
        return response()->json(['message'=>'Profile created successfully',
            'profile'=>$profile
        ], 201);
    }
    public function updateprofile(UpdateProfileRequest $request, $id){
        $profile=Profile::findOrFail($id);
        $profile->update($request->validated());
        return response()->json(['message'=>'Profile updated successfully'], 200);
    }
}
