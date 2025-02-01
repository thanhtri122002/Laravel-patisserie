@extends('layouts.app')

@section('title', 'User registration')

@section('content')
    <div class="w-full relative flex justify-center items-center">
        <div class="form-container w-1/3">
            <form action="{{ route('user.create') }}" method="POST">
                @csrf
                <div class="flex flex-col gap-2">
                    <label for="name">Name</label>
                    <input type="text">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="mail">Email</label>
                    <input type="mail">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password">Password</label>
                    <input type="text">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="confirmed-password">Confirmed your password</label>
                    <input type="text">    
                </div> 
            </form>
        </div>
    </div>
@endsection