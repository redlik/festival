<div class="mt-1 sm:mt-0 sm:col-span-2 livewired" x-data="{ showVenue: @entangle('showVenue').defer }">

    <select id="venue" name="venue_id" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md" :disabled="(type == 'online') ? true : false">
        <option value="" disabled
                    @if($selected == 0 || empty($edit_venue))
                        selected
                    @endif
                    :selected="(type == 'online') ? true : false">Select venue from the list</option>
        @foreach($venues as $venue)
            <option value="{{ $venue->id }}" @selected(old('venue_id' == $venue->id))
            @isset($edit_venue)
                @if($edit_venue == $venue->id)
                    selected
                @endif
            @endisset
            @if($selected == $venue->id)
                selected
            @endif
            >{{ $venue->name }}, {{ $venue->town }}</option>
        @endforeach
    </select>
    <button type="button" class="text-indigo-600 my-2" @click="showVenue = true">
        Click to add new venue</button>
    <div @keydown.window.escape="showVenue = false" x-show="showVenue" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

            <div x-show="showVenue" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-description="Background overlay, show/hide based on modal state." class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showVenue = false" aria-hidden="true">
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

            <div x-show="showVenue" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-description="Modal panel, show/hide based on modal state." class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-purple-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-building text-purple-600"></i>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Add new venue
                            </h3>
                            <div class="mt-2">
                                <form wire:submit.prevent="save" class="w-full">
                                    <div class="flex items-center mb-2">
                                        <label for="venue_name" class="w-48 block">Name: <span class="text-red-700">*</span></label>
                                        <input type="text" name="venue_name" id="venue_name"
                                               class="lg:ml-4 lg:w-64 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                               wire:model.defer="venue_name">
                                    </div>
                                    @error('venue_name') <div class="text-xs text-red-600 mb-4">{{ $message }}</div> @enderror
                                    <div class="flex items-center mb-2">
                                        <label for="venue_address1" class="w-48 block">Address:</label>
                                        <input type="text" name="venue_address1" id="venue_address1" class="lg:ml-4 lg:w-64 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md" wire:model="venue_address1">
                                    </div>
                                    <div class="flex items-center mb-2">
                                        <label for="venue_street" class="w-48 block">Street:</label>
                                        <input type="text" name="venue_street" id="venue_street"
                                               class="lg:ml-4 lg:w-64 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                               wire:model="venue_street">
                                    </div>
                                    <div class="flex items-center mb-2">
                                        <label for="venue_town" class="w-48 block">Town: <span class="text-red-700">*</span></label>
                                        <input type="text" name="venue_town" id="venue_town"
                                               class="lg:ml-4 lg:w-64 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                               wire:model="venue_town">
                                    </div>
                                    @error('venue_town') <div class="text-xs text-red-600 mb-4">{{ $message }}</div> @enderror
                                    <div class="flex items-center mb-2">
                                        <label for="venue_eircode" class="w-48 block">EIRCODE: <span class="text-red-700">*</span></label>
                                        <input type="text" name="venue_eircode" id="venue_eircode" class="lg:ml-4 lg:w-64 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                               wire:model="venue_eircode" maxlength="7">
                                    </div>
                                    @error('venue_eircode') <div class="text-xs text-red-600 mb-4">{{ $message }}</div> @enderror
                                    <div class="flex items-center mb-2">
                                        <label for="venue_website" class="w-48 block">Website:</label>
                                        <input type="url" name="venue_website" id="venue_website" class="lg:ml-4 lg:w-64 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                                               wire:model="venue_website">
                                    </div>
                                    @error('venue_website') <div class="text-xs text-red-600 mb-4">{{ $message }}</div> @enderror
                                    <div class="w-full bg-gray-100 rounded border border-gray-300 p-2 text-gray-600 my-2 mb-4 text-sm">Once the venue is created don't forget to select it from the dropdown</div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">

                    <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-600 text-base font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-3 sm:w-auto sm:text-sm" wire:click="save()" form="newVenue" >
                        Add new venue
                    </button>
                    <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="showVenue = false">
                        Dismiss
                    </button>

                </div>
            </div>

        </div>
    </div>

</div>
