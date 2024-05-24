<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return TaskResource::collection(Task::Filter($request->query())->with('user')->paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date|after:now',
            'status' => 'required|in:Pending,Blocked,In Progress,Completed',
            'user_id' => 'sometimes|exists:users,id',
        ]);

        // Additional validation logic other than pending must have user assigned
        if (!$request->user_id && $request->status != "Pending") {
            return response()->json([
                "code" => 406,
                "message" => "Tasks with no user ID must have a status of 'Pending'.",
            ], 406); // 406 Not Acceptable
        }

        // Create the task
        $task = Task::create($request->all());

        // Return the newly created task as a resource
        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task->load('user');
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->update(
            $request->validate([
                'title' => 'sometimes|string|max:255',
                'description' => 'sometimes|string',
                'due_date' => 'sometimes|date|after:now',
                'status' => 'sometimes|in:Pending,Blocked,In Progress",Completed',
            ]),
        );

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response(status: 204); //204 mean no content is available (Resource deleted)
    }
}
