<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryToTaskRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        /*$user_id = Auth::user()->id;
        $task = Task::where('user_id', $user_id)->get();
        دي طريقة تاني
         */
        $task = Auth::user()->tasks;
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
        $task = Task::findOrFail($id);
        if ($task->user_id != $user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
        $task->update($request->validated());
        return response()->json($task, 200);
    }
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task, 200);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
    public function gettasksuser($id)
    {
        $user = Task::findOrFail($id)->user;
        return response()->json($user, 200);
    }
    public function addCategorytoTask(StoreCategoryToTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->categories()->attach($request->validated());
        return response()->json(['message' => 'Category added successfully'], 200);
    }
    public function getCategorytoTask($id)
    {
        $task = Task::findOrFail($id);
        $categories = $task->categories;
        return response()->json($categories, 200);
    }
}
