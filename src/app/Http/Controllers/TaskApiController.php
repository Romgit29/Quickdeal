<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetTasksRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Models\Task;
use App\Services\TaskService;

class TaskApiController extends Controller
{
    public function index(GetTasksRequest $request) {
        return TaskService::get($request);
    }

    public function store(StoreTaskRequest $request) {
        TaskService::store($request);

        return response('Success');
    }

    public function update(UpdateTaskRequest $request, Task $task) {
        TaskService::update($request, $task);

        return response('Success');
    }

    public function destroy(Task $task) {
        TaskService::destroy($task);

        return response('Success');
    }
}