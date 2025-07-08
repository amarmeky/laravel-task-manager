<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    public function index()
    {
        $task = Task::all();
        return response()->json($task, 200);
    }
    public function store(StoreTaskRequest $request)
    {

        $task = Task::create($request->validated());
        return response()->json($task, 201);
    }
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);
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
        $user=Task::findOrFail($id)->user;
        return response()->json($user, 200);
    }
}
