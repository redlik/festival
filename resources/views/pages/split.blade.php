<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Registration') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="bg-gray-100">
            <div class="mx-auto max-w-7xl">
                <div class="px-4 sm:px-6 lg:px-8 h-full w-full lg:flex divide-x divide-gray-300">
                    <div class="w-full lg:w-1/2 mt-8 lg:mt-0 text-center p-8">
                        <img src="{{ asset('img/organiser.png') }}" alt="" class="w-64 block mx-auto">
                        <h2>Organiser</h2>
                        <p class="my-6">We would be delighted for you to get involved by hosting a free event(s) that promote the Five Ways to Wellbeing - whether you’re an educational body, organisation, agency, business, sports club, community group or qualified individual. </p>
                        <p class="bg-gray-200 p-4 rounded text-sm my-6">If you already registered as an organiser last year, you don't need to register again. Just use the login details and start adding new events.</p>
                        <a href="{{ route('pages.join-us') }}" class="button-primary mt-8">Register as Organiser</a>
                    </div>
                    <div class="w-full lg:w-1/2 mt-8 lg:mt-0 text-center p-8">
                        <img src="{{ asset('img/attendee.png') }}" alt="" class="w-64 block mx-auto">
                        <h2 id="registration-form">Attendee</h2>
                        <p class="my-6">If you like to attend any of the events at the Festival, please create your account below. The account will allow you to track your event registrations, cancel them if needed and contact the organisers should you have any questions.</p>
                        @guest
                            <form method="POST" action="{{ route('register.attendee') }}" class="text-left p-4 bg-white rounded shadow-inner">
                                @csrf

                                <!-- Name -->
                                <div>
                                    <x-label for="name" :value="__('Name')" />

                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                </div>

                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-label for="email" :value="__('Email')" />

                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-label for="password" :value="__('Password')" />

                                    <x-input id="password" class="block mt-1 w-full"
                                             type="password"
                                             name="password"
                                             required autocomplete="new-password" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                             type="password"
                                             name="password_confirmation" required />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>

                                    <x-button class="ml-4">
                                        {{ __('Register') }}
                                    </x-button>
                                </div>
                            </form>
                        @endguest
                        @auth
                            <h4>You are already registered.</h4>

                        @endauth


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
