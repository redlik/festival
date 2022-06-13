<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Organiser Dashboard
        </h2>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 py-6 bg-gray-100 z-10">
        <div class="max-w-7xl mx-auto">

            <div>
                <div class="p-6 border border-gray-200 rounded-lg mt-6 bg-white shadow-inner shadow-lg" id="events">
                    <div class="flex justify-between mb-4">
                        <h2 class="text-olive-400 uppercase">Events</h2>
                        <a href="{{ route('event.create') }}">
                            <button class="button-primary">+ Add new event</button>
                        </a>
                    </div>

                    @if (\Session::has('event_submitted'))
                        <div class="bg-gray-100 border border-gray-400 shadow rounded p-2 my-4">
                            Thank you for submitting your event. We will review it shortly and either;
                            <ul class="list-decimal list-inside">
                                <li><strong>Approve and publish it</strong> on the website or</li>
                                <li>Come back to you for further details or clarification.</li>
                            </ul>
                        </div>
                    @endif
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date & Time</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Organiser</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Venue</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Attendees</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">Edit
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($events as $event)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                    <a href="{{ route('event.show', $event) }}" class="hover:underline">
                                        {{ $event->name }}

                                    </a>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div>{{ $event->start_date }}</div>
                                    <div>{{ $event->start_time }} - {{ $event->end_time }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div>
                                        {{ $event->user->organiser->name }}
                                    </div>
                                    <div>
                                        {{ $event->user->organiser->org }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div>{{ $event->venue->name }}</div>
                                    <div>{{ $event->venue->address1 }} | {{ $event->venue->street }} | {{ $event->venue->town }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    @if($event->limited == 1)
                                    {{ $event->attendee_count ?? '0' }} / {{ $event->attendees }}
                                    @else
                                    <div>No limit</div>
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ ucfirst($event->status) }}
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-semibold sm:pr-6 lg:pr-8">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr colspan="4">
                                <td><h4>No events created</h4></td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>

                </div>
                <div class="p-6 border border-gray-200 rounded-lg mt-6 bg-white shadow-inner shadow-lg" id="attendees">
                    @livewire('attendee-list')
                </div>
            </div>

        </div>
    </div>


</x-app-layout>
