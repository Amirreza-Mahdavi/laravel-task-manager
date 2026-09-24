@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')

<div class="container">

```
<div class="page-header">
    <div>
        <h1>My Tasks</h1>
        <p>Manage your tasks and keep track of your work.</p>
    </div>

    <a href="{{ route('tasks.create') }}" class="button">
        + Create Task
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($tasks->isEmpty())

    <div class="empty-state">
        <h2>No tasks yet</h2>
        <p>You haven't created any tasks yet.</p>

        <a href="{{ route('tasks.create') }}" class="button">
            Create your first task
        </a>
    </div>

@else

    <div class="task-list">

        @foreach ($tasks as $task)

            <div class="task-card">

                <div class="task-card-header">

                    <h2>
                        <a href="{{ route('tasks.show', $task) }}">
                            {{ $task->title }}
                        </a>
                    </h2>

                    <span class="status">
                        {{ $task->status->value }}
                    </span>

                </div>

                @if ($task->description)
                    <p class="task-description">
                        {{ $task->description }}
                    </p>
                @else
                    <p class="task-description muted">
                        No description provided.
                    </p>
                @endif

                <div class="task-meta">

                    <span>
                        Priority:
                        <strong>{{ $task->priority->value }}</strong>
                    </span>

                    @if ($task->due_date)
                        <span>
                            Due:
                            <strong>
                                {{ $task->due_date->format('M d, Y') }}
                            </strong>
                        </span>
                    @endif

                </div>

                <div class="task-actions">

                    <a href="{{ route('tasks.show', $task) }}">
                        View
                    </a>

                    <a href="{{ route('tasks.edit', $task) }}">
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="{{ route('tasks.destroy', $task) }}"
                        onsubmit="return confirm('Are you sure you want to delete this task?');"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="danger-button">
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        @endforeach

    </div>

@endif
```

</div>

@endsection
