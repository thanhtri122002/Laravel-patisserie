@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="w-full relative justify-center items-center ">
        <div class="form-container w-1/3">
            <form action="{{ route('user.login') }}" method="POST">
                @csrf
                @method('POST')
                <div class="flex flex-col gap-2">
                    <label for="name">Name:</label>
                    <input type="text">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password">Password:</label>
                    <input type="text">
                </div>
                <button type="submit">Log in</button>
                <div class="flex justify-between">
                    <p>Don't have an account?</p>
                    <a href="{{ route('user.create') }}">Register now</a>
                </div>
            </form>
        </div>
    </div>
@endsection