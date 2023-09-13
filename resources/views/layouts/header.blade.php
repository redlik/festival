<!-- This example requires Tailwind CSS v2.0+ -->
<nav x-data="{ open: false }" class="bg-yellow-300">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-top justify-between h-24">
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
                <div class="flex-shrink-0 flex items-top">
                    <a href="/">
                        <img class="block lg:hidden h-20 w-auto" src="{{ asset('img/logo-header.svg') }}" alt="kerry fest mobile logo">
                        <img class="hidden lg:block w-24 bg-white p-3 shadow-lg object-contain" src="{{ asset('img/logo-header.svg') }}" alt="kerry fest desktop logo">
                    </a>
                </div>
                <div class="hidden sm:block sm:ml-6 sm:py-4">
                    <div class="flex space-x-4 items-center h-full" x-data="{ admin: false }">
                            <a href="/" class="text-black hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                        font-semibold">Home</a>

                        <a href="{{ route('events') }}" class="hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                        font-medium">Events</a>

                        <a href="{{ route('pages.about') }}" class="hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                        font-medium">About</a>

                        <a href="{{ route('pages.contact') }}" class="hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md
                        font-medium">Contact</a>

                        @role('organiser')
                            <a href="{{ route('dashboard') }}" class="hover:bg-indigo-600 hover:text-white hover:bg-olive-600 px-3 py-2 rounded-md
                    text-sm font-bold">Dashboard</a>
                        @endrole

                        @hasanyrole('organiser|attendee')
                        <a href="{{ route('attendee.bookings') }}" class="hover:bg-indigo-600 hover:text-white hover:bg-olive-600 px-3 py-2 rounded-md
                    font-bold">Bookings</a>
                        @endrole

                        @role('admin')
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-white hover:bg-olive-600 px-3 py-2 rounded-md
                    font-bold">Admin Dashboard</a>
                        @endrole



                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 hidden md:flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                @guest
                    <a href="{{ route('pages.join-us') }}">
                        <button type="button" class="button-green mr-4" aria-label="Organiser registration">
                            Registration
                        </button>
                    </a>
                    <a href="{{ route('login') }}">
                        <button type="button" class="button-red" aria-label="Login">
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
                                <img class="h-8 w-8 rounded-full" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" alt="Auth::user()->name">
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
                    ring-1 ring-black ring-opacity-5 focus:outline-none z-50" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100", Not Active: "" -->
                            @role('organiser')
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="1" id="user-menu-item-1">Dashboard</a>
                            @endrole
                            @role('admin')
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="1" id="user-menu-item-1">Admin Dashboard</a>
                            <a href="{{ route('admin.organisers') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="1" id="user-menu-item-1">Organisers</a>
                            @endrole
                            <a href="{{ route('logout') }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="2"
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
            <a href="/" class="text-gray-700 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page">Home</a>

            <a href="/events" class="text-gray-700 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Events</a>

            <a href="/about" class="text-gray-700 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">About</a>

            <a href="/contact" class="text-gray-700 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">Contact us</a>
            @guest
                <a href="/login" class="text-green-700 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-bold uppercase">Login</a>
                <a href="/join-us" class="text-red-700 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-bold uppercase">Registration</a>
            @endguest
            @role('admin')
            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-bold ">Admin Dashboard</a>
            @endrole
            @role('organiser')
            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-bold ">Dashboard</a>
            @endrole
            @hasanyrole('organiser|attendee')
            <a href="{{ route('attendee.bookings') }}" class="text-gray-700 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-bold ">My Bookings</a>
            @endrole

        </div>
    </div>
</nav>
