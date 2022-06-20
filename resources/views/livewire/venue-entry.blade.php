<div class="mt-1 sm:mt-0 sm:col-span-2 livewired" x-data="{ newVenue: @entangle('showVenue').defer }">
    <select id="venue" name="venue_id" class="max-w-lg block focus:ring-indigo-500 focus:border-indigo-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
        <option value="" disabled
                    @if($selected == 0 || empty($edit_venue))
                        selected
                    @endif
        >Select venue from the list</option>
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
    <button type="button" class="text-indigo-600 my-2" @click="newVenue = ! newVenue">
        <span x-show="!newVenue"> + </span>
        <span x-show="newVenue"> - </span>
        Or add new one below</button>
    <div x-show="newVenue" class="bg-gray-50 border border-gray-300 rounded p-2 relative">
        <div class="absolute top-1 right-0 h-16 w-16 text-center">
            <button type="button" @click="newVenue = ! newVenue"><i class="fas fa-times-circle"></i></button>
        </div>
        <h5>Add new venue</h5>
        <form wire:submit.prevent="save">
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
                <label for="venue-name" class="w-48 block">Website:</label>
                <input type="url" name="venue_website" id="venue_website" class="lg:ml-4 lg:w-64 w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md"
                       wire:model="venue_website">
            </div>
            <div class="text-gray-600 my-2 mb-4 text-sm">Once the venue is created it will be selected for you on the dropdown above</div>
            <button type="button" wire:click="save()" class="bg-olive-400 rounded px-2 py-1 hover:bg-olive-700 text-white">+ Add new venue</button>
        </form>
    </div>
</div>
