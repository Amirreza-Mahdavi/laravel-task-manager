<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function view(User $user, Task $task): bool
    {
        // Admin can view tasks they created
        if ($user->role?->name === 'admin' && $task->user_id === $user->id) {
            return true;
        }

        // Anyone can view a task assigned to them
        return $task->assignedUsers()
            ->where('users.id', $user->id)
            ->exists();
    }

    public function update(User $user, Task $task): bool {
        if ($user->role?->name === 'admin' && $task->user_id === $user->id) {
            return true;
        }

        
        return $task->assignedUsers()
            ->where('users.id', $user->id)
            ->exists();
    }

    public function delete(User $user, Task $task): bool {

        return $user->role?->name === 'admin'
            && $task->user_id === $user->id;
    }
}