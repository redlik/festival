<div>
    <h2 class="text-olive-300 mb-6 uppercase">Attendees</h2>
    <div class="flex mb-4 items-center">
        <div class="mr-6">
            <label for="event_attendee text-sm text-gray-600 mr-2">View by event: </label>
            <select name="event_attendee" id="event_attendee" class="focus:ring-indigo-500 focus:border-indigo-500 w-48 shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md" wire:model="selected_event">
                <option value="" selected>All events</option>
            @foreach($events_with_attendees as $event_with_attendees)
                    <option value="{{ $event_with_attendees->id }}">{{ $event_with_attendees->name }}</option>
            @endforeach
            </select>
        </div>
        <div>
            <button type="button" class="bg-yellow-300 text-olive-600 rounded px-2 py-1 hover:bg-yellow-600 hover:text-white">
                <i class="fas fa-file-excel mr-2"></i> Export list</button>
        </div>
    </div>
    <table class="min-w-full divide-y divide-gray-300">
        <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Name</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Event</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Registered on</th>
            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 lg:pr-8">Edit
                <span class="sr-only">Edit</span>
            </th>
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
                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-center text-sm font-semibold sm:pr-6 lg:pr-8">
                    <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                </td>
            </tr>
        @empty
            <tr colspan="4">
                <td><h4>No attendees registered yet</h4></td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
