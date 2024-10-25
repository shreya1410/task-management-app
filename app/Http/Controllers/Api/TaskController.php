<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Task;


class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::all();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $taskData = $request->all();
            $task = Task::create($taskData);
            if($task){
                $task = Task::where('id',$task->id)->first();
                return response()->json([
                    "success" => true,
                    "message" => "Task created successfully",
                    "data" => $task
                ]);
            }else{
                return response()->json([
                    "success" => false,
                    "message" => "Something is wrong to create task"
                ]);
            }
        }catch (\Exception $e){
            Log::info($e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Something went wrong"
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $tasks = Task::find($id);
            if($tasks){
                return response()->json([
                    'success' => true,
                    'message' => 'Task fetched successfully',
                    'data' => $tasks
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Something is wrong to fetch task',
                ]);
            }
        }catch (\Exception $e){
            Log::info($e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
 

    public function edit(Task $task)
    {
     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $task = Task::findOrFail($id);
            $task->update($request->all());
            if($task){
                $task = Task::where('id',$id)->first();
                return response()->json([
                    "success" => true,
                    "message" => "Task updated successfully",
                    "data" => $task
                ]);
            }else{
                return response()->json([
                    "success" => false,
                    "message" => "Something is wrong to update task"
                ]);
            }
        }catch (\Exception $e){
            Log::info($e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Something went wrong"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $task = Task::findOrFail($id)->delete();
            if($task){
                return response()->json([
                    "success" => true,
                    "message" => "Task deleted successfully",
                ]);
            }else{
                return response()->json([
                    "success" => false,
                    "message" => "Something is wrong to delete Task"
                ]);
            }
        }catch (\Exception $e){
            Log::info($e->getMessage());
            return response()->json([
                "success" => false,
                "message" => "Something went wrong"
            ]);
        }
    }
}
