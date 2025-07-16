<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryToTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Expectation;

class TaskController extends Controller
{
    public function addFavoriteTask($taskid){
        Task::findOrFail($taskid);
        Auth::user()->favoriteTasks()->syncWithoutDetaching($taskid);
        return response()->json(["message"=>"add to favorite successful"], 200);
    }
    public function deleteFavoriteTask($taskid){
        Task::findOrFail($taskid);
        Auth::user()->favoriteTasks()->detach($taskid);
        return response()->json(["message"=>"remove from favorite successful"], 200);
    }
    public function getFavoriteTask(){
        $favoriteTask=Auth::user()->favoriteTasks()->get();
        return response()->json($favoriteTask, 200);
    }
    public function getalltasks(){
        $task=Task::all();
        return response()->json($task, 200);
    }
    public function gettaskpriority()
    {
        $user_id = Auth::user()->id;
        $task = Task::where('user_id', $user_id)->orderByRaw('FIELD(priority, "high", "medium", "low")')->get();
        //$task = Auth::user()->tasks;
        return response()->json($task, 200);
    }
    public function index()
    {
        $user_id = Auth::user()->id;
        $task = Task::where('user_id', $user_id)->get();
        //$task = Auth::user()->tasks;
        return response()->json($task, 200);
    }
    public function store(StoreTaskRequest $request)
    {
        $user_id = Auth::user()->id;
        $validateddata = $request->validated();
        $validateddata['user_id'] = $user_id;
        $task = Task::create($validateddata);
        return response()->json($task, 201);
    }
    public function update(UpdateTaskRequest $request, $id)
    {
        $user_id = Auth::user()->id;
        $task = Task::where('user_id', $user_id)->find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        $task->update($request->validated());
        return response()->json($task, 200);
    }
    public function show($id)
    {
        $user_id = Auth::user()->id;
        $task = Task::where('user_id', $user_id)->find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json($task, 200);
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        $task = Task::where('user_id', $user_id)->find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        $task->delete();
        return response()->json(['message' => 'task deleted successfully'], 200);
    }
    public function gettasksuser($id)
    {
        $user_id = Auth::user()->id;
        // $user = Task::findOrFail($id)->user;
        $task = Task::where('user_id', $user_id)->find($id);
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        $user = $task->user; // Get the user associated with the task

        return response()->json($user, 200);
    }
    public function addCategorytoTask(StoreCategoryToTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        try {
            $task->categories()->attach($request->validated());
            return response()->json(['message' => 'Category added successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'this task is already has this category'], 200);
        }

    }
    public function getCategorytoTask($id)
    {
        $task = Task::findOrFail($id);
        $categories = $task->categories;
        return response()->json($categories, 200);
    }
}
