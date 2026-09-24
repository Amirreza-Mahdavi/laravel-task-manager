@extends('layouts.app')

@section('title', 'Create Task')

@section('content')

<div class="container">

    <div class="page-header">
        <div>
            <h1>Create Task</h1>
            <p>Create a new task and keep track of your work.</p>
        </div>

        <a href="{{ route('tasks.index') }}">
            ← Back to Tasks
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="card">

        <form method="POST" action="{{ route('tasks.store') }}">

            @csrf

            <div class="form-group">
                <label for="title">Title</label>

                <input
                    id="title"
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Task title"
                    required
                >
            </div>

            <div class="form-group">
                <label for="description">Description</label>

                <textarea
                    id="description"
                    name="description"
                    placeholder="Description"
                >{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>

                <select id="status" name="status">
                    <option value="TODO"
                        {{ old('status') === 'TODO' ? 'selected' : '' }}>
                        TODO
                    </option>

                    <option value="IN_PROGRESS"
                        {{ old('status') === 'IN_PROGRESS' ? 'selected' : '' }}>
                        In Progress
                    </option>

                    <option value="DONE"
                        {{ old('status') === 'DONE' ? 'selected' : '' }}>
                        Done
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="priority">Priority</label>

                <select id="priority" name="priority">
                    <option value="LOW"
                        {{ old('priority') === 'LOW' ? 'selected' : '' }}>
                        Low
                    </option>

                    <option value="MEDIUM"
                        {{ old('priority') === 'MEDIUM' ? 'selected' : '' }}>
                        Medium
                    </option>

                    <option value="HIGH"
                        {{ old('priority') === 'HIGH' ? 'selected' : '' }}>
                        High
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="due_date">Due Date</label>

                <input
                    id="due_date"
                    type="date"
                    name="due_date"
                    value="{{ old('due_date') }}"
                >
            </div>

            <button type="submit">
                Create Task
            </button>

        </form>

    </div>

</div>

@endsection