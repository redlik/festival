<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div id="hero" style="background-image: url('{{ asset('img/home-hero.jpg') }}');background-size: cover" class="bg-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-wrap items-center py-48">
            <div class="w-full md:w-1/2 p-4 rounded-lg" style="background-color: rgba(213, 208, 136, 0.95)">
                <h1 class="text-5xl fancy mb-4">Welcome to Kerry Mental Health & Welbeing Fest 2022</h1>
                <h4 class="font-semibold mb-4">Held between Saturday, 8th – 15th October 2022 the Fest aims to raise awareness of the available supports and services in the county as well as empower people to engage with the ‘Five Ways to Wellbeing’ through offering a dynamic and interactive programme of events.</h4>
                <button class="button-primary">Browse events</button>
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
    <div class="mb-6 bg-gray-200">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:py-8 lg:px-8 lg:flex lg:items-center lg:justify-between">

                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 md:text-4xl">
                        <span class="block">Organising a event?</span>
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
    <div style="bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
            <div class="">
                <h3 class="font-bold text-2xl mb-4">Upcoming events</h3>
            </div>
            <div class="flex">
                <div class="bg-gray-200 w-48 min-w-32 mr-4">
                    <h5>Filters go here</h5>
                </div>
                <div>
                    <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 lg:grid-cols-3 ">
                        @foreach($events as $event)
                            <li class="relative">
                                <div class="group block w-full h-max-32 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-indigo-500 overflow-hidden">
                                    <a href="{{ route('event.show', $event) }}">
                                        <img src="https://source.unsplash.com/400x300/?nature" alt="" class="object-cover pointer-events-none group-hover:opacity-75">
                                        <button type="button" class="absolute inset-0 focus:outline-none">
                                            <span class="sr-only">View details for IMG_4985.HEIC</span>
                                        </button>
                                    </a>
                                </div>
                                <div class="flex items-center py-2">
                                    <div class="mr-6">
                                        <div class="font-light text-center">{{ \Carbon\Carbon::parse($event->start_date)->format('M') }}</div>
                                        <div class="text-2xl text-black font-bold text-center">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</div>
                                    </div>
                                    <div>
                                        <div>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}</div>
                                        <a href="{{ route('event.show', $event) }}">
                                            <p class="text-lg block text-sm font-bold text-gray-900 truncate pointer-events-none">{{ $event->name }}</p>
                                            <p class="block text-sm font-medium text-gray-500 pointer-events-none">{{ $event->venue->name }}</p>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
