@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="container">

    <div class="card">

        <h1>Create Account</h1>
        @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

        <form method="POST" action="{{ route('register.store') }}">

            @csrf

            <div class="form-group">

                <label for="name">
                    Name
                </label>

                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                >

            </div>

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

            <div class="form-group">

                <label for="password_confirmation">
                    Confirm Password
                </label>

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                >

            </div>

            <button type="submit">
                Register
            </button>

        </form>

        <p>
            Already have an account?

            <a href="{{ route('login') }}">
                Login
            </a>
        </p>

    </div>

</div>

@endsection
