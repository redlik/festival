<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ $event->name }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        @php
            $full = false;
        @endphp
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
            <div class="grid grid-cols-5 gap-4">
                <div class="col-span-5 md:col-span-2">
                    <img src="{{ $event->getFirstMediaUrl('cover') }}" alt="{{ $event->name }} event at Kerry Mental Health & Wellbeing Fest 2022">
                </div>
                <div class="col-span-5 md:col-span-3">
                    <h4 class="font-bold text-xl">{{ $event->name }}</h4>
                    <div>
                        {{ $event->description }}
                    </div>
                    <div class="my-4">
                        <h5 class="uppercase underline mb-2">Details:</h5>
                        <div class="mb-2"><strong>Date & time:</strong> {{ \Carbon\Carbon::parse($event->start_date)->format('d M') }} @ {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}
                            @if($event->end_time)
                            - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                            @endif</div>
                        <div class="mb-2"><strong>Venue:</strong>
                            @if($event->type === 'online')
                                <span class="text-indigo-500 ml-4"><i class="fa-solid fa-video mr-1"></i> Online event</span>
                            @else
                                {{ $event->venue->name }}, {{ $event->venue->town }}
                            @endif
                        </div>
                        <div class=""><strong>Organiser:</strong> {{ $event->user->organiser->org }}</div>
                        <div class="flex mb-2 mt-1">
                            <a href="mailto:{{ $event->user->email }}?subject=Question about {{ $event->name }} event" title="Contact organiser"><i class="fa-solid fa-envelope mr-4 text-purple-500 text-xl"></i></a>
                            @if($event->user->organiser->website)
                                <a href="{{ $event->user->organiser->website }}" target="_blank" title="Visit our website"><i class="fa-solid fa-globe mr-4 text-green-600 text-xl"></i></a>
                            @endif
                            @if($event->user->organiser->facebook)
                                <a href="{{ $event->user->organiser->facebook }}" target="_blank" title="Visit our Facebook page"><i class="fa-brands fa-facebook-square mr-4 text-indigo-600 text-xl"></i></a>
                            @endif
                            @if($event->user->organiser->twitter)
                                <a href="{{ $event->user->organiser->twitter }}" target="_blank" title="Check our Twitter"><i class="fa-brands fa-twitter-square mr-4 text-blue-500 text-xl"></i></a>
                            @endif
                            @if($event->user->organiser->instagram)
                                <a href="{{ $event->user->organiser->instagram }}" target="_blank" title="Check our Instagram"><i class="fa-brands fa-instagram-square text-orange-600 text-xl mr-4"></i></a>
                            @endif
                            @if($event->user->organiser->linkedin)
                                <a href="{{ $event->user->organiser->linkedin }}" target="_blank" title="Check our LinkedIn"><i class="fa-brands fa-linkedin text-blue-700 text-xl"></i></a>
                            @endif
                        </div>
                        @if($event->leader_name)
                            <div class="mb-2"><strong>Facilitator:</strong> {{ $event->leader_name }}</div>
                        @endif
                        <div class="mb-2"><strong>Target:</strong>
                            @if($event->target === '[]')
                                <span class="gray-pillow ml-4">Open to everyone</span>
                            @else
                                @foreach(json_decode($event->target) as $target_item)
                                    <div class="gray-pillow mr-1">
                                        {{ ucfirst($target_item) }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
