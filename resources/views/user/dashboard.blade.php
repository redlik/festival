<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Organiser Dashboard
        </h2>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 py-6 bg-white z-10">
        <div class="max-w-7xl mx-auto">

            <div>
                <div class="sm:hidden">
                    <label for="tabs" class="sr-only">Select a tab</label>
                    <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
                    <select id="tabs" name="tabs" class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">

                        <option>My events</option>

                        <option>Venues</option>

                        <option selected="">Attendees</option>

                        <option>Other stuff</option>

                    </select>
                </div>
                <div class="hidden sm:block">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8 ml-8" aria-label="Tabs">

                            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm">
                                <i class="fad fa-calendar-star"></i> <span>My Events</span>
                            </a>

                            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm">
                                <svg class="text-gray-400 group-hover:text-gray-500 -ml-0.5 mr-2 h-5 w-5" x-state-description="undefined: &quot;text-indigo-500&quot;, undefined: &quot;text-gray-400 group-hover:text-gray-500&quot;" x-description="Heroicon name: solid/office-building" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Venues</span>
                            </a>

                            <a href="#" class="border-indigo-500 text-indigo-600 group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm" aria-current="page" x-state-description="undefined: &quot;border-indigo-500 text-indigo-600&quot;, undefined: &quot;border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300&quot;">
                                <svg class="text-indigo-500 -ml-0.5 mr-2 h-5 w-5" x-state-description="undefined: &quot;text-indigo-500&quot;, undefined: &quot;text-gray-400 group-hover:text-gray-500&quot;" x-description="Heroicon name: solid/users" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                </svg>
                                <span>Attendes</span>
                            </a>

                            <a href="#" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 group inline-flex items-center py-4 px-1 border-b-2 font-medium text-sm" x-state-description="undefined: &quot;border-indigo-500 text-indigo-600&quot;, undefined: &quot;border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300&quot;">
                                <svg class="text-gray-400 group-hover:text-gray-500 -ml-0.5 mr-2 h-5 w-5" x-state-description="undefined: &quot;text-indigo-500&quot;, undefined: &quot;text-gray-400 group-hover:text-gray-500&quot;" x-description="Heroicon name: solid/credit-card" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path>
                                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Other stuff</span>
                            </a>

                        </nav>
                    </div>
                </div>
                <div class="p-6 border border-gray-200 rounded-lg mt-6" id="events">
                    <div class="flex justify-between">
                        <h2 class="text-green-600">Events</h2>
                        <a href="{{ route('event.create') }}">
                            <button class="text-olive-400 font-semibold px-2 py-0 bg-gray-100 rounded hover:bg-gray-200">+ Add new event</button>
                        </a>
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
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ $event->name }}</td>
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
                    <h2 class="text-olive-300">Attendees</h2>
                </div>
                <div class="p-6 border border-gray-200 rounded-lg mt-6" id="other">
                    <h2>Other</h2>
                </div>
            </div>

        </div>
    </div>


</x-app-layout>
