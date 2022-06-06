<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Create new event') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth" x-data="{ limit: '0' }">
            <div>
                <h4>Intro text?</h4>
            </div>
            <div>
                <h3 class="leading-6 text-2xl mb-2">
                    Event registration form
                </h3>
            </div>
            <form class="space-y-8 divide-y divide-gray-200" method="POST" action="{{ route('event.store') }}" id="event-registration">
                <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                    <div>
                        @csrf
                        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Event Name (title)
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="name" id="name" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="start_date" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Event date, start and end time <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input id="start_date" name="start_date" type="date" class="lg:w-48 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" min="<?php echo date("Y-m-d"); ?>">
                                    <input id="start_time" name="start_time" type="time" class="lg:ml-4 lg:w-48 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                    <input id="end_time" name="end_time" type="time" class="lg:ml-4 lg:w-48 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="venue" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Venue <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <select id="venue" name="venue" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                        <option value="" disabled selected>Select venue from the list</option>
                                        @foreach($venues as $venue)
                                            <option value="{{ $venue->id }}">{{ $venue->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="description" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Event(s) details
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <textarea id="description" name="description" rows="3" class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md" required></textarea>
                                    <p class="mt-2 text-sm text-gray-700 font-semibold">This will be used to describe the events to the public in promotional material - please provide two to three sentences.</p>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="category" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Category? <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <select id="category" name="category" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                        <option value="" disabled selected>Select the category</option>
                                        <option value="indoor">Music</option>
                                        <option value="outdoor">Yoga</option>
                                        <option value="online">Wellbeing</option>
                                    </select>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="type" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Type <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <select id="type" name="type" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                        <option value="" disabled selected>Select the category</option>
                                        <option value="indoor">Indoor</option>
                                        <option value="outdoor">Outdoor</option>
                                        <option value="online">Online</option>
                                    </select>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="target" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Target group <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2 flex">
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="teens" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="teens">
                                        <label for="teens" class="font-medium text-gray-700">Teens</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="young" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="young-adults">
                                        <label for="young" class="font-medium text-gray-700">Young adults</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="older" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="older-adults">
                                        <label for="older" class="font-medium text-gray-700">Older adults</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="family" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="family">
                                        <label for="family" class="font-medium text-gray-700">Family</label>
                                    </div>
                                    <div class="flex items-center h-5">
                                        <input id="workplace" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="workplace">
                                        <label for="workplace" class="font-medium text-gray-700">Workplace</label>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="target" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    <div>Limited entry</div>
                                    <div class="text-sm text-gray-600">If this event has limited number of spaces, select YES and enter the limit in the box below</div>

                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2 flex">
                                    <div class="flex items-center h-5 mr-8">
                                        <input x-model="limit" id="yes" name="limited" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="1">
                                        <label for="yes" class="font-medium text-gray-700">Yes</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input x-model="limit" id="no" name="limited" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="0" checked>
                                        <label for="no" class="font-medium text-gray-700">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="attendees" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    <div>Number of attendees</div>
                                    <div class="text-sm text-gray-500">If you selected YES above please enter the maximum number of attendees this event can accept.</div>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="number" name="attendees" id="attendees"
                                           x-bind:disabled="(limit == '1') ? false : true" x-bind:required="(limit == '1') ? true : false"
                                           class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" min="0" value="0" placeholder="0">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="target" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    <div>COVID-19 Restrictions</div>
                                    <div class="text-sm text-gray-600">Should Covid 19 restrictions change and you are currently planning an in-door event, is it possible for your event to be moved online or outdoors?</div>

                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2 flex">
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="yes" name="covid" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="1">
                                        <label for="yes" class="font-medium text-gray-700">Yes</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="no" name="covid" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="0" checked>
                                        <label for="no" class="font-medium text-gray-700">No</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="no" name="covid" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="0" >
                                        <label for="no" class="font-medium text-gray-700">Doesn't apply</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Event leader
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-700">
                                Is this optional ?
                            </p>
                        </div>
                        <div class="space-y-6 sm:space-y-5">

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="address1" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Leader's name
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="address1" id="address1" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="street" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Phone
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="street" id="street" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="town" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Email
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="town" id="town" class="block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="pt-5">
                        <div class="flex justify-start">
                            <button type="submit" class="button-primary">
                                Submit event
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</x-app-layout>
