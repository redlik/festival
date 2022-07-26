<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Editing {{  $event->name }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth" x-data="{ limit: {{ $event->limited }}, date : true, type: '{{ $event->type }}'}">
            <div>
                @if($event->status == 'published')
                    <div class="border border-gray-200 bg-yellow-50 rounded p-2 mb-4">
                        <strong>PLEASE NOTE:</strong> If this event is already listed on the main page, and you are making significant changes, such as changing the date, time or the location, please make sure to inform the organisers of the Festival and the registered attendees about it.
                    </div>
                @endif
            </div>
            <div class="p-2 rounded bg-gray-100 border border-gray-500 flex justify-between" x-show="date">
                <div><strong>PLEASE NOTE</strong> that edits to events can be made up to the <strong>19th August 2022.</strong></div>
                <div>
                    <button @click="date = ! date">
                        <i class="fas fa-times-circle"></i>
                    </button>
                </div>
            </div>
            <form class="space-y-8 divide-y divide-gray-200" method="POST" action="{{ route('event.update', $event) }}" id="event-registration" enctype="multipart/form-data">
                <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                    @if(\Session::has('saved'))
                        <div class="bg-green-100 border border-green-500 p-2 rounded mt-4">
                            The changes has been saved.
                            <a href="{{ route('dashboard') }}" class="font-bold text-indigo-500 hover:underline"><< Click to return to Dashboard</a>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="bg-red-200 rounded border border-red-400 pl-2">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input type="hidden" name="event_number" value="{{ $event->id }}">
                    <div>
                        @csrf
                        @method('PATCH')
                        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Event Name (title)
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="name" id="name" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" required value="{{ $event->name }}">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="start_date" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Event date, start and end time <span class="text-red-700">*</span>
                                    <div class="text-xs">If your event doesn't have the end time set, leave the field blank</div>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input id="start_date" name="start_date" type="date" class="lg:w-48 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" required value="{{ $event->start_date }}">
                                    <input id="start_time" name="start_time" type="time" class="lg:ml-4 lg:w-48 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" required value="{{ $event->start_time }}">
                                    <input id="end_time" name="end_time" type="time" class="lg:ml-4 lg:w-48 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ $event->end_time }}">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="type" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Environment <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <select id="type" name="type" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md" required x-model="type">
                                        <option value="indoor" @selected($event->type === 'indoor')>Indoor</option>
                                        <option value="outdoor" @selected($event->type === 'outdoor')>Outdoor</option>
                                        <option value="online" @selected($event->type === 'online')>Online</option>
                                    </select>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5
                                        @if ($errors->has('venue')) bg-red-100 @endif">
                                <label for="venue" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Venue <span class="text-red-700">*</span>
                                </label>
                                @livewire('venue-entry', ['edit_venue' => $event->venue_id])
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="description" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Event(s) details <span class="text-red-700">*</span>
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <textarea id="description" name="description" rows="3" class="max-w-lg shadow-sm block w-full focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border border-gray-300 rounded-md" required>{{ $event->description }}</textarea>
                                    <p class="mt-2 text-sm text-gray-700 font-semibold"></p>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="cover-photo" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    <div>Cover photo</div>
                                    <div class="text-xs text-red-500 font-semibold">If you're uploading new image, the old one will be replaced and deleted.</div>
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
                                                    <input id="file-upload" name="file-upload" type="file">
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
                                <label for="target" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    Target group
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2 flex">
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="teens" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="teens"
                                               @if(in_array('teens', json_decode($event->target)))
                                                   checked
                                            @endif
                                        >
                                        <label for="teens" class="font-medium text-gray-700">Teens</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="young" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="young-adults"
                                               @if(in_array('young-adults', json_decode($event->target)))
                                                   checked
                                            @endif
                                        >
                                        <label for="young" class="font-medium text-gray-700">Young adults</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="older" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="older-adults"
                                               @if(in_array('older-adults', json_decode($event->target)))
                                                   checked
                                            @endif
                                        >
                                        <label for="older" class="font-medium text-gray-700">Older adults</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="family" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="family"
                                               @if(in_array('family', json_decode($event->target)))
                                                   checked
                                            @endif>
                                        <label for="family" class="font-medium text-gray-700">Family</label>
                                    </div>
                                    <div class="flex items-center h-5">
                                        <input id="workplace" aria-describedby="comments-description" name="target[]" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="workplace"
                                               @if(in_array('workplace', json_decode($event->target)))
                                                   checked
                                            @endif>
                                        <label for="workplace" class="font-medium text-gray-700">Workplace</label>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start content-center sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="target" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    <div class="font-bold">Private event</div>
                                    <div class="text-sm text-gray-600">Events marked as private will be listed on the site but won't have the attendee registration form available. The 2 boxes below won't have any functionality enabled also.</div>

                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2 flex items-center h-full">
                                    <div class="flex items-center h-5 mr-8 mb-4 md:mb-0">
                                        <input id="is_private" aria-describedby="comments-description" name="is_private" type="checkbox" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="1" {{ $event->is_private == 1 ? 'checked' : '' }}>
                                        <label for="is_private" class="font-medium text-gray-700">Private event</label>
                                    </div>
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="target" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    <div>Limited spaces</div>
                                    <div class="text-sm text-gray-600">If this event has limited number of spaces, select YES and enter the limit in the box below</div>

                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2 flex">
                                    <div class="flex items-center h-5 mr-8">
                                        <input x-model="limit" id="yes" name="limited" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="1" {{ $event->limited == 1 ? 'checked' : '' }}>
                                        <label for="yes" class="font-medium text-gray-700">Yes</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input x-model="limit" id="no" name="limited" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="0" {{ $event->limited == 0 ? 'checked' : '' }}>
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
                                           class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" min="0" value="{{ $event->attendees ?? 0 }}" placeholder="0">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="target" class="block text-sm font-medium sm:mt-px sm:pt-2">
                                    <div>COVID-19 Restrictions</div>
                                    <div class="text-sm text-gray-600">Should Covid 19 restrictions change and you are currently planning an in-door event, is it possible for your event to be moved online or outdoors?</div>

                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2 flex">
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="yes" name="covid" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="yes" @checked( $event->covid == 1)>
                                        <label for="yes" class="font-medium text-gray-700">Yes</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="no" name="covid" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="no" @checked( $event->covid == 0)>
                                        <label for="no" class="font-medium text-gray-700">No</label>
                                    </div>
                                    <div class="flex items-center h-5 mr-8">
                                        <input id="na" name="covid" type="radio" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded mr-2" value="na" @checked( $event->covid == 'na')>
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
                        </div>
                        <div class="space-y-6 sm:space-y-5">

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="leader_name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Facilitator's name
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="leader_name" id="leader_name" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ $event->leader_name }}">
                                </div>
                            </div>

                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="leader_phone" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Phone
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="leader_phone" id="leader_phone" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" value="{{ $event->leader_phone }}">
                                </div>
                            </div>

                            <div class=" sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="leader_email" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Email
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="leader_email" id="leader_email" class="block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" value="{{ $event->leader_email }}">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class=" pt-5">
                        <div class="flex justify-start">
                            @if($event->status != 'published')
                                <button formaction="{{ route('event.update-and-submit', $event) }}" class="button-primary" name="submit">
                                    Save changes and submit
                                </button>

                                <button formaction="{{ route('event.update', $event) }}" class="button-secondary ml-8" name="save">
                                    Save changes
                                </button>
                            @else
                                <button type="submit" class="button-primary" name="submit">
                                    Save changes
                                </button>
                            @endif
                        </div>
                    </div>
            </form>

        </div>
        <div class="border border-gray-200 bg-gray-50 rounded p-2 mt-4">
            <strong>PLEASE NOTE:</strong> If this event is already listed on the main page and you are making significant changes, such as changing the date, time or the location, please make sure to inform the organisers of the Festival and the registered attendees about it.
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
