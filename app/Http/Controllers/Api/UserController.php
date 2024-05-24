<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::paginate();
    }

    public function assingTask(Task $task, User $user)
    {
        if($task->user_id == $user->id){
            return response()->json(["code" =>208,"message" => "User Already Assigned"], 200);
        }

       $task->update([
            "user_id" => $user->id,
       ]);

       return  response()->json(["code"=> 200 ,"message" => "Task Successfully Assigned to the user"], 200);
    }
}
