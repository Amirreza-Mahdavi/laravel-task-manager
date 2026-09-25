@extends('layouts.app')

@section('title', 'Admin Tasks')

@section('content')

<div class="container">

    <div class="page-header">
        <div>
            <h1>Admin Tasks</h1>
            <p>Manage tasks and assignments.</p>
        </div>

        <a href="/admin/tasks/create" class="button">
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
            <p>No tasks have been created.</p>

            <a href="{{ route('admin.tasks.create') }}" class="button">
                Create Task
            </a>
        </div>

    @else

        <div class="task-list">

            @foreach ($tasks as $task)

                <div class="task-card">

                    <div class="task-card-header">

                        <h2>
                            {{ $task->title }}
                        </h2>

                        <span class="status">
                            {{ $task->status->value }}
                        </span>

                    </div>

                    @if ($task->description)
                        <p class="task-description">
                            {{ $task->description }}
                        </p>
                    @endif

                    <div class="task-meta">

                        <span>
                            Priority:
                            <strong>
                                {{ $task->priority->value }}
                            </strong>
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

                    <div class="task-meta">

                        <span>
                            Created by:
                            <strong>
                                {{ $task->user->name }}
                            </strong>
                        </span>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</div>

@endsection