<?php

namespace App\Service;

use App\Models\Task;
use App\Models\User;
use RuntimeException;

class TaskService {
    public function getTasks() {
        return Task::latest()->get();
    }

    public function createTask(User $user, array $data): Task {
        return $user->tasks()->create($data);
    }

    public function createSubtask(User $user, Task $parentTask, array $data): Task {
        return $parentTask->childTasks()->create([
            ...$data,
            'user_id' => $user->id,
        ]);
    }

    public function updateTask(Task $task, array $data): Task {
        $task->update($data);
        return $task;
    }

    public function deleteTask(Task $task): void {
        if ($task->assignments()->exists())
            throw new RuntimeException("Task cannot be deleted because it has assignments");

        $task->delete();
    }

    public function getUserTasks(User $user)
{
    return $user->tasks()
        ->latest()
        ->get();
}
}