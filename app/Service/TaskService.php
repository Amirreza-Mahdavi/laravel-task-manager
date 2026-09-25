<?php

namespace App\Service;

use App\Models\Task;
use App\Models\User;
use RuntimeException;

class TaskService {
    public function __construct(
        private AssignmentService $assignmentService
    ) {}

    public function getUserTasks(User $user){
        $createdTasks = $user->tasks()
        ->latest()
        ->get();
        $assignedTasks = $user->assignedTasks()
        ->latest()
        ->get();
        return $createdTasks
        ->merge($assignedTasks)
        ->unique('id')
        ->sortByDesc('created_at')
        ->values();
    }

    public function getAssignedTasks(User $user){
        return $user->assignedTasks()
        ->latest()
        ->get();
    }

    public function createAndAssignTask(User $creator, User $assignee, array $data ): Task {
        $task = $creator->tasks()->create($data);

        $this->assignmentService->assignTask(
            $task,
            $assignee
        );

        return $task;
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
}