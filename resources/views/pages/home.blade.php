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
                <h1 class="text-2xl lg:text-4xl mb-4 fancy font-semibold">Welcome to Kerry Mental Health & Wellbeing Fest 2026</h1>
                <div class="font-semibold lg:text-lg text-gray-800 mb-4">Held between {{ \Carbon\Carbon::parse($start_date)->format('l, jS') }} - {{ \Carbon\Carbon::parse($end_date)->format('l, jS M Y') }} the Fest aims to raise awareness of the available supports and services in the county as well as empower people to engage with the ‘Five Ways to Wellbeing’ through offering a dynamic and interactive programme of events.</div>
                <a href="{{ route('events') }}">
                    <button class="button-primary">View Events</button>
                </a>
            </div>
        </div>
    </div>
  @if(\Illuminate\Support\Facades\Cache::get('homepage_banner') && json_decode(cache('homepage_banner'))->visibility)
    <div class="w-full bg-yellow-300 ">
      <div class="max-w-7xl mx-auto sm:p-6 lg:p-8 text-lg font-semibold text-center">
        {{ json_decode(cache('homepage_banner'))->text }}
      </div>
    </div>

  @endif
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
</x-app-layout>
