<div>
    <div class="sm:flex sm:items-center ml-4 gap-16 mb-6">
        <div class="flex items-center w-auto mr-8">
            <div>
                <input type="search" wire:model.debounce.500ms="search" name="search"
                       class="focus:ring-olive-500 text-gray-600 border-gray-300 rounded w-64 block px-2 py-1" placeholder="Search by event name">
                @if($search !='')
                    <button wire:click="clear" class="text-xs font-semibold text-red-600 hover:underline mt-2 ml-2">Clear</button>
                @endif
            </div>

        </div>
        <div class="flex items-center w-auto mr-8">
            <select name="year" id="year" wire:model="date"
                    class="focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                <option value="" selected>All events</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
            </select>
            <label for="year" class="text-gray-700 text-sm ml-4 block w-full">Event's Year</label>
        </div>
        <div class="flex items-center w-auto mr-8">
            <select name="year" id="year" wire:model="status"
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
    </div>
    <table class="min-w-full divide-y divide-gray-300">
        <thead class="bg-gray-100">
        <tr>
            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Name</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Date & Time</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Organiser</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Venue</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Attendees</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">Operations
                <span class="sr-only">Operations</span>
            </th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 bg-white">
        @forelse($events as $event)
            <tr>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">
                    <a href="{{ route('admin.event.show', $event) }}" class="hover:underline" title="{{ $event->name }}">
                        {{ Str::of($event->name)->limit(40, ' (...)') }}
                    </a>
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <div>{{ $event->start_date }}</div>
                    <div>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') ?? "Not set" }}</div>
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    <div>
                        <a href="{{ route('organiser.show', $event->user->organiser->id ) }}" class="font-semibold hover:text-indigo-500 hover:underline">
                            {{ $event->user->organiser->name }}
                        </a>
                    </div>
                    <div>
                        {{ $event->user->organiser->org }}
                    </div>
                </td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    @if($event->type != "online")
                        <div>{{ $event->venue->name }}</div>
                        <div>{{ $event->venue->town }}</div>
                    @else
                        <div>Online Event</div>
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
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    @if($event->status == 'draft')
                        <span class="text-amber-600 font-semibold">{{ ucfirst($event->status) }}</span>
                    @endif
                    @if($event->status == 'published')
                        <span class="text-green-600 font-semibold">{{ ucfirst($event->status) }}</span>
                    @endif
                    @if($event->status == 'cancelled')
                        <span class="text-purple-600 font-semibold">{{ ucfirst($event->status) }}</span>
                    @endif
                    @if($event->status == 'pending')
                        <span class="text-sky-500 font-semibold">{{ ucfirst($event->status) }}</span>
                    @endif
                </td>
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-semibold sm:pr-6 lg:pr-8">
                    <a href="{{ route('admin.event.show', $event) }}" class="text-indigo-600 hover:text-indigo-900 mr-2" title="Event details"><i class="fa-solid fa-eye"></i></a>
                    <a href="{{ route('event.edit', $event) }}" class="text-green-600 hover:text-green-400 mr-2"><i class="fa-solid fa-pen-to-square"></i></a>
                    @if($event->attendee_count > 0 && $event->status != 'cancelled')
                        <div class="text-gray-500 inline-block cursor-not-allowed" title="Event has attendees, cannot be deleted"><i class="fa-solid fa-trash-can"></i></div>
                    @else
                        @if($event->status == 'cancelled')
                            <form method="POST" action="{{ route('event.destroy', $event) }}" class="inline-block"
                                  onsubmit="return confirm('By removing cancelled event you will also remove any registered attendees.');">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="text-red-600 hover:text-red-900 hover:underline"><i class="fa-solid fa-trash-can" title="Delete event"></i></button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('event.destroy', $event) }}" class="inline-block"
                                  onsubmit="return confirm('Do you wish to delete the event completely?');">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="text-red-600 hover:text-red-900 hover:underline"><i class="fa-solid fa-trash-can" title="Delete event"></i></button>
                            </form>
                        @endif

                    @endif
                </td>
            </tr>
        @empty
            <tr colspan="4">
                <td class="p-8"><h4>No events created</h4></td>
            </tr>
        @endforelse

        </tbody>
    </table>
</div>
