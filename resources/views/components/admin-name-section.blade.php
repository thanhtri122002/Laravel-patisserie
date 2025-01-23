<div class="flex items-center gap-2">
    @if ($admin)
        <p class="admin-name">{{ $admin->name}}</p>
        <a href="{{ route('admin.login') }}">Log in</a>
        <a href="{{ route('admin.logout') }}">Log out</a> 
    @endif
</div>