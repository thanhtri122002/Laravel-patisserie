<div class="flex gap-2 items-center">
    @if ($user) 
        <p class="user-name">{{ $user->name}}</p>
        <a href="{{ route('admin.logout')}}">Log out</a>
        <a href="{{ route('admin.login') }}">Log in</a>
    @else
        <p>user</p>
    @endif

</div>