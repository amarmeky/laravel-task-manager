<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('tasks',action: [TaskController::class,'index'] );
// Route::post('tasks',action: [TaskController::class,'store'] );
// Route::put('tasks/{id}',action: [TaskController::class,'update'] );
// Route::get('tasks/{id}',action: [TaskController::class,'show'] );
// Route::delete('tasks/{id}',action: [TaskController::class,'destroy'] ); 


Route::apiResource('tasks', TaskController::class);
Route::post('profile',[ProfileController::class,'store']);
Route::get('profile/{id}',[ProfileController::class,'show']);
Route::get('user/{id}/profile',[UserController::class,'getprofile']);
Route::put('user/{id}/profile',[ProfileController::class,'updateprofile']);