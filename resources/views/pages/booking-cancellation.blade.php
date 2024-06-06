<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Booking cancellation') }}
        </h2>
    </x-slot>

    <div class="py-0 md:py-8">
        <div class="bg-gray-100">
            <div class="mx-auto w-full">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        <h2 class="mt-8 md:mt-4 mb-8 text-2xl text-gray-600 font-bold">Booking no {{ date('Y') }} / {{ sprintf('%03d', $booking->id) }}</h2>
                    </div>
                    @foreach($attendees as $attendee)
                        <div class="text-center">
                        {{ $attendee->name }} - <a href="">Cancel this booking</a>
                        </div>
                    @endforeach
                    <div class="mt-8 text-center">
                        <a href="">Cancell entire booking</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
