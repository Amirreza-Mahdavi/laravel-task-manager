<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Service\TaskService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct(
        private TaskService $taskService
    ) {}

    public function index(): View
    {
        $tasks = $this->taskService->getUserTasks(
            Auth::user()
        );

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    public function store(CreateTaskRequest $request): RedirectResponse
{
    $this->taskService->createTask(
        Auth::user(),
        $request->validated()
    );

    return redirect()
        ->route('tasks.index')
        ->with('success', 'Task created successfully.');
}

    public function show(Task $task): View
    {
        $this->authorize('view', $task);

        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    public function edit(Task $task): View
    {
        $this->authorize('update', $task);

        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function update(
        CreateTaskRequest $request,
        Task $task
    ): RedirectResponse {

        $this->authorize('update', $task);

        $this->taskService->updateTask(
            $task,
            $request->validated()
        );

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $this->authorize('delete', $task);

        $this->taskService->deleteTask($task);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}