<div class="flex gap-2 items-center">
    @if ($user) 
        <p class="user-name">{{ $user->name}}</p>
        <form method="POST" action="{{ route('user.logout') }}">
            @csrf
            <button type="submit">Log Out</button>
        </form>
        
    @else
        <a href="{{ route('user.login') }}">Log in</a>
    @endif
</div>