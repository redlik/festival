<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ $event->name }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
            <img src="https://source.unsplash.com/1600x900/?nature" alt="">
            <div class="flex my-6">
                <div class="w-2/3">
                    {{ $event->description }}
                </div>
                <div class="w-1/3">
                    <h4>Details</h4>
                    <div>Date & time: {{ $event->start_date }} @ {{ $event->start_time }} - {{ $event->end_time }}</div>
                    <div>Venue: {{ $event->venue->name }}</div>
                    <div>Target:
                    @foreach(json_decode($event->target) as $target_item)
                        <div class="gray-pillow mr-1">
                            {{ ucfirst($target_item) }}
                        </div>

                    @endforeach
                    </div>
                </div>
            </div>
            @if($event->limited != 0)
                <div class="bg-gray-100 rounded border border-gray-300 p-6">
                    <h4 class="text-gray-600">Please fill in your details below to register for this event.</h4>
                    <div>
                        {{ $event->attendees - $event->attendees_count }} places left
                    </div>
                    <div class="my-6">
                        <form action="{{ route('attendee.store') }}" class='' method="POST">
                            @csrf
                            <input type="hidden" name="event" value="{{ $event->id }}">
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
                                    <button type="submit" class="button-primary">
                                        REGISTER
                                    </button>
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
