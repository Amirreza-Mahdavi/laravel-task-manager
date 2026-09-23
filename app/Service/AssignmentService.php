<?php

namespace App\Service;

use App\Models\Assignment;
use App\Models\Task;
use App\Models\User;

class AssignmentService {

    public function assignTask(Task $task, User $user): Assignment {
        return $task->assignments()->create([
            'user_id' => $user->id,
        ]);
    }
    
}