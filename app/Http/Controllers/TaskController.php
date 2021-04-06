<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Task::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insertQuery = Task::insertGetId(
            [
                'name' => $request->title,
                'description' => $request->description,
                'priority' => $request->priority
            ]
        );
        if ($insertQuery > 0) {
            $resultData['result'] = "success";
        } else {
            $resultData['result'] = "fail";
        }

        return response()->json($resultData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $Query =$task->update(
                [
                    'name' => $request->title,
                    'description' => $request->description,
                    'priority' => $request->priority
                ]);

        if ($Query > 0) {
            $resultData['result'] = "success";
        } else {
            $resultData['result'] = "fail";
        }

        return response()->json($resultData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $Query =$task->delete();


        if ($Query > 0) {
            $resultData['result'] = "success";
        } else {
            $resultData['result'] = "fail";
        }

        return response()->json($resultData);
    }
}
