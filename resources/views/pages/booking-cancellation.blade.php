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
                    <div class="text-center mb-4">
                        <h2 class="mt-8 md:mt-4 mb-8 text-2xl text-gray-600 font-bold">Booking no {{ date('Y') }} / {{ sprintf('%03d', $booking->id) }}</h2>
                        <h4 class="text-olive-600">{{ $booking->event->name }} on {{ $booking->event->start_date }}</h4>
                    </div>
                    <livewire:booking-cancellation-panel :booking="$booking">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
