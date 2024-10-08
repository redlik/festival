<x-seobox>
    Welcome to Kerry Mental Health & Wellbeing Fest
</x-seobox>
<x-app-layout>
    <x-slot name="header">
    </x-slot>
    @push('extra_styles')
        <script src="{{ asset('js/html5lightbox/jquery.js') }}"></script>
        <script src="{{ asset('js/html5lightbox/html5lightbox.js') }}"></script>
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
    @endpush

    <div id="hero" class="bg-center bg-gray-100 md:bg-[url('/img/home-hero-23.jpg')] bg-cover bg-no-repeat">
        <div class="max-w-7xl mx-auto px-0 lg:px-8 flex flex-wrap items-end pt-0 lg:pb-12 lg:pt-[500px]">
            <div class="w-full lg:hidden">
                <img src="{{ asset('img/home-hero-23.jpg') }}" class="object-cover object-bottom h-full w-full" alt="">
            </div>
            <div class="w-full lg:w-2/3 p-4 lg:rounded-lg backdrop-blur" style="background-color: rgba(213, 208, 136, 0.85)">
                <h1 class="text-2xl lg:text-4xl mb-4 fancy font-semibold">Welcome to Kerry Mental Health & Wellbeing Fest 2024</h1>
                <div class="font-semibold lg:text-lg text-gray-800 mb-4">Held between Saturday, 5th – 12th October 2024 the Fest aims to raise awareness of the available supports and services in the county as well as empower people to engage with the ‘Five Ways to Wellbeing’ through offering a dynamic and interactive programme of events.</div>
                <a href="{{ route('events') }}">
                    <button class="button-primary">View Events</button>
                </a>
            </div>
        </div>
    </div>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" id="messages">
            @if (Session::has('message'))
                <div class="bg-red-200 p-2 rounded shadow my-8">{{ Session::get('message') }}</div>
            @endif
            @if (\Session::has('login'))
                <div class="alert-box my-4">
                    <strong>You are logged in now</strong><br/>
                </div>
            @endif
            @if (\Session::has('disabled'))
                <div class="bg-red-100 text-red-500 rounded border border-red-500 p-3 my-4">
                    <strong>Your account has been disabled.</strong>
                </div>
            @endif
        </div>
    </div>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="text-center">
                <h3 class="uppercase text-3xl mb-6 text-olive-500">Upcoming events</h3>
            </div>
            @livewire('event-list')
        </div>
    </div>

    <div class="bg-gray-100">
            <div class="max-w-7xl mx-auto py-4 px-4 lg:flex lg:items-center" x-data="{ showPoster : false }">
                <div class="w-full lg:w-1/2 mb-4 lg:mb-0">
                    <h3 class="text-2xl mb-2">Events of 2024 Kerry Mental & Wellbeing Health Festival</h3>
                    <p class="mb-6">Click to view this year's Festival schedule.</p>
                    <a class="button-primary" href="{{asset('img/Kerrywellfest2024.pdf')}}" target="_blank"><i class="fa-solid fa-file-pdf"></i> 2024 Fest schedule</a>
                </div>
                <div class="w-full lg:w-1/2 h-48 flex justify-center">
                        <a href="#" @click="showPoster = true" class="h-full">
                            <img src="{{ asset('img/kerrywellfest2024-thumb.jpg') }}" alt="" class="shadow h-full hover:shadow-xl">
                        </a>
                </div>
            {{--Modal for schedule image--}}
                <div @keydown.window.escape="showPoster = false" x-cloak x-show="showPoster" class="fixed z-10 inset-0 overflow-y-auto">
                    <div class="flex items-end justify-center min-h-screen w-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                        <div x-show="showPoster" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-description="Background overlay, show/hide based on modal state." class="fixed inset-0 bg-gray-700 bg-opacity-75 transition-opacity" @click="showPoster = false" aria-hidden="true">
                        </div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
                        <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90" x-on:click.away="showPoster = false" class="p-2 fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center bg-black bg-opacity-75">
                            <div @click.away="showPoster = false" class="flex flex-col max-w-7xl max-h-full overflow-auto">
                                <div class="z-50">
                                    <button @click="showPoster = false" class="float-right pt-2 pr-2 outline-none focus:outline-none">
                                        <svg class="fill-current text-white " xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="p-2">
                                    <img src="{{asset('img/Kerrywellfest2024-hires.jpg')}}" alt="" class="w-full">
                                </div>
                            </div>

                    </div>
                </div>

            </div>
    </div>
    </div>
</x-app-layout>
