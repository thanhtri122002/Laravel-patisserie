<div class="huge-container mx-auto px-6 md:px-12">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <!-- Brand Section -->
        <div class="flex flex-col gap-4">
            <div class="flex items-center gap-3">
                <img class="size-14" src="{{ asset('storage/images/icons/patisserie.svg') }}" alt="Logo">
                <span class="text-h3 font-mer text-[--Pink-Primary]">Glamour</span>
            </div>
            <p class="text-body font-mer">
                Bringing you the finest patisserie delights, baked with love and elegance.
            </p>
        </div>

        <!-- Quick Links -->
        <div class="flex flex-col gap-5">
            <p class="text-h3 font-mer text-[--Pink-Primary]">Quick Links</p>
            <ul class="flex flex-col gap-3">
                <li><a href="/" class="transition-colors duration-200 hover:text-[--Pink-Primary]">Home</a></li>
                <li><a href="/home/teams" class="transition-colors duration-200  hover:text-[--Pink-Primary]">Our Team</a></li>
                <li><a href="/home/products" class="transition-colors duration-200  hover:text-[--Pink-Primary]">Products</a></li>
                <li><a href="/home/cart" class="transition-colors duration-200  hover:text-[--Pink-Primary]">Cart</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div class="flex flex-col gap-5">
            <p class="text-h3 font-mer text-[--Pink-Primary]">Contact</p>
            <ul class="flex flex-col gap-3">
                <li><span>Email:</span> info@glamour.com</li>
                <li><span>Phone:</span> +1 234 567 890</li>
                <li><span>Address:</span> 123 Patisserie Lane, Paris</li>
            </ul>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-[--Gray-Secondary] mt-10 pt-5 text-center text-sm">
        © {{ date('Y') }} Glamour Patisserie. All rights reserved.
    </div>
</div>