<div class="lg:flex mt-6 lg:mt-0" id="event-list" x-data="{ filterShow : true }">
    <div class="bg-gray-200 mr-4 p-2 rounded-t w-full lg:w-auto mb-6">
        <div class="lg:hidden flex justify-between content-center">
            <div><h5>Filter events</h5></div>
            <div>
                <button @click="filterShow = ! filterShow" class="w-16 text-center">
                    <span :class="filterShow ? '' : 'hidden'"><i class="fas fa-caret-down w-16 text-xl"></i></span>
                    <span :class="filterShow ? 'hidden' : ''"><i class="fas fa-caret-up w-16 text-xl"></i></span>
                </button>
            </div>
        </div>
        <div x-cloak :class="filterShow ? 'hidden lg:block' : 'block'">
            <h5 class="hidden lg:block">Filter by</h5>
            <div class="my-6">
                <label for="selected_day" class="mb-2">Day of the events</label>
                <select name="selected_day" id="selected_day" class="focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md" wire:model="selected_day">
                    <option value="" selected>All dates</option>
                    @foreach($days as $day)
                        <option value="{{ $day->start_date }}">{{ \Carbon\Carbon::parse($day->start_date)->format('jS M') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-6">
                <label for="town" class="mb-2">Town events take place</label>
                <select name="town" id="town" class="focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md" wire:model="selected_town">
                    <option value="" selected>All towns</option>
                    @foreach($unique_towns as $town)
                        <option value="{{ $town->town }}">{{ $town->town }}</option>
                    @endforeach
                </select>
            </div>
            <div class="my-6">
                <label for="type" class="mb-2">Event type</label>
                <select name="type" id="type" class="focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md" wire:model="type">
                    <option value="" selected>All events</option>
                    <option value="inperson">In person</option>
                    <option value="online">Online</option>
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
            </div>
        </div>
    </div>
    <div class="w-full">
        @foreach($days as $single_day)
            <div class="text-center text-xl mb-8">
                @if($events->contains('start_date', $single_day->start_date))
                    <h4 class="text-gray-600 mb-4 py-4 border-t border-b border-gray-300">{{ \Carbon\Carbon::parse($single_day->start_date)->format('jS F Y') }}</h4>
                @endif
            <ul role="list" class="grid gap-x-4 gap-y-8 sm:grid-cols-1 lg:grid-cols-3">
                @forelse($events as $event)
                    @if($event->start_date == $single_day->start_date)
                        <li class="relative col-span-1">
                            <div class="group block w-full h-[225px] rounded-lg bg-white focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-offset-gray-100 focus-within:ring-indigo-500 overflow-hidden">
                                <a href="{{ route('event.show-by-slug', $event->slug) }}">
                                    <img src="{{ $event->getFirstMediaUrl('cover') }}" alt="{{ $event->name }} event at Kerry Mental Health & Wellbeing Fest 2022" class="object-scale-down object-center pointer-events-none bg-white w-full h-full group-hover:opacity-75">
                                </a>
                            </div>
                            <div class="flex items-center py-2">
                                <div class="mr-6">
                                    <div class="font-light text-center">{{ \Carbon\Carbon::parse($event->start_date)->format('M') }}</div>
                                    <div class="text-2xl text-black font-bold text-center">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</div>
                                </div>
                                <div class="grow-0">
                                    <div>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} @if($event->end_time)
                                            - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                                        @endif</div>
                                    <div>
                                        <a href="{{ route('event.show-by-slug', $event->slug) }}" title="{{ $event->name }}">
                                            <div class="text-lg block text-sm font-bold text-gray-900 truncate-elipsis pointer-events-none">
                                                <div class="hidden lg:block" >
                                                    {{ Str::of($event->name)->limit(25, '...') }}
                                                </div>
                                                <div class="lg:hidden">
                                                    {{ $event->name }}
                                                </div>
                                            </div>
                                            @if($event->type === 'online')
                                                <p class="block text-sm font-medium text-indigo-500 pointer-events-none">
                                                    <i class="fa-solid fa-video mr-1"></i> Online event</p>
                                            @else
                                                <p class="block text-sm font-medium text-gray-500 pointer-events-none">{{ $event->venue->name }}, {{ $event->venue->town }}</p>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @empty
                    <div>
                        <h4>No events found for this criteria</h4>
                    </div>
                @endforelse
            </ul>
            </div>
        @endforeach
    </div>
</div>
