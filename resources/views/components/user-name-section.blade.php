<div class="flex gap-2 items-center">
    @if ($user) 
        <p class="user-name">{{ $user->name}}</p>
        <a href="{{ route('user.logout')}}">Log out</a>
        
    @else
        <a href="{{ route('user.login') }}">Log in</a>
    @endif
</div>