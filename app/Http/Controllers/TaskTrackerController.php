<?php

namespace App\Http\Controllers;

use App\Models\TaskTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class TaskTrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $render_data = [
            'tasks' => DB::table('task_trackers')->orderBy('id', 'desc')->paginate(5)
        ];

        return response()->json($render_data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $task = DB::table('task_trackers')->where('task', '=', $request->task)->first();

            if ($task) return response()->json($this->renderMessage(0, 'This task is already exist!'), Response::HTTP_BAD_REQUEST);

            $form_data = $request->validate([
                'task' => 'required',
                'date_time' => 'required',
                'status' => 'required',
            ]);

            $task = TaskTracker::create($form_data);

            if ($task) return response()->json($this->renderMessage(1, 'Task added success!'), Response::HTTP_OK);

        } catch (\Throwable $th) {

            return response()->json($this->renderMessage(0, 'An error occurred: ' . $th->getMessage()), Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $search = $request->input('search');

        $render_data = [
            'tasks' => DB::table('task_trackers')->where('task', 'LIKE', '%'.$search.'%')->orWhere('date_time', 'LIKE', '%'.$search.'%')->orderBy('id', 'desc')->paginate(5)
        ];

        return response()->json($render_data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskTracker $taskTracker)
    {
        try {

            return response()->json($taskTracker, Response::HTTP_OK);

        } catch (\Throwable $th) {
            
            return response()->json($this->renderMessage(0, 'An error occurred: ' . $th->getMessage()), Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskTracker $taskTracker)
    {
        try {

            $task = DB::table('task_trackers')->where('task', '=', $request->task)->where('id', '!=', $taskTracker->id)->first();

            if ($task) return response()->json($this->renderMessage(0, 'This task is already exist!', $taskTracker), Response::HTTP_BAD_REQUEST);

            $form_data = $request->validate([
                'task' => 'required',
                'date_time' => 'required',
                'status' => 'required',
            ]);

            $task = $taskTracker->update($form_data);

            if ($task) return response()->json($this->renderMessage(1, 'Task updated success!', $taskTracker), Response::HTTP_OK);

        } catch (\Throwable $th) {

            return response()->json($this->renderMessage(0, 'An error occurred: ' . $th->getMessage()), Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatus(Request $request, TaskTracker $taskTracker)
    {
        try {

            $form_data = $request->validate([
                'status' => 'required',
            ]);

            $task = $taskTracker->update($form_data);

            if ($task) return response()->json($this->renderMessage(1, 'Task updated success!', $taskTracker), Response::HTTP_OK);

        } catch (\Throwable $th) {

            return response()->json($this->renderMessage(0, 'An error occurred: ' . $th->getMessage()), Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskTracker $taskTracker)
    {
        try {

            $task = $taskTracker->delete();

            if ($task) return response()->json($this->renderMessage(1, 'Task deleted success!'), Response::HTTP_OK);

        } catch (\Throwable $th) {

            return response()->json($this->renderMessage(0, 'An error occurred: ' . $th->getMessage()), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function renderMessage($status, $message, $res_data = [])
    {
        return [
            'status' => $status,
            'message' => $message,
            'res_data' => $res_data
        ];
    }
}
