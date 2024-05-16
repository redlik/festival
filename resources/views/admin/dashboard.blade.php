<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 py-6 bg-gray-100 z-10"
         x-data="{openTab: window.location.hash ? window.location.hash : '#events',
                  activeClasses:
                  'bg-gray-600 text-gray-100 rounded-full shadow-inner shadow outline-none',
                  inactiveClasses:
                  'text-gray-500 bg-gray-100 hover:text-gray-700 hover:bg-gray-200 rounded-full cursor-pointer'
                }">
        <div class="w-full mx-auto">
            <div>
                <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">

                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-semibold truncate">
                            <a href="{{ route('admin.organisers') }}"><span class="text-gray-500 hover:text-indigo-500 hover:underline">Organisers registered</span> </a>
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ $organisers_count }}
                            <span class="text-xl text-gray-500">({{ $new_organisers }})</span>
                        </dd>
                    </div>

                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-semibold text-gray-500 truncate">
                            Events added
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ $events_count }}
                            <span class="text-xl text-gray-500">({{ $new_events_count }})</span>
                        </dd>
                    </div>

                    <div class="px-4 py-5 bg-white shadow rounded-lg overflow-hidden sm:p-6">
                        <dt class="text-sm font-semibold text-gray-500 truncate">
                            <a href="#attendees" class="hover:underline hover:text-indigo-500">Attendees registered</a>
                        </dt>
                        <dd class="mt-1 text-3xl font-semibold text-gray-900">
                            {{ $attendees_count }}
                        </dd>
                    </div>

                </dl>
            </div>
            <!---------- TABS ---------->
            <div class="flex items-center justify-center gap-10 w-full mt-6">
                <a @click="openTab = '#events'" :class="openTab === '#events' ? activeClasses : inactiveClasses" class="
                            inline-block py-2 px-4 font-bold" >Events</a>
                <a @click="openTab = '#venues'" :class="openTab === '#venues' ? activeClasses : inactiveClasses" class="
                            inline-block py-2 px-4 font-bold" >Venues</a>
                <a @click="openTab = '#attendees'" :class="openTab === '#attendees' ? activeClasses : inactiveClasses" class="
                            inline-block py-2 px-4 font-bold" >Attendees</a>
            </div>
            <!---------- END TABS ---------->
            <div>
                <div class="p-6 border border-gray-200 rounded-lg mt-6 p-4 bg-white shadow-lg" id="events" x-show="openTab === '#events'">
                    <div class="flex justify-between mb-4">
                        <h2 class="text-green-600">Events</h2>
                    </div>
                    @if (Session::has('deleted'))
                        <div class="bg-red-100 border border-red-700 shadow rounded p-2 my-4 text-red-600">{{ Session::get('deleted') }}</div>
                    @endif
                    @livewire('admin-events')

                </div>
                <div class="p-6 border border-gray-200 rounded-lg mt-6 p-4 bg-white shadow-lg" id="venues" x-show="openTab === '#venues'">
                    <div class="flex justify-between">
                        <h2 class="text-purple-600 mb-6">Venues</h2>
                    </div>
                    @if(\Session::has('venue_deleted'))
                        <div class="bg-red-100 border border-red-500 text-red-500 p-2 rounded mb-4">
                            {{ \Session::get('venue_deleted') }}
                        </div>
                    @endif
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
                                    <a href="{{ route('venue.edit', $venue) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    @if($venue->event_count == 0)
                                        <form method="POST" action="{{ route('venue.delete', $venue) }}" class="inline-block"
                                              onsubmit="return confirm('Do you wish to delete the venue completely?');">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="text-red-600 font-semibold hover:text-red-900 hover:underline">Delete</button>
                                        </form>
                                    @else
                                        <div class="text-gray-500 inline-block cursor-not-allowed" title="Venue has events assigned, cannot delete">Delete</div>
                                    @endif

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
                <div class="p-6 border border-gray-200 rounded-lg mt-6 p-4 bg-white shadow-lg" id="attendees" x-show="openTab === '#attendees'">
                    <h2 class="text-olive-300 mb-6">Attendees</h2>
                    @livewire('admin-attendees')
                </div>
            </div>

        </div>
    </div>


</x-app-layout>
