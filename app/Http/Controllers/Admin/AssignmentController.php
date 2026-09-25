<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Service\AssignmentService;
use Illuminate\Http\RedirectResponse;

class AssignmentController extends Controller {
    public function __construct(
        private AssignmentService $assignmentService
    ) {}

    public function assign(Task $task, User $user): RedirectResponse {
        $this->assignmentService->assignTask($task, $user);

        return back()->with('success', 'Task assigned successfully.');
    }
}