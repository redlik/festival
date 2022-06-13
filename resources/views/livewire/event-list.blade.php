<div class="flex" id="event-list">
    <div class="bg-gray-200 w-64 min-w-48 w-48 mr-4 p-2">
        <h5 class="mb-4">Filter by</h5>
        <div class="mb-6">
            <label for="town" class="mb-2">Town events take place</label>
            <select name="town" id="town" class="focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md" wire:model="selected_town">
                <option value="" selected>All towns</option>
                @foreach($towns as $town)
                    <option value="{{ $town->id }}">{{ $town->town }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <div class="mb-2 font-semibold">Target group</div>
            @foreach($target as $key => $value)
                <div class="flex items-center h-5 mb-2">
                    <input id="{{ $key }}" name="{{ $key }}" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="{{ $key }}" wire:model="group">
                    <label for="{{ $key }}" class="font-medium text-gray-700">{{ $value }}</label>
                </div>
            @endforeach
            @json($group)
        </div>
    </div>
    <div>
        <ul role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 lg:grid-cols-3 ">
            @forelse($events as $event)
                <li class="relative">
                    <div class="group block w-full h-max-32 rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-indigo-500 overflow-hidden">
                        <a href="{{ route('event.show', $event) }}">
                            <img src="https://source.unsplash.com/400x300/?nature" alt="" class="object-cover pointer-events-none group-hover:opacity-75">
                            <button type="button" class="absolute inset-0 focus:outline-none">
                                <span class="sr-only">View details for IMG_4985.HEIC</span>
                            </button>
                        </a>
                    </div>
                    <div class="flex items-center py-2">
                        <div class="mr-6">
                            <div class="font-light text-center">{{ \Carbon\Carbon::parse($event->start_date)->format('M') }}</div>
                            <div class="text-2xl text-black font-bold text-center">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</div>
                        </div>
                        <div>
                            <div>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}</div>
                            <a href="{{ route('event.show', $event) }}">
                                <p class="text-lg block text-sm font-bold text-gray-900 truncate pointer-events-none">{{ $event->name }}</p>
                                <p class="block text-sm font-medium text-gray-500 pointer-events-none">{{ $event->venue->town }}</p>
                            </a>
                        </div>
                    </div>
                </li>
            @empty
                <div>
                    <h4>No events found for this criteria</h4>
                </div>
            @endforelse
        </ul>
    </div>
</div>
