<div class="flex gap-2 items-center">
    @if ($user) 
        <p class="font-mer text-body text-[--text-default]">{{ $user->name}}</p>
        <form method="POST" action="{{ route('user.logout') }}">
            @csrf
            <button type="submit" className="font-mer text-body text-[--text-default]">Log Out</button>
        </form>
    @else
        <a href="{{ route('user.login') }}" className="font-mer text-body text-[--text-default]">Log in</a>
    @endif
</div>