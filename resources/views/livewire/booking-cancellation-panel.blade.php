<div>
    @foreach($attendees as $attendee)
        <div class="w-full lg:w-1/2 flex justify-center items-center mb-4 mx-auto">
            <div class="w-full lg:w-1/2 text-right">
                <span class="font-semibold text-md">{{ $attendee->name }} - {{ $attendee->email }}</span>
            </div>
            <div class="w-full lg:w-1/2 text-left">
                <button wire:click="cancelOneBooking({{ $attendee->id }})"
                        wire:confirm="Are you sure you like to cancel this booking?"
                        class="ml-4 text-red-600 underline font-bold hover:text-red-800">
                    Cancel this booking only
                </button>
            </div>
        </div>
    @endforeach
    <div class="mt-4 text-center text-red-400 font-bold">
        {{ $message }}
    </div>
    <div class="mt-4 text-center">
        <x-collage.button wire:click="cancelEntireBooking({{ $booking->id }})"
                          wire:confirm="Are you sure you like to delete entire booking?"
                          class="!font-bold !text-lg mt-4">
            Cancel entire booking
        </x-collage.button>
    </div>

</div>
