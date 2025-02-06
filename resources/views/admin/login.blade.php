@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="w-full relative flex justify-center items-center">
        <div class="form-container w-1/3">
            <form action="{{ route('admin.login.submit') }}" method="POST" class="flex flex-col gap-4">
                @csrf
                <div class="flex flex-col gap-2">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                </div> 
                <div class="flex flex-col gap-2">
                    <label for="password">Password:</label>
                    <input type="text" name="password" id="password" required>
                </div>
                <button type="submit">Log In</button>
            </form>
        </div> 
    </div>
@endsection
