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
                @if($event->is_private)
                <div class="bg-gray-100 rounded border border-gray-300 text-gray-600 italic p-6 mt-8">
                    Please note this is a private event that is not open to the public.
                </div>
                @else
                <div class="bg-gray-100 rounded border border-gray-300 p-6 mt-8">
                    <h4 class="text-gray-600">Please fill in your details below to register for this event.</h4>
                    @if($event->limited != 0)
                        @if($event->attendees <= $event->attendee_count)
                            <div>
                                This event is fully booked
                                @php
                                    $full = true;
                                @endphp
                            </div>
                        @else
                            <div>
                                {{ $event->attendees - $event->attendees_count }} places left
                            </div>
                        @endif
                    @endif

                    @if(\Session::has('registered'))
                        <div class="bg-gray-700 border border-gray-300 text-gray-100 p-2 rounded mt-4">
                            Thank you for registering to the event!
                        </div>
                    @endif

                    <div class="my-6">
                        @if ($errors->any())
                            <div class="bg-red-200 rounded border border-red-400 px-4 py-2 my-2">
                                <ul class="list-none list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li class="text-red-700 font-semibold">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('attendee.store') }}" class='' method="POST">
                            @csrf
                            @honeypot
                            <input type="hidden" name="event" value="{{ $event->id }}">
                            @if($full)
                            <input type="hidden" name="waiting" value="1">
                            @endif
                            <div class="lg:flex items-start">
                                <div class="grow mr-4 mb-4 md:mb-0">
                                    <div class="mt-1">
                                        <input type="text" name="name" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="First & Last Name">
                                    </div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 ml-3 mt-1">Name</label>
                                </div>
                                <div class="grow mr-4 mb-4 md:mb-0">
                                    <div class="mt-1">
                                        <input type="tel" name="phone" id="phone" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="066 888 8888">
                                    </div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 ml-3 mt-1">Phone</label>
                                </div>
                                <div class="grow mr-4 mb-4 md:mb-0">
                                    <div class="mt-1">
                                        <input type="email" name="email" id="email" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="you@example.com">
                                    </div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 ml-3 mt-1">Email</label>
                                </div>
                                <div class="pt-1">
                                    @if($full)
                                        <button type="submit" class="button-primary" aria-label="Add to waiting list">
                                            ADD TO WAITING LIST
                                        </button>
                                    @else
                                        <button type="submit" class="button-primary" aria-label="Register as participant">
                                            REGISTER
                                        </button>
                                    @endif

                                </div>
                            </div>
                            <div class="mt-6 bg-gray-200 rounded p-2">
                                <input type="checkbox" name="opt_in" value="1" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2">
                                <label for="opt_in" class="font-medium text-gray-700">I agree to be contacted in future about the upcoming events.</label>
                            </div>
                        </form>
                        <div class="text-gray-500 text-sm mt-4">
                            Your personal details won't be shared with anyone unauthorised. We only use it if the organiser of the event make some changes, like changing times, cancelling etc.
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
