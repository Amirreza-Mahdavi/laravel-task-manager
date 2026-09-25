@extends('layouts.app')

@section('title', 'Create Task')

@section('content')

<div class="container">

    <h1>Create Task</h1>

    <form method="POST" action="{{ route('admin.tasks.store') }}">

        @csrf

        <div>
            <label>Title</label>

            <input
                type="text"
                name="title"
                value="{{ old('title') }}"
            >

            @error('title')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Description</label>

            <textarea name="description">{{ old('description') }}</textarea>

            @error('description')
                <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label>Status</label>

            <select name="status">
                <option value="TODO">TODO</option>
                <option value="DOING">DOING</option>
                <option value="DONE">Done</option>
            </select>
        </div>

        <div>
            <label>Priority</label>

            <select name="priority">
                <option value="LOW">Low</option>
                <option value="MEDIUM">Medium</option>
                <option value="HIGH">High</option>
            </select>
        </div>

        <div>
            <label>Due Date</label>

            <input
                type="date"
                name="due_date"
                value="{{ old('due_date') }}"
            >
        </div>

        <div>
    <label for="user_id">Assign To</label>

    <select name="user_id" id="user_id">
        <option value="">-- Select a member --</option>

        @foreach ($users as $user)
            <option
                value="{{ $user->id }}"
                {{ old('user_id') == $user->id ? 'selected' : '' }}
            >
                {{ $user->name }} — {{ $user->email }}
            </option>
        @endforeach
    </select>

    @error('user_id')
        <div>{{ $message }}</div>
    @enderror
</div>

        <button type="submit">
            Create Task
        </button>

    </form>

</div>

@endsection