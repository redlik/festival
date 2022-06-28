<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            Editing {{  $venue->name }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 bg-white rounded-lg shadow-lg scroll-smooth">
            <form class="space-y-8 divide-y divide-gray-200" method="POST" action="{{ route('venue.update', $venue) }}" id="event-registration" enctype="multipart/form-data">
                <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
                    @if(\Session::has('saved'))
                        <div class="bg-green-100 border border-green-500 p-2 rounded mt-4">
                            The changes has been saved.
                            <a href="{{ route('admin.dashboard') }}#venues" class="font-bold text-indigo-500 hover:underline"><< Click to return to Dashboard</a>
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
{{--                    <input type="hidden" name="venue_number" value="{{ $venue->id }}">--}}
                    <div>
                        @csrf
                        @method('PATCH')
                        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Venue name
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="name" id="name" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" required value="{{ $venue->name }}">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="address1" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Venue address
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="address1" id="address1" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" value="{{ $venue->address1 }}">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="street" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Venue street
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="street" id="street" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" value="{{ $venue->street }}">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="town" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Venue town
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="town" id="town" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" required value="{{ $venue->town }}">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="eircode" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Venue EIRCODE
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="text" name="eircode" id="eircode" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" required value="{{ $venue->eircode }}">
                                </div>
                            </div>
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                                <label for="website" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                    Venue website
                                </label>
                                <div class="mt-1 sm:mt-0 sm:col-span-2">
                                    <input type="url" name="website" id="website" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md" required value="{{ $venue->website }}">
                                </div>
                            </div>

                            <div class=" pt-5">
                                <div class="flex justify-start">
                                    <button type="submit" class="button-primary">
                                        Save changes
                                    </button>
                                </div>
                            </div>
            </form>

        </div>
        <div class="border border-gray-200 bg-gray-50 rounded p-2 mt-4">
            <strong>PLEASE NOTE:</strong> If the venue is used as a location of an event, make sure the attendees are notified of the changes.
        </div>
    </div>
</x-app-layout>
