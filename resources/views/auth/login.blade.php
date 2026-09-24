@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="container">

    <div class="card">

        <h1>Login</h1>

        <form method="POST" action="/login">

            @csrf

            <div class="form-group">

                <label for="email">
                    Email
                </label>

                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                >

            </div>

            <div class="form-group">

                <label for="password">
                    Password
                </label>

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                >

            </div>

            <button type="submit">
                Login
            </button>

        </form>

        <p>
            Don't have an account?

            <a href="{{ route('register') }}">
                Register
            </a>
        </p>

    </div>

</div>

@endsection