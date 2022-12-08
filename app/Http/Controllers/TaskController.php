<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Http\Resources\Task\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks()->orderByDesc('updated_at')->get();
        $tasks = TaskResource::collection($tasks)->resolve();

        return inertia('Tasks', compact('tasks'));
    }

    public function store(StoreRequest $request)
    {
        $request->user()->tasks()->create($request->validated());
        
        return redirect()->route('task.index');
    }

    public function delete(Task $task)
    {
        $task->delete();

        return redirect()->route('task.index');
    }
}
