<div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-20">
        
        <!-- Logo -->
        <div class="flex items-center h-full">
            <a href="/home">
                <img class="h-12 w-auto object-contain" src="{{ asset('storage/images/icons/patisserie.svg') }}" alt="Patisserie Logo">
            </a>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex space-x-10 text-body text-[--Pink-Primary]">
            <a href="/home" class="font-mer text-body">Home</a>
            <a href="#about" class="font-mer text-body">About</a>
            <a href="/home/products" class="font-mer text-body">Products</a>
            @if(Auth::guard('web')->check())
                <a href="/home/cart" class="font-mer text-body">Cart</a>
            @endif
            <a href="/home/teams" class="font-mer text-body">Teams</a>
            <a href="#contact" class="font-mer text-body">Contact</a>
        </nav>

        <!-- Account Section -->
        <div class="hidden md:flex items-center space-x-4">
            @php
                $user = Auth::guard('web')->user();
                $admin = Auth::guard('admin')->user();
            @endphp

            @if ($user)
                <x-user-name-section />
            @elseif ($admin)
                <x-admin-name-section />
            @else
                <div class="relative group">
                    <button class="text-gray-700 hover:text-pink-500">My Account</button>
                    <div class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-md invisible opacity-0 group-hover:visible group-hover:z-50 group-hover:opacity-100 transition-opacity duration-300 delay-200">
                        <a href="{{ route('user.auth') }}" class="block px-4 py-2 hover:bg-gray-100">User Login</a>
                        <a href="{{ route('admin.login') }}" class="block px-4 py-2 hover:bg-gray-100">Admin Login</a>
                    </div>
                </div>
            @endif
        </div>

        <!-- Burger Menu (Mobile) -->
        <button id="burgerMenu" class="md:hidden flex flex-col justify-between w-7 h-6 focus:outline-none">
            <span class="block h-[3px] bg-black rounded"></span>
            <span class="block h-[3px] bg-black rounded"></span>
            <span class="block h-[3px] bg-black rounded"></span>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="fixed inset-0 bg-white transform translate-x-full transition-transform duration-500 md:hidden z-50">
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <img class="h-10 w-auto object-contain" src="{{ asset('storage/images/icons/patisserie.svg') }}" alt="Logo">
            <button id="closeBtn" class="text-gray-600 hover:text-black">
                ✕
            </button>
        </div>
        <nav class="flex flex-col space-y-6 mt-6 px-6 text-lg text-gray-700">
            <a href="/home" class="hover:text-pink-500">Home</a>
            <a href="#about" class="hover:text-pink-500">About</a>
            <a href="/home/products" class="hover:text-pink-500">Products</a>
            @if(Auth::guard('web')->check())
                <a href="/home/cart" class="hover:text-pink-500">Cart</a>
            @endif
            <a href="/home/teams" class="hover:text-pink-500">Teams</a>
            <a href="#contact" class="hover:text-pink-500">Contact</a>
        </nav>
    </div>

<script>
    const burger = document.getElementById('burgerMenu');
    const mobileMenu = document.getElementById('mobileMenu');
    const closeBtn = document.getElementById('closeBtn');

    burger.addEventListener('click', () => {
        mobileMenu.classList.remove('translate-x-full');
    });

    closeBtn.addEventListener('click', () => {
        mobileMenu.classList.add('translate-x-full');
    });
</script>