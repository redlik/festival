<x-seobox>
    {{ $event->name }} - {{ config('app.name') }}
</x-seobox>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ $event->name }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
            <div class="grid grid-cols-5 gap-4">
                <div class="col-span-5 md:col-span-2">
                    <img src="{{ $event->getFirstMediaUrl('cover') }}"
                         alt="{{ $event->name }} event at Kerry Mental Health & Wellbeing Fest 2023"
                         style="max-height: 470px;object-fit: contain;"
                         class="rounded mx-auto">
                </div>
                <div class="col-span-5 md:col-span-3 flex flex-col justify-between gap-6">
                    <div class="lg:flex justify-between items-start">
                        <div class="w-full">
                            <h4 class="font-bold text-2xl text-gray-600">{{ $event->name }}</h4>
                            <div class="mt-2">
                                {{ $event->description }}
                            </div>
                        </div>
                        @if($event->wheelchair_accessible)
                            <div class="w-full lg:w-24 lg:flex-shrink-0 lg:ml-8 mt-10">
                                <img src="{{ asset('img/wheelchair.svg') }}" alt="" class="w-20">
                            </div>
                        @endif
                    </div>
                    <div class="bg-gray-100 p-2 rounded shadow-sm">
                        <h5 class="uppercase underline text-gray-600 mb-2">Event Details:</h5>
                        <div class="mb-3 lg:flex">
                            <div class="w-full lg:w-36 lg:flex-shrink-0"><strong>Date & time:</strong></div>
                            <div class="w-full lg:w-auto">
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d M') }}
                                @ {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}
                                @if($event->end_time)
                                    - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                @endif
                            </div>
                        </div>
                        <div class="mb-3 lg:flex">
                            <div class="w-full lg:w-36 lg:flex-shrink-0">
                                <strong>Venue:</strong>
                            </div>
                            <div class="w-full lg:w-auto">
                                @if($event->type === 'online')
                                    <span class="text-indigo-500 ml-4"><i class="fa-solid fa-video mr-1"></i> Online event</span>
                                @else
                                    <div class="flex gap-4">
                                        <div>
                                            {{ $event->venue->name }}, {{ $event->venue->town }}{{ $event->venue->eircode ? ', '.$event->venue->eircode : '' }}
                                        </div>
                                        <div>
                                            <a href="https://www.google.com/maps/search/?api=1&query={{ $event->venue->address() }}" target="_blank" title="Show location on Google Maps">
                                                <i class="fa-solid fa-map-location-dot text-olive-500"></i>
                                            </a>
                                        </div>
                                    </div>

                                @endif
                            </div>
                        </div>
                        <div class="lg:flex">
                            <div class="w-full lg:w-36 lg:flex-shrink-0">
                                <strong>Organiser:</strong>
                            </div>
                            <div class="w-full lg:w-auto">
                                {{ $event->user->organiser->org }}
                            </div>
                        </div>
                        @if($event->leader_name)
                            <div class="mt-3 lg:flex">
                                <div class="w-full lg:w-36 lg:flex-shrink-0">
                                    <strong>Facilitator:</strong>
                                </div>
                                <div class="w-full lg:w-auto">
                                    {{ $event->leader_name }}
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="pl-2 mt-4 lg:mt-0">
                        <div>
                            <h5 class="text-gray-600">This event is best suited for:</h5>
                        </div>
                        <div class="mt-1">
                            @if($event->target === '[]')
                                <span class="green-pillow mr-4">Open to everyone</span>
                            @else
                                @foreach(json_decode($event->target) as $target_item)
                                    <div class="gray-pillow mr-2">
                                        {{ ucfirst($target_item) }}
                                    </div>
                                @endforeach
                            @endif
                        </div>

                    </div>
                    <div class="bg-gray-50 p-2 rounded mt-4 pb-6 lg:mt-0">
                        <h5 class="text-gray-600">Contact organiser:</h5>
                        <div class="flex mt-4">
                            <a href="tel:{{ $event->phone }}"
                               title="Contact organiser"><i
                                    class="fa-solid fa-phone-square-alt fa-xl mr-6 text-green-500 text-xl"></i></a>
                            <a href="mailto:{{ $event->user->email }}?subject=Question about {{ $event->name }} event"
                               title="Contact organiser"><i
                                    class="fa-solid fa-envelope fa-xl mr-6 text-purple-500"></i></a>
                            @if($event->user->organiser->website)
                                <a href="{{ $event->user->organiser->website }}" target="_blank"
                                   title="Visit our website"><i
                                        class="fa-solid fa-globe fa-xl mr-6 text-green-600"></i></a>
                            @endif
                            @if($event->user->organiser->facebook)
                                <a href="{{ $event->user->organiser->facebook }}" target="_blank"
                                   title="Visit our Facebook page"><i
                                        class="fa-brands fa-facebook-square fa-xl mr-6 text-indigo-600 text-xl"></i></a>
                            @endif
                            @if($event->user->organiser->twitter)
                                <a href="{{ $event->user->organiser->twitter }}" target="_blank"
                                   title="Check our Twitter"><i
                                        class="fa-brands fa-twitter-square fa-xl mr-6 text-blue-500 text-xl"></i></a>
                            @endif
                            @if($event->user->organiser->instagram)
                                <a href="{{ $event->user->organiser->instagram }}" target="_blank"
                                   title="Check our Instagram"><i
                                        class="fa-brands fa-instagram-square fa-xl text-orange-600 text-xl mr-6"></i></a>
                            @endif
                            @if($event->user->organiser->linkedin)
                                <a href="{{ $event->user->organiser->linkedin }}" target="_blank"
                                   title="Check our LinkedIn"><i
                                        class="fa-brands fa-linkedin fa-xl text-blue-700 text-xl"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
           @livewire('booking-panel', ['event' => $event])

        </div>
    </div>
</x-app-layout>
