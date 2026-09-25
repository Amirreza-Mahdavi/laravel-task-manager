<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Models\Task;
use App\Models\User;
use App\Service\TaskService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TaskController extends Controller {
    public function __construct(
        private TaskService $taskService
    ) {}

    public function index(Request $request): View {
        $tasks = $this->taskService->getUserTasks(
            $request->user()
        );
        
        return view('admin.tasks.index', ['tasks' => $tasks,]);
    }

    public function create(): View {
        $users = User::whereHas('role', function ($query) {
            $query->where('name', 'member');
        })->get();

        return view('admin.tasks.create', ['users' => $users,]);
    }

    public function store(CreateTaskRequest $request): RedirectResponse {
        $data = $request->validated();
        $assignee = User::findOrFail($data['user_id']);
        unset($data['user_id']);

        $this->taskService->createAndAssignTask($request->user(), $assignee, $data);
        return redirect()
         ->route('admin.tasks.index')
         ->with('success', 'Task created and assigned successfully.');
    }
}
