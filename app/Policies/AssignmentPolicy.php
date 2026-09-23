<?php

namespace App\Policies;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AssignmentPolicy {
   
    public function update(User $user, Assignment $assignment): bool {
        return $assignment->user_id === $user->id;
    }
}
