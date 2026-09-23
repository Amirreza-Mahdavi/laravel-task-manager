<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use Illuminate\Http\Request;
use App\Service\TaskService;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\taskResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller {
    public function __construct(
        private TaskService $taskService
    ){}
    public function index(): AnonymousResourceCollection {
        $tasks = $this->taskService->getTasks();

        return taskResource::collection($tasks);
    }

    public function storeTask(CreateTaskRequest $request): taskResource {
        $task = $this->taskService->createTask($request->user(), $request->validated());

        return new taskResource($task);
    }

    public function storeSubtask(CreateTaskRequest $request, Task $task): taskResource {
        $this->authorize('update', $task);
        $subtask = $this->taskService->createSubtask($request->user(), $task, $request->validated());

        return new taskResource($subtask);
    }

    public function update(CreateTaskRequest $request, Task $task): taskResource {
        $this->authorize('update', $task);
        $task = $this->taskService->updateTask($task, $request->validated());

        return new taskResource($task);
    }

    public function destroy(Task $task): JsonResponse {
        $this->authorize('delete', $task);

        $this->taskService->deleteTask($task);

        return response()->json([
            'message' => 'Successfully deleted',
        ]);
    }
}
