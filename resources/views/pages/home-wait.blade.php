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
            <div class="w-full lg:w-2/3 p-4 lg:rounded-lg backdrop-blur"
                 style="background-color: rgba(213, 208, 136, 0.85)">
                <h1 class="text-2xl lg:text-4xl mb-4 fancy font-semibold">Welcome to Kerry Mental Health & Wellbeing
                    Fest 2025</h1>
                <div class="font-semibold lg:text-lg text-gray-800 mb-4">Held between Saturday, 4th – 11th October 2025
                    the Fest aims to raise awareness of the available supports and services in the county as well as
                    empower people to engage with the ‘Five Ways to Wellbeing’ through offering a dynamic and
                    interactive programme of events.
                </div>
                <a href="{{asset('img/Kerrywellfest2024.pdf')}}" target="_blank"">
                    <button class="button-primary">View events of 2024</button>
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
                    <strong>You are logged in now</strong><br />
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
        <div class="max-w-7xl mx-auto px-4 py-12 lg:flex items-center justify-between">
            {{--            <div class="">--}}
            {{--                <h3 class="uppercase text-2xl mb-4">Upcoming events</h3>--}}
            {{--            </div>--}}
            {{--            @livewire('event-list')--}}
            <div class="w-full lg:w-1/2">
                <h2 class="text-2xl tracking-tight uppercase text-gray-700 md:text-4xl">
                    <span class="block">Organising an event in 2025?</span>
                </h2>
                <div class="block text-2xl text-olive-600 mt-2">Fill out the registration form</div>
                <p class="text-sm mt-2 mb-4">If you have already registered last year, you don't need to fill out the
                    registration form again. <br>Just use the login details to access the Dashboard.
                </p>
                <a href="{{ route('login') }}"
                   class="font-bold my-4 px-4 py-2 rounded bg-olive-50 text-olive-700 shadow hover:text-white hover:bg-olive-600">Login
                    here</a>
            </div>
            <div class="w-full lg:w-1/2 mt-6 lg:mt-0 flex justify-start lg:justify-center">
                <a href="{{ route('pages.organiser-registration') }}" class="button-primary">
                    Organiser registration
                </a>
            </div>
        </div>

        <div class="bg-gray-100 py-8">
            <div class="max-w-7xl mx-auto py-4 px-4 lg:flex lg:items-center" x-data="{ showPoster : false }">
                <div class="w-full lg:w-1/2 mb-4 lg:mb-0">
                    <h3 class="text-2xl mb-2">Events of 2024 Kerry Mental & Wellbeing Health Festival</h3>
                    <p class="mb-6">If you like to see what events you may expect, click on the thumbnail or download
                        the PDF of the last year's programme.</p>
                    <a class="button-primary" href="{{asset('img/Kerrywellfest2024.pdf')}}"
                       target="_blank"><i class="fa-solid fa-file-pdf"></i> 2024 Fest schedule</a>
                </div>
                <div class="w-full lg:w-1/2 h-48 flex justify-center">
                    <a href="#" @click="showPoster = true" class="h-full">
                        <img src="{{ asset('img/kerrywellfest2024-thumb.jpg') }}" alt=""
                             class="shadow h-full hover:shadow-xl">
                    </a>
                </div>
                {{--Modal for schedule image--}}
                <div @keydown.window.escape="showPoster = false" x-cloak x-show="showPoster"
                     class="fixed z-10 inset-0 overflow-y-auto">
                    <div
                        class="flex items-end justify-center min-h-screen w-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                        <div x-show="showPoster" x-transition:enter="ease-out duration-300"
                             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             x-description="Background overlay, show/hide based on modal state."
                             class="fixed inset-0 bg-gray-700 bg-opacity-75 transition-opacity"
                             @click="showPoster = false" aria-hidden="true">
                        </div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
                        <div x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-90"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-90" x-on:click.away="showPoster = false"
                             class="p-2 fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center bg-black bg-opacity-75">
                            <div @click.away="showPoster = false"
                                 class="flex flex-col w-11/12 max-h-full p-8 overflow-auto">
                                <div class="z-50">
                                    <button @click="showPoster = false"
                                            class="float-right pt-2 pr-2 outline-none focus:outline-none">
                                        <svg class="fill-current text-white " xmlns="http://www.w3.org/2000/svg"
                                             width="18" height="18" viewBox="0 0 18 18">
                                            <path
                                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                                <div class="p-2">
                                    <img loading="lazy"
                                         src="{{asset('img/kerry_mh_and_wellbeing_fest_events__2023.png')}}" alt=""
                                         class="w-full h-full object-contain">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-olive-50 py-8">
            <div class="max-w-7xl mx-auto py-4 px-4 lg:flex lg:items-center gap-6">
                <img src="{{ asset('img/sign-language.webp') }}" alt="Sign language icon" width="150px" height="150px" class="mx-auto mb-4 lg:mb-0">
                <div class="font-semibold">
                    The Fest has a limited budget to support with Irish Sign Language (ISL) Interpretation. If you require an ISL interpreter to be present at an event, please notify us using our contact form or email us on
                    <a href="mailto:kerrymhwfest20@gmail.com" class="font-bold underline">kerrymhwfest20@gmail.com</a> and we will work within our capacity to provide ISL services when and where possible
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
