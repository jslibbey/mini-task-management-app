<?php

namespace App\Http\Controllers\Api;

use App\Enums\TaskStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskResource::collection(Task::whereNull('parent_id')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create(array_merge($request->validated(), ['status' => TaskStatusEnum::TODO]));
        return TaskResource::make($task);
    }

    /**
     * Display the specified resource.
     *
     * @param Task $broker
     * @return TaskResource
     */
    public function show(string $id): TaskResource
    {
        $task = Task::find($id);
        return TaskResource::make($task->load(['subTasks']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        $task->delete();
        return response()->noContent();
    }
}
