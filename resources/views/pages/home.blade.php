<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div id="hero" class="bg-center bg-gray-100 md:bg-[url('/img/home-hero.jpg')] bg-cover">
        <div class="max-w-7xl mx-auto px-0 lg:px-8 flex flex-wrap items-center pt-0 pb-0 lg:py-48">
            <div class="w-full md:hidden">
                <img src="{{ asset('img/home-hero.jpg') }}" class="object-cover object-bottom h-full w-full" alt="">
            </div>
            <div class="w-full lg:w-1/2 p-4 lg:rounded-lg backdrop-blur" style="background-color: rgba(213, 208, 136, 0.95)">
                <h1 class="text-2xl lg:text-4xl mb-4 fancy font-semibold">Welcome to Kerry Mental Health & Welbeing Fest 2022</h1>
                <div class="font-semibold lg:text-lg text-gray-800 mb-4">Held between Saturday, 8th – 15th October 2022 the Fest aims to raise awareness of the available supports and services in the county as well as empower people to engage with the ‘Five Ways to Wellbeing’ through offering a dynamic and interactive programme of events.</div>
                <a href="{{ route('events') }}">
                    <button class="button-primary">Browse events</button>
                </a>
            </div>
        </div>
    </div>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (Session::has('message'))
                <div class="bg-red-200 p-2 rounded shadow my-8">{{ Session::get('message') }}</div>
            @endif
            @if (\Session::has('login'))
                <div class="alert-box my-4">
                    <strong>You are logged in now</strong><br/>
                </div>
            @endif
        </div>
    </div>
    <div class="bg-gray-200">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:py-8 lg:px-8 lg:flex lg:items-center lg:justify-between">

                <div>
                    <h2 class="text-2xl tracking-tight uppercase text-gray-700 md:text-4xl">
                        <span class="block">Organising an event?</span>
                    </h2>
                    <span class="block text-2xl text-olive-600">Fill out the application form</span>
                </div>
                <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                    <div class="inline-flex rounded-md shadow">
                        <a href="/join-us" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-semibold rounded-md text-white bg-olive-600 hover:bg-olive-700 uppercase">
                            Organiser registration
                        </a>
                    </div>
                </div>
            </div>
    </div>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
            <div class="">
                <h3 class="uppercase text-2xl mb-4">Upcoming events</h3>
            </div>
            @livewire('event-list')
        </div>
    </div>
</x-app-layout>
