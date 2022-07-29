<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Create new event') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth" x-data="{ limit: '0', type: '' }">
            <div>
                <h3 class="leading-6 text-2xl mb-2">
                    Event registration form
                </h3>
            </div>
            <form class="space-y-8 divide-y divide-gray-200" method="POST" action="{{ route('event.store') }}" id="event-registration" enctype="multipart/form-data">
                <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                    @if ($errors->any())
                        <div class="bg-red-200 rounded border border-red-400 pl-2">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div>
                        @csrf
                        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 font-bold">
                                    Event Name (title)
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="name" id="name" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" required value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="start_date" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    <div class="font-bold">Event date, start and end time
                                        <span class="text-red-700">*</span></div>
                                    <div class="text-xs font-normal">If your event doesn't have the end time set, leave the field blank</div>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input id="start_date" name="start_date" type="date" class="lg:w-48 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" min="2022-10-06" max="2022-10-17" required
                                           value="{{ old('start_date') }}">
                                    <input id="start_time" name="start_time" type="time" class="lg:ml-4 lg:w-48 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" required value="{{ old('start_time') }}">
                                    <input id="end_time" name="end_time" type="time" class="lg:ml-4 lg:w-48 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ old('end_time') }}">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="type" class="block text-sm font-medium sm:mt-px sm:pt-2 font-bold">
                                    Environment <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <select id="type" name="type" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md" required x-model="type">
                                        <option value="" disabled selected>Select from the list</option>
                                        <option value="indoor" @selected(old('type') === 'indoor') >Indoor</option>
                                        <option value="outdoor" @selected(old('type') === 'outdoor')>Outdoor</option>
                                        <option value="online" @selected(old('type') === 'online')>Online</option>
                                    </select>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5
                                        @if ($errors->has('venue')) bg-red-100 @endif">
                                <label for="venue" class="block text-sm font-medium sm:mt-px sm:pt-2 font-bold">
                                    Venue <span class="text-red-700">*</span>
                                </label>
                                @livewire('venue-entry')
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="description" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 font-bold">
                                    Event(s) details <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <textarea id="description" name="description" rows="3" class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md" required>{{ old('description') }}</textarea>
                                    <p class="mt-2 text-sm text-gray-700 font-semibold">This will be used to describe the events to the public in promotional material - please provide two to three sentences.</p>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="cover-photo" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    <div class="font-bold">Cover photo <span class="text-red-700">*</span></div>
                                    <div class="text-xs text-gray-500">Please add your logo if you do not have an image available</div>
                                    <div class="text-xs text-gray-500 mb-4 md:mb-0">If you are uploading images with recognisable people, by clicking submit you are indicting you have their permission to use.</div>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <div class="max-w-lg flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <div>Upload a cover photo</div>
                                                    <input id="file-upload" name="file-upload" type="file" required>
                                                </label>
                                            </div>
                                            <p class="text-xs text-gray-500">
                                                PNG, JPG, GIF up to 10MB
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="target" class="block text-sm font-medium sm:mt-px sm:pt-2 mb-4 md:mb-0 font-bold">
                                    Target group
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2 md:flex text-sm">
                                    <div class="flex items-center h-5 mr-8 mb-4 md:mb-0">
                                        <input id="everyone" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="everyone"
                                        @checked(is_array(old('target')) && in_array('everyone', old('target')))
                                        <label for="teens" class="font-medium text-gray-700">Everyone</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8 mb-4 md:mb-0">
                                        <input id="children" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="children"
                                        @checked(is_array(old('target')) && in_array('children', old('target')))
                                        <label for="children" class="font-medium text-gray-700">Children</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8 mb-4 md:mb-0">
                                        <input id="teens" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="teens"
                                        @checked(is_array(old('target')) && in_array('teens', old('target')))
                                        <label for="teens" class="font-medium text-gray-700">Teens</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8 mb-4 md:mb-0">
                                        <input id="young" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="young-adults" @checked(is_array(old('target')) && in_array('young-adults', old('target')))>
                                        <label for="young" class="font-medium text-gray-700">Young adults</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8 mb-4 md:mb-0">
                                        <input id="older" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="older-adults" @checked(is_array(old('target')) && in_array('older-adults', old('target')))>
                                        <label for="older" class="font-medium text-gray-700">Older adults</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8 mb-4 md:mb-0">
                                        <input id="family" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="family" @checked(is_array(old('target')) && in_array('family', old('target')))>
                                        <label for="family" class="font-medium text-gray-700">Family</label>
                                    </div>
                                    <div class="flex items-center h-5">
                                        <input id="workplace" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="workplace" @checked(is_array(old('target')) && in_array('workplace', old('target')))>
                                        <label for="workplace" class="font-medium text-gray-700">Workplace</label>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start content-center sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="is_private" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    <div class="font-bold">Private event</div>
                                    <div class="text-sm text-gray-600">Events marked as private will be listed on the site but won't have the attendee registration form available. The 2 boxes below won't have any functionality enabled also.</div>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2 flex items-center h-full">
                                    <div class="flex items-center h-5 mr-8 mb-4 md:mb-0">
                                        <input id="is_private" aria-describedby="comments-description" name="is_private" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="1" @checked(old('is_private'))>
                                        <label for="is_private" class="font-medium text-gray-700">Private event</label>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="target" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    <div class="font-bold">Limited spaces</div>
                                    <div class="text-sm text-gray-600">If this event has limited number of spaces, select YES and enter the limit in the box below</div>

                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2 flex">
                                    <div class="flex items-center h-5 mr-8">
                                        <input x-model="limit" id="yes" name="limited" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="1" @checked(old('limited', 1))>
                                        <label for="yes" class="font-medium text-gray-700">Yes</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input x-model="limit" id="no" name="limited" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="0" checked @checked(old('limited', 0))>
                                        <label for="no" class="font-medium text-gray-700">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="attendees" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    <div class="font-bold">Number of attendees</div>
                                    <div class="text-sm text-gray-500">If you selected YES above please enter the maximum number of attendees this event can accept.</div>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="number" name="attendees" id="attendees"
                                           x-bind:disabled="(limit == '1') ? false : true" x-bind:required="(limit == '1') ? true : false"
                                           class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" min="0" value="{{ old('attendees') ?? 0 }}" placeholder="0">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="target" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    <div class="font-bold">COVID-19 Restrictions</div>
                                    <div class="text-sm text-gray-600">Should Covid 19 restrictions change and you are currently planning an in-door event, is it possible for your event to be moved online or outdoors?</div>

                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2 flex">
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="yes" name="covid" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="yes" @checked( old('covid', 'yes') )>
                                        <label for="yes" class="font-medium text-gray-700">Yes</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="no" name="covid" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="no" checked @checked( old('covid', 'no') )>
                                        <label for="no" class="font-medium text-gray-700">No</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="na" name="covid" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="na" @checked( old('covid', 'na') )>
                                        <label for="na" class="font-medium text-gray-700">Doesn't apply</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Event facilitator
                            </h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-700">
                                Please enter details of the event facilitator if the details are different to the event organiser's
                            </p>
                        </div>
                        <div class="space-y-6 sm:space-y-5">

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="leader_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 font-bold">
                                    Facilitator's name
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="leader_name" id="leader_name" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ old('leader_name') }}">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="leader_phone" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 font-bold">
                                    Phone
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="leader_phone" id="leader_phone" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ old('leader_phone') }}">
                                </div>
                            </div>

                            <div class=" sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="leader_email" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2 font-bold">
                                    Email
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="leader_email" id="leader_email" class="block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" value="{{ old('leader_email') }}">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class=" pt-5">
                        <div class="flex justify-start">
                            <button type="submit" class="button-primary" name="submit">
                                Submit event
                            </button>
                            <button formaction="{{ route('event.save-draft') }}" class="button-secondary ml-8" name="save">
                                Save draft
                            </button>
                        </div>
                    </div>
            </form>

        </div>
        <div class="mt-4 rounded bg-yellow-100 p-2">
            <p>Each event requires individual submission. If you are organising multiple events, please use this form for each one separately.</p>
        </div>
    </div>
    @push("footer_styles")
        <script type="text/javascript">
            document.addEventListener('keypress', function (e) {
                if (e.keyCode === 13 || e.which === 13) {
                    e.preventDefault();
                    return false;
                }
            });
        </script>
    @endpush
</x-app-layout>
