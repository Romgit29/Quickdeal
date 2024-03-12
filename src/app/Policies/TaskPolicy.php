<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function update(User $user, Task $task) {
        return $user->id == $task->author_id;
    }

    public function destroy(User $user, Task $task) {
        return $user->id == $task->author_id;
    }
}
