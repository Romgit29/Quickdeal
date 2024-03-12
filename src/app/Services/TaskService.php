<?php

namespace App\Services;

use App\Enums\TaskStatusEnum;
use App\Http\Requests\GetTasksRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskCollection;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TaskService {
    public static function get(GetTasksRequest $request): TaskCollection{
        return new TaskCollection(TaskRepository::get($request->validated()));
    }

    public static function store(StoreTaskRequest $request): void {
        Task::create(array_merge($request->validated(), ['author_id' => Auth::id(), 'task_status_id' => TaskStatusEnum::NOT_IN_WORK]));
    }

    public static function update(UpdateTaskRequest $request, Task $task): void {
        $task->fill($request->validated());
        $task->save();
    }

    public static function destroy(Task $task): void {
        $task->delete();
    }
}