<div class="h-full navbar container py-2 mx-auto flex items-center sm:rounded-3xl ">
    <div class="logo flex items-center h-full ml-4">
        <img class="w-auto h-full object-cover" src="{{ asset('storage/images/icons/patisserie.svg') }}" alt="">
        <p class="">Glamour</p>
    </div>
    <div class="navbar-nav mr-4">
        <ul class="flex gap-x-4">
            <li class="nav-item">
                <a href="#">Home</a>
            </li>
            <li class="nav-item">
                <a href="#">About</a>
            </li>
            <li class="nav-item">
                <a href="#">Product</a>
            </li>
            <li class="nav-item dropdown-toggle relative">
                <a href="#">Services</a>
                <div class="dropdown-menu hidden">
                    <a href=""></a>
                    <a href=""></a>
                </div>
            </li>
            <li class="nav-item">
                <a href="#">Teams</a>
            </li>
            <li class="nav-item">
                <a href="#">Contact</a>
            </li>
            <li class="nav-item">
                <x-user-name-section />
            </li>
        </ul>
    </div>
    <div id="burgerMenu" class="burger-menu ml-auto">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
    </div>
    <div id="mobileMenu" class="mobile-menu">
        <div class="flex m-10 justify-between">
            <img class="w-auto h-[2rem] object-cover" src="{{ asset('storage/images/icons/patisserie.svg') }}" alt="">
            <button id="closeBtn">x</button>
        </div>
        
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </div>
</div>

    
