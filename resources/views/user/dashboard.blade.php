<x-app-layout>
    <x-slot name="header">
        <div class="relative">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                Organiser Dashboard
            </h2>
            <div class="hidden lg:block absolute right-0 top-0">
                <a href="{{ route('organiser.edit', $organiser) }}">
                    <span class="text-sm text-gray-600 font-semibold hover:text-gray-400"><i class="fa-solid fa-pen-to-square mr-2"></i> Edit profile</span></a>
            </div>
        </div>
    </x-slot>

    <div class="px-4 sm:px-6 lg:px-8 py-6 bg-gray-100 z-10">
        <div class="max-w-7xl mx-auto">

            <div x-data="{ cancelModal : false, eventName : '', eventID : '' }">
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
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 font-bold">
                                    <a href="{{ route('event.preview', $event->slug) }}" class="hover:underline" title="Preview event page" target="_blank">
                                        {{ $event->name }} <i class="fa-solid fa-arrow-up-right-from-square ml-1 text-xs text-gray-400"></i>
                                    </a>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <div>{{ $event->start_date }}</div>
                                    <div>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    @if($event->venue_id == 0)
                                        <div class="text-indigo-600"><i class="fa-solid fa-video mr-2"></i> Online event</div>
                                    @else
                                        <div>
                                            <div>{{ $event->venue->name }}</div>
                                            <div>{{ $event->venue->town }}</div>
                                        </div>
                                    @endif

                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    @if($event->is_private)
                                        <span class="text-olive-400 bg-gray-100 rounded px-3 py-1 font-semibold"><i class="fa-solid fa-lock mr-1"></i> Private event</span>
                                    @else
                                        @if($event->limited == 1)
                                            @if($event->attendees === $event->attendee_count)
                                                <span class="font-semibold bg-red-100 text-red-700 rounded px-3 py-1">
                                                <i class="fa-solid fa-user-lock mr-1 text-red-600"></i> {{ $event->attendee_count ?? '0' }} / {{ $event->attendees }}
                                            </span>
                                            @else
                                            <span class="font-semibold bg-blue-100 text-indigo-700 rounded px-3 py-1">
                                                <i class="fa-solid fa-user-lock mr-1 text-indigo-600"></i> {{ $event->attendee_count ?? '0' }} / {{ $event->attendees }}
                                            </span>
                                            @endif
                                        @else
                                            <span class="text-green-600 bg-green-100 rounded px-3 py-1 font-semibold"><i class="fa-solid fa-people-group mr-1"></i> {{ $event->attendee_count ?? '0' }}</span>
                                        @endif
                                    @endif
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                   @if($event->status == 'cancelled')
                                        <div class="text-purple-700">{{ ucfirst($event->status) }}</div>
                                    @else
                                        <div class="text-gray-500"
                                        @if($event->status == 'pending')
                                             class="cursor-help" title="The event is awaiting approval"
                                        @endif
                                        >{{ ucfirst($event->status) }}</div>
                                   @endif
                                </td>
                                <td>
                                @if($event->status != 'cancelled')
                                    <a href="{{ route('event.edit', $event) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    @if($event->attendee_count > 0)
                                        <div class="text-gray-500 inline-block cursor-not-allowed" title="Event has attendees, cannot be deleted">Delete</div>
                                    @else
                                        <form method="POST" action="{{ route('event.destroy', $event) }}" class="inline-block"
                                              onsubmit="return confirm('Do you wish to delete the event completely?');">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="text-red-600 hover:text-red-900 hover:underline">Delete</button>
                                        </form>
                                    @endif
                                    @if($event->status == 'published')
                                        <a @click="cancelModal = true, eventName = '{{ $event->name }}', eventID = {{ $event->id }}" class="text-purple-600 cursor-pointer ml-2">Cancel</a>
                                        @endif
                                @else
                                    <div class="text-gray-600 text-sm">Event has been cancelled</div>
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
                <template @cancelModal.window="cancelModal = true" x-if="cancelModal">
                    <div @keydown.window.escape="cancelModal = false" x-show="cancelModal" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" x-ref="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                            <div x-show="cancelModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-description="Background overlay, show/hide based on modal state." class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="cancelModal = false" aria-hidden="true">
                            </div>

                            <!-- This element is to trick the browser into centering the modal contents. -->
                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                            <div x-show="cancelModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-description="Modal panel, show/hide based on modal state." class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <div class="sm:flex sm:items-start">
                                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-purple-100 sm:mx-0 sm:h-10 sm:w-10">
                                            <svg class="h-6 w-6 text-purple-600" x-description="Heroicon name: outline/exclamation" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                            </svg>
                                        </div>
                                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                                Cancel <strong x-text="eventName"></strong>
                                            </h3>
                                            <div class="mt-2">
                                                <p class="text-sm text-gray-500">
                                                    If you need to cancel an event, please make sure to inform festival organisers and all attendees that registered so far.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                                    <a x-bind:href="'/event-cancel/' + eventID">
                                        <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-3 sm:w-auto sm:text-sm" @click="cancelModal = false">
                                            Cancel the event
                                        </button>
                                    </a>
                                    <button type="submit" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="cancelModal = false">
                                        Dismiss
                                    </button>

                                </div>
                            </div>

                        </div>
                    </div>
                </template>
                </div>
                <div class="p-6 border border-gray-200 rounded-lg mt-6 bg-white shadow-inner shadow-lg" id="attendees">
                    @livewire('attendee-list')
                </div>
            </div>

        </div>
    </div>


</x-app-layout>
