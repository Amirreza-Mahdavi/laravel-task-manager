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
        <a href="{{ route('tasks.index') }}">
            Task Manager
        </a>

        <div>
            <a href="{{ route('tasks.index') }}">
                Tasks
            </a>

            <a href="{{ route('login') }}">
                Login
            </a>

            <a href="{{ route('register') }}">
                Register
            </a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

</body>
</html>