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
                    @if (\Session::has('event_saved'))
                        <div class="bg-gray-100 border border-gray-400 shadow rounded p-2 my-4">
                            Event has been saved. Once you have all the information in place don't forget to submit it.
                        </div>
                    @endif
                    @if (Session::has('deleted'))
                        <div class="bg-red-100 border border-red-700 shadow rounded p-2 my-4 text-red-600">{{ Session::get('deleted') }}</div>
                    @endif
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">#</th>
                            <th scope="col" class="py-3.5 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Name</th>
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
                                    {{ $loop->iteration }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">
                                    <a href="{{ route('event.show', $event) }}" class="hover:underline">
                                        {{ $event->name }}

                                    </a>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div>{{ $event->start_date }}</div>
                                    <div>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}</div>
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
                                    <a href="{{ route('event.edit', $event) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    @if($event->attendee_count > 0)
                                        <div class="text-gray-500 inline-block" title="Event has attendees, cannot be deleted">Delete</div>
                                    @else
                                        <form method="POST" action="{{ route('event.destroy', $event) }}" class="inline-block">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="text-red-600 hover:text-red-900 hover:underline">Delete</button>
                                        </form>
                                    @endif

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
