<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 py-6 bg-white z-10">
        <div class="max-w-7xl mx-auto">
            <div>
                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">

                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Organisers registered
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ $organisers_count }}
                        </dd>
                    </div>

                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Events added
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ $events->count() }}
                        </dd>
                    </div>

                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-medium text-gray-500 truncate">
                            Attendees registered
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ $attendees->count() }}
                        </dd>
                    </div>

                </dl>
            </div>
            <div>
                <div class="p-6 border border-gray-200 rounded-lg mt-6" id="events">
                    <div class="flex justify-between">
                        <h2 class="text-green-600">Events</h2>
                    </div>
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date & Time</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Organiser</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Venue</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Attendees</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">Edit
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($events as $event)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                    <a href="{{ route('admin.event.show', $event) }}" class="hover:underline">
                                        {{ $event->name }}

                                    </a>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div>{{ $event->start_date }}</div>
                                    <div>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') ?? "Not set" }}</div>
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
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-semibold sm:pr-6 lg:pr-8">
                                    <a href="{{ route('admin.event.show', $event) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Show details</a>
                                    <a href="#" class="text-red-600 hover:text-red-900">Delete ?</a>
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
                <div class="p-6 border border-gray-200 rounded-lg mt-6" id="venues">
                    <div class="flex justify-between">
                        <h2 class="text-purple-600 mb-6">Venues</h2>
                        <button class="text-olive-400 font-semibold px-2 py-0 bg-gray-100 rounded hover:bg-gray-200">+ Add new venue</button>
                    </div>
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Address</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Assigned</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">Edit
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($venues as $venue)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ $venue->name }}</td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><div>
                                        {{ $venue->address1 }}, {{ $venue->street }}
                                    </div>
                                    <div>
                                        {{ $venue->town }}, {{ $venue->county }}
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $venue->event_count }}</td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-semibold sm:pr-6 lg:pr-8">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr colspan="4">
                                <td><h4>No venues created</h4></td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
                <div class="p-6 border border-gray-200 rounded-lg mt-6" id="attendees">
                    <h2 class="text-olive-300 mb-6">Attendees</h2>
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Event</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Registered on</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                        @forelse($attendees as $attendee)
                            <tr>
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                                    <div>{{ $attendee->name }}</div>
                                    <div>E: {{ $attendee->email }}   T: {{ $attendee->phone }}</div>

                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $attendee->event->name }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $attendee->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr colspan="4">
                                <td><h4>No venues created</h4></td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


</x-app-layout>
