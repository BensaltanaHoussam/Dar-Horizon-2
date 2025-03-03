<nav x-data="{ open: false }" class="bg-black py-2 text-white border-b border-gray-800">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Left: Logo -->
            <div class="flex items-center">
                <img class="w-[120px] filter brightness-0 invert" src="{{ asset('assets/img/Logo.png') }}" alt="logo">
            </div>

            <!-- Center: Navigation Links (Hidden on mobile) -->
            <div class="hidden space-x-8 sm:flex">
                <x-nav-link :href="route('tourist.listings')" :active="request()->routeIs('tourist.listings')"
                    class="text-gray-300 hover:text-white transition-colors duration-200 {{ request()->routeIs('owner.dashboard') ? 'text-blue-500' : 'text-white' }}">
                    Home
                </x-nav-link>
                <x-nav-link :href="route('tourist.favorites')" :active="request()->routeIs('tourist.favorites')"
                    class="text-white hover:text-white transition-colors duration-200 {{ request()->routeIs('tourist.favorites') ? 'text-blue-500' : '' }}">
                    My Favorites
                </x-nav-link>
                <x-nav-link :href="route('tourist.bookings')" :active="request()->routeIs('tourist.bookings')" 
                    class="text-white hover:text-white transition-colors duration-200 {{ request()->routeIs('tourist.favorites') ? 'text-blue-500' : '' }}">
                    Bookings
                </x-nav-link>
                <x-nav-link href="#" class="text-gray-300 hover:text-white transition-colors duration-200">
                    Contact
                </x-nav-link>
            </div>

            <!-- Right: User Dropdown -->
            <div class="hidden sm:flex items-center space-x-6">
                @auth
                    <div class="relative" x-data="{ dropdownOpen: false }">
                        <button @click="dropdownOpen = !dropdownOpen"
                            class="flex items-center space-x-2 focus:outline-none group">
                            <span
                                class="text-gray-300 group-hover:text-white transition-colors duration-200">{{ Auth::user()->name }}</span>
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-colors duration-200"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <!-- Dropdown Menu -->
                        <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                            class="absolute right-0 mt-2 w-48 bg-gray-900 text-gray-300 rounded-md shadow-lg border border-gray-800 z-50">
                            <x-dropdown-link :href="route('profile.edit')"
                                class="px-4 py-2 block hover:bg-gray-800 transition-colors duration-200">
                                Profile
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    class="px-4 py-2 block hover:bg-gray-800 transition-colors duration-200"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-gray-300 hover:text-white transition-colors duration-200">Login</a>
                    <a href="{{ route('register') }}"
                        class="bg-white text-black px-5 py-2 rounded-md hover:bg-gray-200 transition-colors duration-200">Sign
                        Up</a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button @click="open = !open" class="sm:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16m-7 6h7"></path>
                    <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open" class="sm:hidden bg-gray-900">
        <div class="pt-2 pb-3 space-y-1">
            <x-nav-link :href="route('tourist.listings')" :active="request()->routeIs('tourist.listings')"
                class="text-gray-300 hover:text-white transition-colors duration-200 {{ request()->routeIs('owner.dashboard') ? 'text-blue-500' : 'text-white' }}">
                Home
            </x-nav-link>
            <x-nav-link :href="route('tourist.favorites')" :active="request()->routeIs('tourist.favorites')"
                class="text-white hover:text-white transition-colors duration-200 {{ request()->routeIs('tourist.favorites') ? 'text-blue-500' : '' }}">
                My Favorites
            </x-nav-link>
            <x-nav-link :href="route('tourist.bookings')" :active="request()->routeIs('tourist.bookings')">
                Bookings
            </x-nav-link>
            <x-nav-link href="#" class="text-gray-300 hover:text-white transition-colors duration-200">
                Contact
            </x-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-800">
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')"
                        class="block px-4 py-2 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors duration-200">
                        Profile
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            class="block px-4 py-2 text-gray-300 hover:bg-gray-800 hover:text-white transition-colors duration-200"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>