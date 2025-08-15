<div class="h-full navbar py-2 flex items-center">
    <div class="h-full w-full flex-1 flex items-center justify-between md:flex-col gap-8">
        <div class="flex w-full my-auto justify-between ml-0 h-1/2 ">
            <div class="h-full logo place-self-center ml-5">
                <img class="w-auto h-full object-cover" src="{{ asset('storage/images/icons/patisserie.svg') }}" alt="">
            </div>
            
            <div class="nav-item relative group flex items-center mr-5">
                @php
                    $user = Auth::guard('web')->user();
                    $admin = Auth::guard('admin')->user();
                @endphp

                
                @if ($user)
                    <x-user-name-section></x-user-name-section>
                @elseif ($admin)
                    <x-admin-name-section></x-admin-name-section>
                @else
                    <a href="#" class="cursor-pointer">My Account</a>
                    <div class="absolute top-0 hidden group-hover:flex group-hover:flex-col group-hover:space-y-5 bg-white p-2 z-50">
                        <a href="{{ route('user.auth') }}" class="block  hover:bg-gray-100">User Login</a>
                        <a href="{{ route('admin.login') }}" class="block  hover:bg-gray-100">Admin Login</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="navbar-nav flex w-full">
            <ul class="flex mx-auto gap-x-11 justify-evenly">
                <li class="nav-item">
                    <a href="/" >Home</a>
                </li>
                <li class="nav-item">
                    <a href="#">About</a>
                </li>
                <li class="nav-item">
                    <a href="/products">Product</a>
                </li>
                <!-- <li class="nav-item dropdown-toggle relative"> -->
                @if ($user)
                <li class="nav-item">
                    <a href="/cart">Cart</a>
                    <!-- <div class="dropdown-menu hidden">
                        <a href=""></a>
                        <a href=""></a>
                    </div> -->
                </li>
                @endif
                <li class="nav-item">
                    <a href="/teams">Teams</a>
                </li>
                <li class="nav-item">
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>


    <div id="burgerMenu" class="burger-menu ml-auto">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </div>
    <div id="mobileMenu" class="mobile-menu">
        <div class="flex m-10 justify-between">
            <img class="w-auto h-[3rem] object-cover" src="{{ asset('storage/images/icons/patisserie.svg') }}" alt="">
            <button id="closeBtn">
                <svg width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                    <path class="round" d="M7 3.33782C8.47087 2.48697 10.1786 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 10.1786 2.48697 8.47087 3.33782 7" stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
            </button>
        </div>
        
        <ul class="ml-[1rem] flex flex-col gap-3">
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </div>
</div>



    
