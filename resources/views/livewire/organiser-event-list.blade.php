<div class="">
    <div x-data="{ cancelModal : false, eventName : '', eventID : '', emailModal : false }">
        <div class="p-6 border border-gray-200 rounded-lg mt-6 bg-white shadow-inner shadow-lg" id="events">
            <div class="mb-4">
                <h2 class="text-olive-400 uppercase">Events</h2>
            </div>
            <div class="sm:flex sm:items-center ml-4 justify-between mb-6">
                <div class="flex items-center w-auto mr-8">
                    <div>
                        <input type="search" wire:model.live.debounce.500ms="search" name="search"
                               class="focus:ring-olive-500 text-gray-600 border-gray-300 rounded w-64 block px-2 py-1"
                               placeholder="Search by event name">
                        @if($search !='')
                            <button wire:click="clear"
                                    class="text-xs font-semibold text-red-600 hover:underline mt-2 ml-2">Clear
                            </button>
                        @endif
                    </div>

                </div>
                <div class="flex items-center w-auto mr-8">
                    <select name="year" id="year" wire:model.live="date"
                            class="focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        <option value="" selected>All events</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                    </select>
                    <label for="year" class="text-gray-700 text-sm ml-4 block w-full">Event's Year</label>
                </div>
                <div class="flex items-center w-auto mr-8">
                    <select name="year" id="year" wire:model.live="status"
                            class="focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        <option value="" selected>All events</option>
                        <option value="published">Published</option>
                        <option value="pending">Pending</option>
                        <option value="draft">Draft</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="archived">Archived</option>
                    </select>
                    <label for="year" class="text-gray-700 text-sm ml-4 block w-full">Status</label>
                </div>
                <div>
                    <a href="{{ route('event.create') }}">
                        <button class="button-primary">+ Add new event</button>
                    </a>
                </div>
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
                <div
                    class="bg-red-100 border border-red-700 shadow rounded p-2 my-4 text-red-600">{{ Session::get('deleted') }}</div>
            @endif
            @if (Session::has('cancelled'))
                <div
                    class="bg-red-100 border border-red-700 shadow rounded p-2 my-4 text-red-600">{{ Session::get('cancelled') }}</div>
            @endif
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-100">
                    <tr>
                        <th scope="col"
                            class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">#
                        </th>
                        <th scope="col" class="py-3.5 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">
                            Name
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date & Time
                        </th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Venue</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Attendees</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                        <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Message</th>
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
                                <a href="{{ route('event.preview', $event->slug) }}" class="hover:underline"
                                   title="Preview event page" target="_blank">
                                    {{ Str::of($event->name)->limit(25, ' (...)') }}
                                    <i class="fa-solid fa-arrow-up-right-from-square ml-1 text-xs text-gray-400"></i>
                                </a>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                <div>{{ $event->start_date }}</div>
                                <div>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}
                                    - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}</div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                @if($event->venue_id == 0)
                                    <div class="text-indigo-600"><i class="fa-solid fa-video mr-2"></i> Online event
                                    </div>
                                @else
                                    <div>
                                        <div>{{ $event->venue->name }}</div>
                                        <div>{{ $event->venue->town }}</div>
                                    </div>
                                @endif

                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                @if($event->is_private)
                                    <span class="text-olive-400 bg-gray-100 rounded px-3 py-1 font-semibold"><i
                                            class="fa-solid fa-lock mr-1"></i> Private event</span>
                                @else
                                    @if($event->limited == 1)
                                        @if($event->attendees <= $event->attendee_count)
                                            <span class="font-semibold bg-red-100 text-red-700 rounded px-3 py-1">
                                                            <i class="fa-solid fa-user-lock mr-1 text-red-600"></i> {{ $event->attendee_count ?? '0' }} / {{ $event->attendees }}
                                                            </span>
                                        @else
                                            <span class="font-semibold bg-blue-100 text-indigo-700 rounded px-3 py-1">
                                                            <i class="fa-solid fa-user-lock mr-1 text-indigo-600"></i> {{ $event->attendee_count ?? '0' }} / {{ $event->attendees }}
                                                        </span>
                                        @endif
                                        @if($event->waiting_count > 0)
                                            <span
                                                class="font-semibold bg-amber-200 text-amber-700 rounded px-3 py-1 ml-3"
                                                title="Waiting list count">
                                                            <i class="fa-solid fa-user-clock mr-1 text-amber-600"></i> {{ $event->waiting_count ?? '0' }}
                                                            </span>
                                        @endif
                                    @else
                                        <span class="text-green-600 bg-green-100 rounded px-3 py-1 font-semibold"><i
                                                class="fa-solid fa-people-group mr-1"></i> {{ $event->attendee_count ?? '0' }}</span>
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
                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                @if($event->attendee_count > 0)
                                    <a @click="emailModal = true, eventName = '{{ $event->name }}', eventID = {{ $event->id }}"
                                       class="hover:text-olive-400 cursor-pointer hover:bg-gray-100"
                                       title="Send email to all attendees">
                                        <i class="fa-regular fa-envelope text-olive-500 bg-gray-50 hover:text-olive-400 hover:bg-gray-200 p-2 rounded"></i>
                                    </a>
                                @endif

                            </td>
                            <td>
                                @if($event->status != 'cancelled')
                                    <a href="{{ route('event.edit', $event) }}"
                                       class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    @if($event->attendee_count > 0)
                                        <div class="text-gray-500 inline-block cursor-not-allowed"
                                             title="Event has attendees, cannot be deleted">Delete
                                        </div>
                                    @else
                                        <form method="POST" action="{{ route('event.destroy', $event) }}"
                                              class="inline-block"
                                              onsubmit="return confirm('Do you wish to delete the event completely?');">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 hover:underline">Delete
                                            </button>
                                        </form>
                                    @endif
                                    @if($event->status == 'published')
                                        <a @click="cancelModal = true, eventName = '{{ $event->name }}', eventID = {{ $event->id }}"
                                           class="text-purple-600 cursor-pointer ml-2">Cancel</a>
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
            </div>
            <template @cancelModal.window="cancelModal = true" x-if="cancelModal">
                <div @keydown.window.escape="cancelModal = false" x-show="cancelModal"
                     class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" x-ref="dialog"
                     aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                        <div x-show="cancelModal" x-transition:enter="ease-out duration-300"
                             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             x-description="Background overlay, show/hide based on modal state."
                             class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                             @click="cancelModal = false" aria-hidden="true">
                        </div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                        <div x-show="cancelModal" x-transition:enter="ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave="ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             x-description="Modal panel, show/hide based on modal state."
                             class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div
                                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                        <svg class="h-6 w-6 text-red-600"
                                             x-description="Heroicon name: outline/exclamation"
                                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                            Cancel <strong x-text="eventName"></strong> ?
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">
                                                Once confirming the cancellation of the event, we will notify all
                                                registered attendees via the email. Please make sure you didn't click
                                                this by mistake.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                                <a x-bind:href="'/event-cancel/' + eventID">
                                    <button type="button"
                                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                                            @click="cancelModal = false">
                                        Cancel the event
                                    </button>
                                </a>
                                <button type="submit"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                        @click="cancelModal = false">
                                    Dismiss
                                </button>

                            </div>
                        </div>

                    </div>
                </div>
            </template>
            <template @emailModal.window="emailModal = true" x-if="emailModal">
                <div @keydown.window.escape="emailModal = false" x-show="emailModal"
                     class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" x-ref="dialog"
                     aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                        <div x-show="emailModal" x-transition:enter="ease-out duration-300"
                             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             x-description="Background overlay, show/hide based on modal state."
                             class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                             @click="emailModal = false" aria-hidden="true">
                        </div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                        <div x-show="emailModal" x-transition:enter="ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave="ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                             x-description="Modal panel, show/hide based on modal state."
                             class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all
                             sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="mt-3 text-center sm:mt-0 sm:mx-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                        Message all attendees of <strong x-text="eventName"></strong>
                                    </h3>
                                    <div class="mt-2">
                                        <form action="{{ route('message.attendees') }}" method="POST" id="messageForm"
                                              class="mt-4">
                                            @csrf
                                            <input type="hidden" name="event" x-model="eventID">
                                            <input type="hidden" name="eventName" x-model="eventName">
                                            <div class="w-full mb-4">
                                                <label for="subject"
                                                       class="block text-sm font-semibold leading-6 text-gray-900">Subject
                                                    <span class="text-red-600">*</span></label>
                                                <div
                                                    class="w-full block rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2
                                                    focus-within:ring-inset focus-within:ring-indigo-600 mt-1">
                                                    <input type="text" name="subject" id="subject"
                                                           class="block w-full border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6"
                                                           required>
                                                </div>
                                            </div>

                                            <div class="w-full">
                                                <label for="message"
                                                       class="block text-sm font-semibold leading-6 text-gray-900">
                                                    Message <span class="text-red-600">*</span></label>
                                                <div class="mt-2">
                                                        <textarea id="message" name="message" rows="6"
                                                                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                                </div>
                                                <p class="mt-3 text-sm leading-6 text-gray-600">
                                                    Use this feature of the platform to only send messages related to
                                                    the particular event. Do not message attendees any advertising,
                                                    fundraising request or paid services you offer.<br>
                                                    Thank you!</p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div>

                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                                <button type="submit" form="messageForm"
                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2
                                        bg-olive-600 text-base font-bold text-white hover:bg-olive-700 focus:outline-none focus:ring-2
                                        focus:ring-offset-2 focus:ring-olive-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Send Message
                                </button>
                                <button type="button"
                                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-bold text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                        @click="emailModal = false">
                                    Dismiss
                                </button>

                            </div>
                        </div>

                    </div>
                </div>
            </template>
        </div>
    </div>

</div>
