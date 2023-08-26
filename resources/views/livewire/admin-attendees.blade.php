<div>
    <div class="flex items-center gap-16 mb-4 bg-gray-100 px-4 py-2 rounded">
        <div class="w-full lg:w-1/4 flex-shrink-0">
            <input type="search" wire:model.debounce.500ms="search" name="search"
                   class="focus:ring-olive-500 text-gray-600 border-gray-300 w-full rounded block px-2 py-1" placeholder="Search by attendee name">
            @if($search !='')
                <button wire:click="clear" class="text-xs font-semibold text-red-600 hover:underline mt-2 ml-2">Clear</button>
            @endif
        </div>
        <div class="w-full lg:w-1/4 flex-shrink-0">
            <label for="events" class="mr-2 text-sm text-gray-600">Filter by event</label>
            <select name="events" wire:model="event"
            class="focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                <option value="">All events</option>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
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
                <td><h4>No attendees registered yet</h4></td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
