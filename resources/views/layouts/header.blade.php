<!-- This example requires Tailwind CSS v2.0+ -->
<nav x-data="{ open: false }" class="bg-groovb">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-24">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <!-- Mobile menu button-->
                <button @click="open = ! open" type="button" class="inline-flex items-center justify-center p-2
                rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!--
                      Icon when menu is closed.

                      Heroicon name: outline/menu

                      Menu open: "hidden", Menu closed: "block"
                    -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <!--
                      Icon when menu is open.

                      Heroicon name: outline/x

                      Menu open: "block", Menu closed: "hidden"
                    -->
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <div class="flex-shrink-0 flex items-center">
                    <a href="/">
                        <img class="block lg:hidden h-12 w-auto" src="{{ asset('img/logo-header.svg') }}">
                        <img class="hidden lg:block w-16 object-contain" src="{{ asset('img/logo-header.svg') }}">
                    </a>
                </div>
                <div class="hidden sm:block sm:ml-6 sm:py-4">
                    <div class="flex space-x-4" x-data="{ admin: false }">
                            <a href="/" class="text-white hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                        text-sm font-medium">Home</a>

                        <a href="" class="text-groovy hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                        text-sm font-medium">Events</a>

                        <a href="" class="text-groovy hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                        text-sm font-medium">About</a>

                        <a href="" class="text-groovy hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                        text-sm font-medium">Contact</a>

                        @auth
                            <a href="" class="text-groovy hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                    text-sm font-bold">My Events</a>
                        @endauth

                        <div class="relative flex">
                            @role('admin')
                            @if(Route::is('admin.*') )
                                <a href="#" @click="admin = ! admin" class="bg-gray-900 hover:bg-gray-700 text-white
                                px-3 py-2 rounded-md
                                text-sm
                            font-medium place-self-center" aria-current="page">Admin</a>
                            @else
                                <a href="#" @click="admin = ! admin" class="text-gray-300 hover:bg-gray-700
                                hover:text-white px-3 py-2 rounded-md
                            text-sm font-medium place-self-center">Admin</a>
                            @endif
                            @endrole
                            <div :class="{'block': admin, 'hidden': ! admin}" class="origin-top-left absolute top-0
                            mt-12 w-48
                            rounded-md
                            shadow-lg
                        py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu"
                                 aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <!-- Active: "bg-gray-100", Not Active: "" -->
                                <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
                                   role="menuitem"
                                   tabindex="-1" id="user-menu-item-0">Users</a>
                                <a href="" class="block px-4 py-2 text-sm text-gray-700
                                hover:bg-gray-200" role="menuitem"
                                   tabindex="-1" id="user-menu-item-1">Events</a>
                                <a href="" class="block px-4 py-2 text-sm text-gray-700
                                hover:bg-gray-200" role="menuitem"
                                   tabindex="-1" id="user-menu-item-2">Stats</a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                @guest
                    <a href="">
                        <button type="button" class="bg-groovy hover:bg-yellow-300 text-groovb px-8 py-2 rounded-md
                        text-sm font-bold mr-3">
                            JOIN US
                        </button>
                    </a>
                    <a href="">
                        <button type="button" class="bg-red-900 hover:bg-red-600 text-white px-3 py-2 rounded-md text-sm
                            font-medium">
                            Login
                        </button>
                    </a>
                @endguest
                @auth

                    <!-- Profile dropdown -->

                    <div class="ml-3 relative" x-data="{ profile: false }">
                        <div>
                            <button @click="profile = ! profile" type="button" class="bg-gray-800 flex text-sm
                        rounded-full
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="">
                            </button>
                        </div>

                        <!--
                          Dropdown menu, show/hide based on menu state.

                          Entering: "transition ease-out duration-100"
                            From: "transform opacity-0 scale-95"
                            To: "transform opacity-100 scale-100"
                          Leaving: "transition ease-in duration-75"
                            From: "transform opacity-100 scale-100"
                            To: "transform opacity-0 scale-95"
                        -->
                        <div :class="{'block': profile, 'hidden': ! profile}" class="origin-top-right absolute
                    right-0 mt-2
                    w-48 rounded-md shadow-lg py-1 bg-white
                    ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="0"
                               id="user-menu-item-0">Your Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="1" id="user-menu-item-1">Settings</a>
                            <a href="{{ route('pages.client-bookings') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="1" id="user-menu-item-1">My bookings</a>
                            <a href="{{ route('pages.client-events') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="1" id="user-menu-item-1">My events</a>
                            <a href="{{ route('logout') }}"
                               class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="2"
                               id="user-menu-item-2"
                               onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div :class="{'block': open, 'hidden': ! open}" class="sm:hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <a href="/" class="bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Home</a>

            <a href="/events" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Events</a>

            <a href="/about" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">About</a>

            <a href="/contact-us" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Contact us</a>
        </div>
    </div>
</nav>
