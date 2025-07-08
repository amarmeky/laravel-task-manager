<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users=[
            ["id"=>1,"name"=>"amar"],
            ["id"=>2,"name"=>"hussien"],
            ["id"=>3,"name"=>"hassan"],
        ];
        return response()->json($users);
    }
    public function checkuser(int $id){
        if($id>10){
            return response()->json(["message "=>"id is not vaild"]);
        }else
        return response()->json(["message"=>"id is vaild $id"]);
    }
    public function getprofile($id){
        $profile=User::findOrFail($id)->profile;
        return response()->json(['message'=>'Profile retrieved successfully',
        'profile'=>$profile
        ], 200);
    }
    public function gettasks($id){
        $tasks = User::findOrFail($id)->tasks;
        return response()->json(['message' => 'Tasks retrieved successfully',
        'tasks' => $tasks
        ], 200);
    }
}
