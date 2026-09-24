<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignTaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Service\AssignmentService;
use Illuminate\Http\JsonResponse;

class AssignmentController extends Controller {
    public function __construct(
        private AssignmentService $assignmentService
    ){}

    public function store(AssignTaskRequest $request, Task $task): JsonResponse {
       $this->authorize('update', $task);
        $assignment = $this->assignmentService->assignTask($task, User::findOrFail($request->validated('user_id')));

        return response()->json([
            'message' => 'User assigned successfully',
            'assignment' => $assignment,
        ], 201);
    }
}
