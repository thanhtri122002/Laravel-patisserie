@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="w-full relative justify-center items-center">
        <div class="form-container w-1/3">
            <form action="{{ route('user.login.submit') }}" method="POST">
                @csrf
                <div class="flex flex-col gap-2">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <button type="submit">Log in</button>
            </form>
            <div class="flex justify-between">
                <p>Don't have an account?</p>
                <a href="{{ route('user.register') }}">Register now</a>
            </div>
        </div>
    </div>
@endsection
