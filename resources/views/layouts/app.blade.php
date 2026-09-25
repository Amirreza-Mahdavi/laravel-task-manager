<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'Task Manager')
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/app.css') }}"
    >
</head>

<body>

<nav>

    {{-- Logo --}}

    @auth

        @if (auth()->user()->role?->name === 'admin')

            <a href="{{ route('admin.tasks.index') }}">
                Task Manager
            </a>

        @else

            <a href="{{ route('tasks.index') }}">
                Task Manager
            </a>

        @endif

    @else

        <a href="{{ route('login') }}">
            Task Manager
        </a>

    @endauth


    {{-- Navigation --}}

    <div>

        @auth

            {{-- ADMIN NAVIGATION --}}

            @if (auth()->user()->role?->name === 'admin')

                <a href="{{ route('admin.tasks.index') }}">
                    Admin Tasks
                </a>

                <a href="{{ route('admin.tasks.create') }}">
                    Create Task
                </a>

            {{-- MEMBER NAVIGATION --}}

            @else

                <a href="{{ route('tasks.index') }}">
                    My Tasks
                </a>

                <a href="{{ route('tasks.create') }}">
                    Create Task
                </a>

            @endif


            {{-- Current user --}}

            <span>
                Hello, {{ auth()->user()->name }}
            </span>


            {{-- Logout --}}

            <form
                method="POST"
                action="{{ route('logout') }}"
                style="display: inline"
            >

                @csrf

                <button type="submit">
                    Logout
                </button>

            </form>


        @else

            {{-- GUEST NAVIGATION --}}

            <a href="{{ route('login') }}">
                Login
            </a>

            <a href="{{ route('register') }}">
                Register
            </a>

        @endauth

    </div>

</nav>


<main>

    @yield('content')

</main>


</body>
</html>